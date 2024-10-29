<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FlightTracker;
use App\Models\Service;
use App\Models\Supplier;
use App\Models\Review;
use App\Notifications\CustomEmailNotification;
use App\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

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

        // Find the service by ID or throw a 404 error if not found
        $suppliers = Supplier::select('id', 'name', 'logo')->get();

        return view('client.services',['suppliers' => $suppliers]);
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

     public function submitContactForm(Request $request)
    {
        // Validate the form inputs
        $validatedData = $request->validate([
            'company' => 'required|string|max:255',
            'email' => 'required|email',
            'ruc' => 'required|string|max:20',
            'message' => 'required|string|max:1000',
        ], [
            'company.required' => __('messages.contact.mail.company_required'),
            'company.max' => __('messages.contact.mail.company_max'),
            'email.required' => __('messages.contact.mail.email_required'),
            'email.email' => __('messages.contact.mail.email_valid'),
            'ruc.required' => __('messages.contact.mail.ruc_required'),
            'ruc.max' => __('messages.contact.mail.ruc_max'),
            'message.required' => __('messages.contact.mail.message_required'),
            'message.max' => __('messages.contact.mail.message_max'),
        ]);

        try{

            $notifiable = new AnonymousNotifiable($validatedData['email']);
            $notification = new CustomEmailNotification(
                __('messages.contact.mail.subject_anonymous'),
                __('messages.contact.mail.greeting_anonymous'),
                [__('messages.contact.mail.intro_anonymous_1')],
                null,
                null,
                [__('messages.contact.mail.outro_anonymous_2')],
                __('messages.contact.mail.salutation_anonymous'),
                null
            );

            $notifiable->notify($notification);

            $notifiable_admin = new AnonymousNotifiable(env('APP_ADMIN_EMAIL'));
            $notification_admin = new CustomEmailNotification(
                __('messages.contact.mail.subject_admin'),
                __('messages.contact.mail.greeting_admin'),
                [__('messages.contact.mail.intro_admin_1'),
                 __('messages.contact.mail.intro_admin_2'),
                 __('messages.contact.mail.intro_admin_3') . ' : ' . $validatedData['email'],
                 __('messages.contact.mail.intro_admin_4') . ' : ' . $validatedData['company'],
                 __('messages.contact.mail.intro_admin_5') . ' : ' . $validatedData['ruc'],
                 __('messages.contact.mail.intro_admin_6') . ' : ' . $validatedData['message']
                ],
                null,
                null,
                [],
                null,
                null
            );

            $notifiable_admin->notify($notification_admin);

            return redirect()->route('contact')->with('success', __('messages.contact.success'));

        } catch (\Exception $e) {
            // Log the error message for debugging
            Log::error('Failed to send contact email: ' . $e->getMessage());

            // Redirect with an error message if email sending fails
            return redirect()->route('contact')->with('error', __('messages.contact.error'));
        }

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
