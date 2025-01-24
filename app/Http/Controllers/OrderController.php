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
use Illuminate\Support\Facades\Log;

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
            ->select(['status', 'sequence', 'country', 'city','eta','lat','lng','duration', 'transport_type_id','updated_at','created_at']) // Include foreign key
            ->get()
            ->map(function ($trackingStep,$index) use (&$previousEta) {

                // Initialize eta_calculated as a new DateTime object
                $etaCalculated = null;

                // If this is the first step, initialize eta_calculated
                if ($index === 0) {
                    if ($trackingStep->eta) {

                        $currentEta = new \DateTime($trackingStep->eta);
                        // If the current ETA is greater than the previous ETA, use it
                        if ($currentEta > $previousEta) {
                            $etaCalculated = $currentEta;
                        } else {
                            // Otherwise, increment the previous ETA by one day
                            $etaCalculated = clone $previousEta;
                            $etaCalculated->modify("+1 day");
                        }

                    } elseif ($trackingStep->duration > 0) {
                        $etaCalculated = new \DateTime($trackingStep->created_at); // Use the current date
                        $etaCalculated->modify("+{$trackingStep->duration} days"); // Add the duration in days
                    }else{
                        $etaCalculated = new \DateTime($trackingStep->created_at);
                    }
                } else {
                    if ($trackingStep->eta) {
                        $currentEta = new \DateTime($trackingStep->eta);
                        // If the current ETA is greater than the previous ETA, use it
                        if ($currentEta > $previousEta) {
                            $etaCalculated = $currentEta;
                        } else {
                            // Otherwise, increment the previous ETA by one day
                            $etaCalculated = clone $previousEta;
                            $etaCalculated->modify("+1 day");
                        }
                    } elseif ($trackingStep->duration > 0) {
                        $etaCalculated = clone $previousEta; // Start from the previous ETA
                        $etaCalculated->modify("+{$trackingStep->duration} days"); // Add the duration to the previous ETA
                    } else {
                        $etaCalculated = clone $previousEta; // Start from the previous ETA
                        $etaCalculated->modify("+1 day"); // Add one day if no duration
                    }
                }

                // Store the current eta_calculated for the next iteration
                $previousEta = $etaCalculated;

                // Specify only the fields you need from the related transportType
                $transportType = $trackingStep->transportType()->select(['type', 'name', 'icon','status','description','external_reference'])->first(); // Adjust fields as needed

                return array_merge(
                    $trackingStep->toArray(),
                    ['transport_type' => $transportType ? $transportType->toArray() : null], // Add transport_type object
                    ['eta_calculated' => $etaCalculated ? $etaCalculated->format('Y-m-d H:i:s') : null] // Add eta_calculated to response
                );
            })
            ->toArray();
        // Calculate the current position based on percentage of advance
        $currentPosition = $this->calculateCurrentPosition($trackingSteps);

        // Construct the final response
        $response = [
            'order' => array_merge(
                $order->only(['order_number', 'status', 'details', 'numero_dam', 'manifest', 'client_name', 'updated_at']),
                ['current_lat' => $currentPosition['lat'], 'current_lng' => $currentPosition['lng']]
            ),
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

        // Load countries data from JSON file
        $countries = [];
        $countriesPath = storage_path('app/public/data/countries.json');
        if (file_exists($countriesPath)) {
            $countries = json_decode(file_get_contents($countriesPath), true);
        };

        return view($this->model::getRedirectRoutes("index"), [
            'pagination' => $entities,
            'currentFilter' => $filterKey,
            'filters' => $filterableFields,
            'EntityType' => $this->model::getType(),
            'icons' => IconService::getAllSvgIcons(),
            'countries' => $countries
        ]);
    }

    public function SearchCityByCountry(Request $request)
    {
        $countryCode = $request->query('country'); // Get the country code from the request

        $indexPath = storage_path('app/public/data/cities_index.json'); // Path to the cities index file
        $citiesPath = storage_path('app/public/data/cities.json'); // Path to the cities.json file

        if (!file_exists($indexPath) || !file_exists($citiesPath)) {
            return response()->json(['error' => 'Required files not found'], 404); // Handle missing files
        }

        // Load the index file
        $indexData = json_decode(file_get_contents($indexPath), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Invalid index file format'], 500);
        }

        // Find the entry for the specified country code
        $countryEntry = collect($indexData)->firstWhere('country', $countryCode);

        if (!$countryEntry) {
            return response()->json(['message' => 'No cities found for the specified country'], 404);
        }

        // Extract start line and count
        $startLine = $countryEntry['start_line'];
        $count = $countryEntry['count'];

        $linesToRead = $count * 8; // Each city spans 8 lines
        $endLine = $startLine + $linesToRead;

        $file = fopen($citiesPath, 'r');
        if ($file === false) {
            return response()->json(['error' => 'Unable to read cities file'], 500);
        }

        $cities = [];
        $currentCityLines = [];
        $lineNumber = 0;

        // Read only the necessary lines
        while (($line = fgets($file)) !== false) {
            $lineNumber++;

            // Skip lines outside the target range
            if ($lineNumber < $startLine) {
                continue;
            }
            if ($lineNumber >= $endLine) {
                break;
            }

            $line = trim($line);

            // Accumulate lines for each city
            $currentCityLines[] = $line;

            if (count($currentCityLines) === 7) {
                // Combine lines into a single city object
                $cityData = $this->combineCityData($currentCityLines);
                $cities[] = $cityData;

                // Reset for the next city
                $currentCityLines = [];
            }
        }

        fclose($file);

        if (empty($cities)) {
            return response()->json(['message' => 'No cities found for the specified country'], 404);
        }

        // Sort the cities alphabetically by name
        usort($cities, function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });

        // Return the filtered cities as a JSON response
        return response()->json($cities);
    }

    private function combineCityData($cityData)
    {
        // Clean the city data by removing unwanted characters (e.g., escape quotes and commas)
        $city = [
            'name' => isset($cityData[1]) ? $this->cleanData($cityData[1]) : '',
            'lat' => isset($cityData[2]) ? $this->cleanData($cityData[2]) : '',
            'lng' => isset($cityData[3]) ? $this->cleanData($cityData[3]) : '',
            'country' => isset($cityData[5]) ? $this->cleanData($cityData[5]) : '',
        ];
        // Ensure numeric values are properly formatted (lat, lng as floats)
        $city['lat'] = is_numeric($city['lat']) ? (float)$city['lat'] : null;
        $city['lng'] = is_numeric($city['lng']) ? (float)$city['lng'] : null;

        return $city;
    }

    private function cleanData($value)
    {
        // Step 1: Split the value by ":"
        $parts = explode(':', $value);

        // Step 2: Extract the part after the colon
        if (isset($parts[1])) {
            // Step 3: Remove the leading quote (if it exists) and trailing ","
            $cleanedValue = trim($parts[1]);
            // Remove the leading quote if it exists
            if (substr($cleanedValue, 0, 1) === '"') {
                $cleanedValue = substr($cleanedValue, 1);
            }
            // Remove the trailing ","
            if (substr($cleanedValue, -2) === '",') {
                $cleanedValue = substr($cleanedValue, 0, -2);
            }

            if (substr($cleanedValue, -1) === ',') {
                $cleanedValue = substr($cleanedValue, 0, -1);
            }
            // Step 4: Remove the backslash if it exists
            return stripslashes($cleanedValue);
        }

        return ''; // Return empty string if the value is not formatted as expected
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

        $currentStatus  = 'PENDING';
        //Loop thoough each transport item and associate it with the created  order
        foreach ($transportsData as $index => $transportItem) {
            // Create the Freight model (assuming you have a Freight model)
            $transportTypeData = [
                'type' => $transportItem['type'] ?? null,
                'name' => $transportItem['name'] ?? null,
                'icon' => $transportItem['icon'] ?? null,
                'status' => 'ACTIVE',
                'description' => $transportItem['description'] ?? null,
                'external_reference' => $transportItem['external_reference'] ?? null,
            ];

            $transportType = TransportType::create($transportTypeData);

            if($transportItem['status'] == 'IN_TRANSIT' || $transportItem['status'] == 'COMPLETED'){
                $currentStatus = $transportItem['status'];
            };

            // Create the TrackingStep associated with the transport type
            $trackingStepData = [
                'status' => $transportItem['status'] ?? 'PENDING',
                'sequence' => $index,
                'country' => $transportItem['country'] ?? null,
                'city' => $transportItem['city'] ?? null,
                'address' => $transportItem['address'] ?? null,
                'eta' => $transportItem['eta'] ?? null,
                'lat' => $transportItem['lat'] ?? null,
                'lng' => $transportItem['lng'] ?? null,
                'duration' => $transportItem['duration'] ?? 0,
                'order_id' => $entity->id,  // The order ID
                'transport_type_id' => $transportType->id, // The created transport type ID
            ];

            // Assuming you have a TrackingStep model
            TrackingStep::create($trackingStepData);

        }

        $entity->status = $currentStatus;

        $entity->save();

        $emailNotification = $request->input('email-notification', false); // Default to false if not provided

        if ($emailNotification) {

            $type = 'confirmation';

            $this->sendOrderStatusEmail($entity, $type);
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

        $currentStatus  = 'PENDING';

        $existingTransportIds = [];

        // Update or Create Transports and TrackingSteps
        foreach ($transportsData as $index => $transportItem) {




            // Update or Create TransportType
            if (isset($transportItem['id'])) {
                $transportType = TransportType::find($transportItem['id']);
                if ($transportType) {
                    // Create the Freight model (assuming you have a Freight model)
                    $transportTypeData = [
                        'type' => $transportItem['type'] ?? null,
                        'name' => $transportItem['name'] ?? null,
                        'icon' => $transportItem['icon'] ?? null,
                        'status' => 'ACTIVE',
                        'description' => $transportItem['description'] ?? null,
                        'external_reference' => $transportItem['external_reference'] ?? null,
                    ];

                    $transportType->update($transportTypeData);
                    $existingTransportIds[] = $transportItem['id']; // Keep track of existing transports
                }
            } else {
                // Create the Freight model (assuming you have a Freight model)
                $transportTypeData = [
                    'type' => $transportItem['type'] ?? null,
                    'name' => $transportItem['name'] ?? null,
                    'icon' => $transportItem['icon'] ?? null,
                    'status' => 'ACTIVE',
                    'description' => $transportItem['description'] ?? null,
                    'external_reference' => $transportItem['external_reference'] ?? null,
                ];
                $transportTypeData['order_id'] = $entity->id;
                $transportType = TransportType::create($transportTypeData);
                $existingTransportIds[] = $transportType->id; // New transport ID
            }

            $transportId = $transportType->id ?? $transportItem['id'];

            if($transportItem['status'] == 'IN_TRANSIT' || $transportItem['status'] == 'COMPLETED'){
                $currentStatus = $transportItem['status'];
            };

            $trackingStepData = [
                'status' => $transportItem['status'] ?? 'PENDING',
                'sequence' => $index,
                'country' => $transportItem['country'] ?? null,
                'city' => $transportItem['city'] ?? null,
                'address' => $transportItem['address'] ?? null,
                'eta' => $transportItem['eta'] ?? null,
                'lat' => $transportItem['lat'] ?? null,
                'lng' => $transportItem['lng'] ?? null,
                'duration' => $transportItem['duration'] ?? 0,
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

        $entity->status = $currentStatus;

        $entity->save();

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

    public function restore(Request $request, $id)
    {
        $entity = $this->model->find($id);

        if (!$entity) {
            return redirect()->route($this->model::getRedirectRoutes("cancel"))
                ->with('error', $this->model::getErrorMessage('not_found'));
        }

        // Set 'canceled' to true instead of deleting the entity
        if($entity->canceled == true){
            $entity->canceled = false;
        }

        if($entity->status == 'COMPLETED'){
            $entity->status = 'PENDING';
        }

        $entity->save();  // Save the updated entity

        return back()->with('success', $this->model::getSuccessMessage('restore'));
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

        return back()->with('success', $this->model::getSuccessMessage('update_status'));
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

        return back()->with('success', $this->model::getSuccessMessage('email_sended'));

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


    // Static function to calculate the time difference in minutes
    public static function calculateTimeDifferenceInMinutes($start, $end)
    {
        $start = new \DateTime($start);
        $end = new \DateTime($end);
        return ($end->getTimestamp() - $start->getTimestamp()) / 60;
    }

    // Calculate current position based on percentage of advance
    private function calculateCurrentPosition($trackingSteps)
    {
        $now = new \DateTime();
        $previousStep = null;

        foreach ($trackingSteps as $trackingStep) {
            if ($trackingStep['status'] === 'IN_TRANSIT') {
                // If this is the first IN_TRANSIT step, return its lat and lng directly
                if (!$previousStep) {
                    return ['lat' => $trackingStep['lat'], 'lng' => $trackingStep['lng']];
                }

                $etaStart = $previousStep['eta_calculated'];
                $etaEnd = $trackingStep['eta_calculated'];

                if ($now > new \DateTime($etaEnd)) {
                    return ['lat' => $trackingStep['lat'], 'lng' => $trackingStep['lng']];
                }

                $totalMinutes = self::calculateTimeDifferenceInMinutes($etaStart, $etaEnd);
                $elapsedMinutes = self::calculateTimeDifferenceInMinutes($etaStart, $now->format('Y-m-d H:i:s'));
                $percentage = min(max($elapsedMinutes / $totalMinutes, 0), 1);

                $currentLat = $previousStep['lat'] + ($trackingStep['lat'] - $previousStep['lat']) * $percentage;
                $currentLng = $previousStep['lng'] + ($trackingStep['lng'] - $previousStep['lng']) * $percentage;

                return ['lat' => $currentLat, 'lng' => $currentLng];
            }

            $previousStep = $trackingStep;
        }

        return ['lat' => null, 'lng' => null];
    }
}
