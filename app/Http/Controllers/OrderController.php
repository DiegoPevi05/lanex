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
use App\Services\IconService;
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
            ->select(['status', 'sequence', 'country', 'city', 'transport_type_id','updated_at']) // Include foreign key
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
            'order' => $order->only(['order_number', 'status', 'details', 'numero_dam', 'manifest', 'client_name','updated_at']),
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
        $perPage = 3;
        $query = $this->model->query();

        // Filter for orders where canceled is false
        $query->where('canceled', false);
        $query->whereNotIn('status',['COMPLETED']);

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
            'icons' => IconService::getAllSvgIcons()
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

    public function cancel(Request $request, $id)
    {
        $entity = $this->model->find($id);

        if (!$entity) {
            return redirect()->route($this->model::getRedirectRoutes("cancel"))
                ->with('error', $this->model::getErrorMessage('not_found'));
        }

        $emailNotification = $request->input('email-notification', false); // Default to false if not provided

        if ($emailNotification) {

            $type = 'cancellation';

            $this->sendOrderStatusEmail($entity, $type);
        }

        // Set 'canceled' to true instead of deleting the entity
        $entity->canceled = true;
        $entity->save();  // Save the updated entity

        return redirect()->route($this->model::getRedirectRoutes("cancel"))
            ->with('success', $this->model::getSuccessMessage('cancel'));
    }

    public function destroy($id)
    {
        // Find the entity by ID
        $entity = $this->model->find($id);

        // Check if the entity exists
        if (!$entity) {
            return redirect()->route($this->model::getRedirectRoutes("destroy"))
                ->with('error', $this->model::getErrorMessage('not_found'));
        }

        // Delete the entity
        $entity->delete();

        return redirect()->route($this->model::getRedirectRoutes("destroy"))
            ->with('success', $this->model::getSuccessMessage('destroy'));
    }

    public function updateOrder(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return back()->with('error', $this->model::getErrorMessage('not_found'));
        }


        // Extract step, status, and email_notification from the request
        $step = $request->input('step');
        $status = $request->input('status','default');
        $emailNotification = $request->input('email-notification', false); // Default to false if not provided

        // Custom validation messages for the file upload
        $customMessages = [
            'pdf-archive.mimes' => __('messages.mail.modal.pdf_validation_mime'),
            'pdf-archive.max' => __('messages.mail.modal.pdf_validation_max'),
        ];

        // Validate the file only if it's uploaded
        $request->validate([
            'pdf-archive' => 'nullable|file|mimes:pdf|max:2048', // Example validation
        ], $customMessages);

        // Get the uploaded file (if any)
        $file = $request->file('pdf-archive');

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

            // If file exists, pass the file to the email method, else send email without file
            if ($file) {
                $this->sendOrderStatusEmail($order, $type, $file);
            } else {
                $this->sendOrderStatusEmail($order, $type);
            }

        }

        return back()->with('success', $this->model::getSuccessMessage('update'));
    }

    public function emailOrder(Request $request, $id){

        $order = Order::find($id);

        if (!$order) {
            return back()->with('error', $this->model::getErrorMessage('not_found'));
        }

        // Custom validation messages
        $customMessages = [
            'pdf-archive.mimes' => __('messages.mail.modal.pdf_validation_mime'),
            'pdf-archive.max' => __('messages.mail.modal.pdf_validation_max'),
            'email_subject.required' => __('messages.mail.modal.subject_required'),
            'email_subject.max' => __('messages.mail.modal.subject_max'),
            'email_title.required' => __('messages.mail.modal.title_required'),
            'email_title.max' => __('messages.mail.modal.title_max'),
            'email_content.required' => __('messages.mail.modal.content_required'),
            'email_content.string' => __('messages.mail.modal.content_string'),
            'email_content.max' => __('messages.mail.modal.content_max'),
        ];

        // Validation rules
        $request->validate([
            'email_subject' => 'required|string|max:255', // Subject is required, must be a string, and max length is 255
            'email_title' => 'required|string|max:255',  // Title is required, must be a string, and max length is 255
            'email_content' => 'required|string|max:2000', // Content is required, must be a string, and max length is 2000
            'pdf-archive' => 'nullable|file|mimes:pdf|max:2048', // File upload validation for PDF
        ], $customMessages);

        $include_order_content = $request->input('email_order_details', false); // Default to false if not provided

        $withDetails = $request->input('email_order_details',false);
        $subject = $request->input('email_subject');
        $title = $request->input('email_title');
        $content = $request->input('email_content');

        // Create the mailable instance
        $email = new OrderStatusMailable($order, 'custom' ,'es',$subject, $title, $content , $withDetails );

        // Get the uploaded file (if any)
        $file = $request->file('pdf-archive');
        // Attach the file if provided
        if ($file) {
            $email->attach($file->getRealPath(), [
                'as' => $file->getClientOriginalName(),
                'mime' => $file->getMimeType(),
            ]);
        }

        $client = Client::find($order->client_id);

        if (!$client) {
            return response()->json(['error' => [$this->model::getErrorMessage('not_found')]], 404);
        }

        // Send the email
        Mail::to($client->email)->send($email);

        return back()->with('success', $this->model::getSuccessMessage('update'));

    }

    public function updateStatusOrder(Order $order, $step, $status)
    {
        // Get all tracking steps for the order
        $trackingSteps = $order->trackingSteps;

        // Ensure the step index is within bounds
        if ($step < 0 || $step >= $trackingSteps->count()) {
            return response()->json(['error' => ['Invalid step index.']], 400);
        }

        $lastStep = count($trackingSteps) - 1;

        foreach ($trackingSteps as $index => $trackingStep) {
            if ($index < $step) {
                // Previous steps
                $trackingStep->status = 'COMPLETED';
                $trackingStep->transportType->status = 'ACTIVE';

            } elseif ($index == $step) {
                // Current step
                $trackingStep->status = $status; // IN_TRANSIT, COMPLETED, or PENDING

                if($lastStep == $step && $status == 'COMPLETED'){
                    $order->status = 'COMPLETED';
                }else{
                    $order->status = 'IN_TRANSIT';
                };

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

        $order->save();

        return response()->json(['success' => ['Order status updated successfully.']]);
    }

    public function sendOrderStatusEmail(Order $order, $type, $file = null)
    {

        $client = Client::find($order->client_id);

        if (!$client) {
            return response()->json(['error' => [$this->model::getErrorMessage('not_found')]], 404);
        }

        // Create the mailable instance
        $email = new OrderStatusMailable($order, $type,'es',null,null,null, true);

        // Attach the file if provided
        if ($file) {
            $email->attach($file->getRealPath(), [
                'as' => $file->getClientOriginalName(),
                'mime' => $file->getMimeType(),
            ]);
        }

        // Send the email
        Mail::to($client->email)->send($email);

        return response()->json(['success' => ['Email with status send successfully.']]);
    }
}
