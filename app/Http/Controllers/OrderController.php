<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Web\AbstractEntityController;
use App\Models\Client;
use App\Models\Order;
use App\Models\Freight;
use App\Models\TransportType;
use App\Models\TrackingStep;
use Illuminate\Http\Request;
use App\Services\FormService;
use App\Mail\OrderStatusMailable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class OrderController extends AbstractEntityController
{
    public function __construct(FormService $formService)
    {
        parent::__construct(new Order(), $formService);
    }

    public function searchOrder(Request $request)
    {
        $orderNumber = strtolower($request->input('order_number')); // Convert input to lowercase

        // Fetch the order with only the specified fields
        $order = Order::whereRaw('LOWER(order_number) = ?', [$orderNumber])->first();

        // Check if the order was found
        if (!$order) {
            return response()->json(['error' => ['Order not found.']], 404);
        }

        // Fetch freights related to the order
        $freights = $order->freights()
            ->select([
                'id', // Primary key
                'freight_id',
                'name',
                'description',
                'origin',
                'dimensions_units',
                'dimensions',
                'weight_units',
                'weight',
                'volume_units',
                'volume',
                'packages'
            ])
            ->get()
            ->toArray();

        // Fetch tracking steps related to the order
        $trackingSteps = $order->trackingSteps()
            ->select(['status', 'sequence', 'country', 'city', 'address', 'transport_type_id','updated_at']) // Include foreign key
            ->get()
            ->map(function ($trackingStep) {

                // Specify only the fields you need from the related transportType
                $transportType = $trackingStep->transportType()->select(['type', 'name', 'icon','status','description','external_reference'])->first(); // Adjust fields as needed

                return array_merge(
                    $trackingStep->toArray(),
                    ['transport_type' => $transportType ? $transportType->toArray() : null] // Add transport_type object
                );
            })
            ->toArray();

        // Construct the final response
        $response = [
            'order' => $order->only(['order_number', 'status', 'details', 'numero_dam', 'manifest', 'client_name']),
            'freights' => $freights,
            'tracking_steps' => $trackingSteps
        ];

        // Return JSON response
        return response()->json($response);
    }

    public function index(Request $request)
    {
        $filterKey = $request->input('filterKey');
        $filterValue = $request->input('filterValue');
        $perPage = 5;
        $query = $this->model->query();

        // Filter for orders where canceled is false
        $query->where('canceled', false);

        $filterableFields = $this->model->filterFields();
        $filterableValues = array_column($filterableFields, 'value');

        if ($filterKey && in_array($filterKey, $filterableValues)) {
            $query->where($filterKey, 'like', "%{$filterValue}%");
        }

        $entities = $query->paginate($perPage);

        return view($this->model::getRedirectRoutes("index"), [
            'pagination' => $entities,
            'currentFilter' => $filterKey,
            'filters' => $filterableFields,
            'EntityType' => $this->model::getType(),
        ]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), $this->model::getValidationRules(), $this->model::getValidationMessages());

        //validate Order Data
        if ($validator->fails()) {
            return redirect()->route($this->model::getRedirectRoutes("store"))
                ->withErrors($validator)
                ->withInput()
                ->with('formRequest', 'create')
                ->with('error', $this->model::getErrorMessage('validation_failed'));
        }

        // Create the order using validated data
        $orderData = $this->model::getFillableFields($validator->validated(), $request);
        $entity = $this->model->create($orderData);



        // Extract the validated freight data
        $freightData = $validator->validated()['freight'];

        // Loop through each freight item and associate it with the created order
        foreach ($freightData as $freightItem) {
            $filledData = Freight::getFillableFields($freightItem,$request);
            $filledData['order_id'] = $entity->id;
            // Create the Freight model (assuming you have a Freight model)
            Freight::create($filledData);
        }

        // Extract the validated Trasnport/TrackingStep data
        $transportsData = $validator->validated()['transports'];

        // Find the last index of the item where the 'status' is 'ACTIVE'
        $statusIndex = array_reduce(
            array_keys($transportsData),
            fn($carry, $index) => $transportsData[$index]['status'] === 'ACTIVE' ? $index : $carry,
            false
        );

        // If no 'ACTIVE' status is found, set the index to 0
        $statusIndex = $statusIndex !== false ? $statusIndex : 0;

        //Loop thoough each transport item and associate it with the created  order
        foreach ($transportsData as $index => $transportItem) {
            $filledData = TransportType::getFillableFields($transportItem,$request);
            // Create the Freight model (assuming you have a Freight model)
            $transportType = TransportType::create($filledData);

            // Determine the status for the tracking step
            $status = match (true) {
                $index < $statusIndex => 'COMPLETED',     // Before the current status
                $index === $statusIndex => 'IN TRANSIT',  // Current status
                default => 'PENDING',                     // After the current status
            };

            // Create the TrackingStep associated with the transport type
            $trackingStepData = [
                'status' => $status,
                'sequence' => $index,
                'country' => $transportItem['country'] ?? null,
                'city' => $transportItem['city'] ?? null,
                'address' => $transportItem['address'] ?? null,
                'order_id' => $entity->id,  // The order ID
                'transport_type_id' => $transportType->id, // The created transport type ID
            ];

            // Assuming you have a TrackingStep model
            TrackingStep::create($trackingStepData);

        }

        return redirect()->route($this->model::getRedirectRoutes("store"))->with('success', $this->model::getSuccessMessage('create'));
    }

    public function update(Request $request, $id)
    {

        $entity = $this->model->find($id);

        if (!$entity) {
            return redirect()->route($this->model::getRedirectRoutes("update"))
                ->with('error', $this->model::getErrorMessage('not_found'));
        }

        $validator = Validator::make($request->all(), $this->model::getValidationRules(true), $this->model::getValidationMessages());

        if ($validator->fails()) {
            return redirect()->route($this->model::getRedirectRoutes("update"))
                ->withErrors($validator)
                ->withInput()
                ->with('formRequest', 'update')
                ->with('EntityId', $id);
        }

        // Update Order Data
        $entityData = $this->model::getFillableFields($validator->validated(), $request, $entity);
        $entity->update($entityData);

        // === Handle Freight Data ===
        $freightData = $validator->validated()['freight'];
        $existingFreightIds = collect($freightData)->pluck('id')->filter()->all();

        // Update or Create Freight
        foreach ($freightData as $freightItem) {
            if (isset($freightItem['id']) && $freight = Freight::find($freightItem['id'])) {
                // Freight exists, update it
                $filledData = Freight::getFillableFields($freightItem, $request, $freight);
                $filledData['order_id'] = $entity->id;
                $freight->update($filledData);
            } else {
                // Freight does not exist, create a new one
                $filledData = Freight::getFillableFields($freightItem, $request);
                $filledData['order_id'] = $entity->id;
                Freight::create($filledData);
            }
        }

        // Delete Freights that are no longer linked to the order
        Freight::where('order_id', $entity->id)->whereNotIn('id', $existingFreightIds)->delete();

        // === Handle Transport and TrackingStep Data ===
        $transportsData = $validator->validated()['transports'];

        $existingTransportIds = [];

        // Update or Create Transports and TrackingSteps
        foreach ($transportsData as $index => $transportItem) {


            // Update or Create TransportType
            if (isset($transportItem['id'])) {
                $transportType = TransportType::find($transportItem['id']);
                if ($transportType) {
                    $filledData = TransportType::getFillableFields($transportItem, $request, $transportType);
                    $transportType->update($filledData);
                    $existingTransportIds[] = $transportItem['id']; // Keep track of existing transports
                }
            } else {
                $filledData = TransportType::getFillableFields($transportItem, $request);
                $filledData['order_id'] = $entity->id;
                $transportType = TransportType::create($filledData);
                $existingTransportIds[] = $transportType->id; // New transport ID
            }

            $transportId = $transportType->id ?? $transportItem['id'];

            // Determine TrackingStep Status
            $status = match (true) {
                $index < $this->getLastStatusIndex($transportsData) => 'COMPLETED',
                $index === $this->getLastStatusIndex($transportsData) => 'IN TRANSIT',
                default => 'PENDING',
            };

            $trackingStepData = [
                'status' => $status,
                'sequence' => $index,
                'country' => $transportItem['country'] ?? null,
                'city' => $transportItem['city'] ?? null,
                'address' => $transportItem['address'] ?? null,
                'order_id' => $entity->id,
                'transport_type_id' => $transportId,
            ];

            // Update or Create TrackingStep
            TrackingStep::updateOrCreate(
                ['order_id' => $entity->id, 'transport_type_id' => $transportId],
                $trackingStepData
            );
        }

        // Delete Transports and Related TrackingSteps that are no longer linked to the order
        TrackingStep::where('order_id', $entity->id)
            ->whereNotIn('transport_type_id', $existingTransportIds)
            ->delete();

        // Delete Transport Types without any related TrackingSteps
        $transportsToDelete = TransportType::whereDoesntHave('trackingSteps')->pluck('id')->toArray();
        TransportType::whereIn('id', $transportsToDelete)->delete();

        return redirect()->route($this->model::getRedirectRoutes("update"))
            ->with('success', $this->model::getSuccessMessage('update'));
    }

    /**
     * Helper function to get the last index of the transport with status 'ACTIVE'
     */
    private function getLastStatusIndex(array $transportsData): int
    {
        $lastActiveIndex = 0; // Default to the first item if no 'ACTIVE' status is found

        foreach ($transportsData as $index => $transportItem) {
            if (isset($transportItem['status']) && $transportItem['status'] === 'ACTIVE') {
                $lastActiveIndex = $index; // Update the index whenever an ACTIVE status is found
            }
        }

        return $lastActiveIndex;
    }

    public function destroy($id)
    {
        $entity = $this->model->find($id);

        if (!$entity) {
            return redirect()->route($this->model::getRedirectRoutes("destroy"))
                ->with('error', $this->model::getErrorMessage('not_found'));
        }

        // Set 'canceled' to true instead of deleting the entity
        $entity->canceled = true;
        $entity->save();  // Save the updated entity

        return redirect()->route($this->model::getRedirectRoutes("destroy"))
            ->with('success', $this->model::getSuccessMessage('cancel'));
    }

    public function updateOrder(Request $request, $id)
    {

        $order = Order::find($id);

        if (!$order) {
            return response()->json(['error' => ['Order not found.']], 404);
        }
        // Extract step, status, and email_notification from the request
        $step = $request->input('step');
        $status = $request->input('status','default');
        $emailNotification = $request->input('email_notification', false); // Default to false if not provided

        // Call the method to update the order's tracking steps status

        $this->updateStatusOrder($order, $step, $status);
        // Send the email only if email_notification is true
        if ($emailNotification) {

            $type = 'default';

            $firstTrackStep = $order->getFirstTrackStep();
            $lastTrackStep  = $order->getLastTrackStep();

            if($firstTrackStep->status == 'IN_TRANSIT'){
                $type = 'shipping';
            }else if($lastTrackStep->status == 'COMPLETED'){
                $type = 'delivered';
            }

            $this->sendOrderStatusEmail($order, $type);
        }

        return response()->json(['success' => ['Order status updated successfully. Email sent if requested.']]);
    }

    public function updateStatusOrder(Order $order, $step, $status)
    {
        // Get all tracking steps for the order
        $trackingSteps = $order->trackingSteps;

        // Ensure the step index is within bounds
        if ($step < 0 || $step >= $trackingSteps->count()) {
            return response()->json(['error' => ['Invalid step index.']], 400);
        }

        foreach ($trackingSteps as $index => $trackingStep) {
            if ($index < $step) {
                // Previous steps
                $trackingStep->status = 'COMPLETED';
                $trackingStep->transportType->status = 'ACTIVE';

            } elseif ($index == $step) {
                // Current step
                $trackingStep->status = $status; // IN_TRANSIT, COMPLETED, or PENDING
                if($status == 'PENDING'){
                    $trackingStep->transportType->status = 'INACTIVE';
                }else{
                    $trackingStep->transportType->status = 'ACTIVE';
                }
            } else {
                // Following steps
                $trackingStep->status = 'PENDING';
                $trackingStep->transportType->status = 'INACTIVE';
            }

            // Save each step's status
            $trackingStep->save();
        }

        return response()->json(['success' => ['Order status updated successfully.']]);
    }

    public function sendOrderStatusEmail(Order $order, $type)
    {

        $client = Client::find($order->client_id);

        if (!$client) {
            return response()->json(['error' => 'Client not found.'], 404);
        }

        // Send the email using the OrderStatusMailable
        Mail::to($client->email)->send(new OrderStatusMailable($order, $type));

        return response()->json(['success' => ['Email with status send successfully.']]);
    }
}
