<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FlightTracker;
use App\Models\Service;
use App\Models\Supplier;
use App\Models\Review;

class WebController extends Controller
{
    protected $flightTracker;

    public function __construct(FlightTracker $flightTracker)
    {
        $this->flightTracker = $flightTracker;
    }

    public function home()
    {

        $questions = [
            [
                'id' => 1,
                'question' => 'What is the return policy?',
                'answer' => 'You can return any item within 30 days of purchase.',
            ],
            [
                'id' => 2,
                'question' => 'How do I track my order?',
                'answer' => 'You will receive a tracking number via email once your order has shipped.',
            ],
            [
                'id' => 3,
                'question' => 'Do you offer international shipping?',
                'answer' => 'Yes, we ship to many countries worldwide. Check our shipping page for details.',
            ],
            [
                'id' => 4,
                'question' => 'How can I contact customer support?',
                'answer' => 'You can reach customer support via the contact form on our website or by calling our hotline.',
            ],
        ];

        $reviews = Review::all();

        // Find the service by ID or throw a 404 error if not found
        $suppliers = Supplier::select('id', 'name', 'logo')->get();

        return view('client.home', ['questions' => $questions, 'suppliers' => $suppliers, 'reviews' => $reviews]);
    }

    public function about()
    {
        return view('client.about');
    }

    public function services()
    {
        return view('client.services');
    }

    public function service($id)
    {
        // Fake data for now
        // Find the service by ID or throw a 404 error if not found
        $service = Service::with('suppliers:id,name,logo')->findOrFail($id);

        // Decode the JSON webcontent into an array
        $service->webcontent = json_decode($service->webcontent, true); // true converts it to an associative array


        // Pass the service data to the view
        return view('client.service', ['service' => $service]);
    }

    public function suppliers()
    {

        return view('client.suppliers');
    }

    public function supplier($id)
    {
        $supplier = Supplier::with('products')->findOrFail($id);

        if (!is_array($supplier->details)) {
            $supplier->details = json_decode($supplier->details, true);
        }

        return view('client.supplier',['supplier'=> $supplier]);
    }

    public function contact()
    {

        $questions = [
            [
                'id' => 1,
                'question' => 'What is the return policy?',
                'answer' => 'You can return any item within 30 days of purchase.',
            ],
            [
                'id' => 2,
                'question' => 'How do I track my order?',
                'answer' => 'You will receive a tracking number via email once your order has shipped.',
            ],
            [
                'id' => 3,
                'question' => 'Do you offer international shipping?',
                'answer' => 'Yes, we ship to many countries worldwide. Check our shipping page for details.',
            ],
            [
                'id' => 4,
                'question' => 'How can I contact customer support?',
                'answer' => 'You can reach customer support via the contact form on our website or by calling our hotline.',
            ],
        ];

        return view('client.contact' , ['questions' => $questions]);
    }

    public function quote()
    {
        $questions = [
            [
                'id' => 1,
                'question' => 'What is the return policy?',
                'answer' => 'You can return any item within 30 days of purchase.',
            ],
            [
                'id' => 2,
                'question' => 'How do I track my order?',
                'answer' => 'You will receive a tracking number via email once your order has shipped.',
            ],
            [
                'id' => 3,
                'question' => 'Do you offer international shipping?',
                'answer' => 'Yes, we ship to many countries worldwide. Check our shipping page for details.',
            ],
            [
                'id' => 4,
                'question' => 'How can I contact customer support?',
                'answer' => 'You can reach customer support via the contact form on our website or by calling our hotline.',
            ],
        ];

        return view('client.quote' , ['questions' => $questions]);
    }

    public function track()
    {

        $questions = [
            [
                'id' => 1,
                'question' => 'What is the return policy?',
                'answer' => 'You can return any item within 30 days of purchase.',
            ],
            [
                'id' => 2,
                'question' => 'How do I track my order?',
                'answer' => 'You will receive a tracking number via email once your order has shipped.',
            ],
            [
                'id' => 3,
                'question' => 'Do you offer international shipping?',
                'answer' => 'Yes, we ship to many countries worldwide. Check our shipping page for details.',
            ],
            [
                'id' => 4,
                'question' => 'How can I contact customer support?',
                'answer' => 'You can reach customer support via the contact form on our website or by calling our hotline.',
            ],
        ];

        return view('client.track' , ['questions' => $questions]);
    }

    public function trackFlight(Request $request)
    {

         // Fetch the flight_id from the query parameter
        $flightId = $request->query('flightId', '3c4b26');

        // Get the flight data from the service
        $flightData = $this->flightTracker->getFlightData($flightId);

        if (!$flightData) {
            return response()->json(['error' => 'Flight data not available'], 404);
        }

        return response()->json(['data'=> $flightData],200);
    }
}
