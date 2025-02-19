<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FlightTracker;
use App\Models\WebService;
use App\Models\WebSupplier;
use App\Models\WebReview;
use App\Models\WebProduct;
use App\Models\WebBlog;
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
                'question' => __('messages.home.questions.questions.question_1.question'),
                'answer' => __('messages.home.questions.questions.question_1.answer'),
            ],
            [
                'id' => 2,
                'question' => __('messages.home.questions.questions.question_2.question'),
                'answer' => __('messages.home.questions.questions.question_2.answer'),
            ],
            [
                'id' => 3,
                'question' => __('messages.home.questions.questions.question_3.question'),
                'answer' => __('messages.home.questions.questions.question_3.answer'),
            ],
            [
                'id' => 4,
                'question' => __('messages.home.questions.questions.question_4.question'),
                'answer' => __('messages.home.questions.questions.question_4.answer'),
            ],
        ];

        $reviews = WebReview::all();

        $blogs = WebBlog::orderBy('created_at', 'desc')->limit(5)->get();

        //dd($blogs);

        // Find the service by ID or throw a 404 error if not found
        $suppliers = WebSupplier::select('id', 'name', 'logo')->get();

        return view('client.home', ['questions' => $questions, 'suppliers' => $suppliers, 'blogs' => $blogs]);
    }

    public function blog($id)
    {
        $blog = WebBlog::findOrFail($id);

        return view('client.blog', ['blog' => $blog]);
    }

    public function about()
    {
        $services = WebService::all();
        return view('client.about', ['services' => $services]);
    }

    public function services()
    {

        // Find the service by ID or throw a 404 error if not found
        $suppliers = WebSupplier::select('id', 'name', 'logo')->get();

        return view('client.services',['suppliers' => $suppliers]);
    }

    public function service($id)
    {
        // Fake data for now
        // Find the service by ID or throw a 404 error if not found
        $service = WebService::with('suppliers:id,name,logo')->findOrFail($id);

        // Decode the JSON webcontent into an array
        $service->webcontent = json_decode($service->webcontent, true); // true converts it to an associative array


        // Pass the service data to the view
        return view('client.service', ['service' => $service]);
    }

    public function getSuppliers(Request $request)
    {
        // Get the current page from the query parameters, defaulting to 1
        $page = $request->query('page_suppliers', 1);

        // Get the supplier_name filter from the request
        $supplierName = $request->query('supplier_name', null);

        // Base query for suppliers
        $query = WebSupplier::query();

        // Apply case-insensitive name filter if supplier_name is present
        if ($supplierName) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($supplierName) . '%']);
        }

        // Paginate suppliers with a limit of 6 items per page
        $suppliers = $query->paginate(6, ['*'], 'page', $page);

        // Append custom query parameters for pagination links
        $suppliers->appends([
            'page_suppliers' => $page,
            'supplier_name' => $supplierName,
        ]);

        // Decode details for each supplier
        $suppliers->getCollection()->transform(function ($supplier) {
            $supplier->details = json_decode($supplier->details, true);
            return $supplier;
        });

        // Return a JSON response with the paginated suppliers
        return response()->json([
            'suppliers' => $suppliers,
        ]);
    }

    public function suppliers()
    {

        return view('client.suppliers');
    }

    public function getSupplierProducts(Request $request, $id)
    {
        // Fetch the supplier to validate the ID and ensure the relationship exists
        $supplier = WebSupplier::findOrFail($id);

        // Get query parameters for filtering and pagination
        $productName = $request->query('product_name', null);
        $page = $request->query('page', 1); // Renaming query parameter to 'page'

        // Fetch the products associated with the supplier
        $productsQuery = $supplier->products();

        // Apply the EAN filter if provided
        if ($productName) {
            $productsQuery->where('name', 'like', '%' . strtolower($productName) . '%');
        }

        // Paginate the products (3 per page)
        $products = $productsQuery->paginate(6, ['*'], 'page', $page);

        // Append query parameters for pagination links
        $products->appends([
            'product_name' => $productName,
        ]);

        // Return JSON response
        return response()->json([
            'products' => $products,
        ]);
    }

    public function supplier(Request $request, $id)
    {
        // Fetch the supplier details
        $supplier = WebSupplier::findOrFail($id);

        if (!is_array($supplier->details)) {
            $supplier->details = json_decode($supplier->details, true);
        }

        // Get the query parameters for filtering and pagination
        $productEan = $request->query('product_ean', null);
        $page = $request->query('page_products', 1);

        // Fetch the products associated with the supplier using the relationship
        $productsQuery = $supplier->products();

        // Apply the EAN filter if present
        if ($productEan) {
            $productsQuery->where('EAN', 'like', '%' . strtolower($productEan) . '%');
        }

        // Paginate the products (6 per page)
        $products = $productsQuery->paginate(3, ['*'], 'page_products', $page);

        // Append query parameters for pagination links
        $products->appends([
            'product_ean' => $productEan,
            'page_products' => $page
        ]);

        // Return the view with the supplier details and paginated products
        return view('client.supplier', [
            'supplier' => $supplier,
            'products' => $products
        ]);
    }

    public function contact()
    {

        $questions = [
            [
                'id' => 1,
                'question' => __('messages.contact.questions.questions.question_1.question'),
                'answer' => __('messages.contact.questions.questions.question_1.answer'),
            ],
            [
                'id' => 2,
                'question' => __('messages.contact.questions.questions.question_2.question'),
                'answer' => __('messages.contact.questions.questions.question_2.answer'),
            ],
            [
                'id' => 3,
                'question' => __('messages.contact.questions.questions.question_3.question'),
                'answer' => __('messages.contact.questions.questions.question_3.answer'),
            ],
            [
                'id' => 4,
                'question' => __('messages.contact.questions.questions.question_4.question'),
                'answer' => __('messages.contact.questions.questions.question_4.answer'),
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

    public function quote(Request $request)
    {
        // Retrieve the query parameters, set default to null if not provided
        $type = $request->query('type', null);
        $id = $request->query('id',null);

        // If the 'type' is present and 'id' is provided, fetch the product
        $product = null;
        if ($type && $id) {
            if($type == 'product'){
                $product = WebProduct::findOrFail($id);
            }
        };

        // Static questions (same as before)
        $questions = [
            [
                'id' => 1,
                'question' => __('messages.quote.questions.questions.question_1.question'),
                'answer' => __('messages.quote.questions.questions.question_1.answer'),
            ],
            [
                'id' => 2,
                'question' => __('messages.quote.questions.questions.question_2.question'),
                'answer' => __('messages.quote.questions.questions.question_2.answer'),
            ],
            [
                'id' => 3,
                'question' => __('messages.quote.questions.questions.question_3.question'),
                'answer' => __('messages.quote.questions.questions.question_3.answer'),
            ],
            [
                'id' => 4,
                'question' => __('messages.quote.questions.questions.question_4.question'),
                'answer' => __('messages.quote.questions.questions.question_4.answer'),
            ],
        ];

        // Pass type, product, and questions to the view
        return view('client.quote',
        ['questions' => $questions,
            'product' => $product,
            'type' => $type
        ]);
    }

     public function QuoteForm(Request $request)
    {
        // Validate the form inputs
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'cellphone' => 'required|string',
            'departure_address' => 'required|string|max:255',
            'arrival_address' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ], [
            'full_name.required' => __('messages.quote.form.validations.full_name_required'),
            'full_name.string' => __('messages.quote.form.validations.full_name_string'),
            'full_name.max' => __('messages.quote.form.validations.full_name_max'),
            'company.string' => __('messages.quote.form.validations.company_string'),
            'company.max' => __('messages.quote.form.validations.company_max'),
            'email.required' => __('messages.quote.form.validations.email_required'),
            'email.email' => __('messages.quote.form.validations.email_valid'),
            'email.max' => __('messages.quote.form.validations.email_max'),
            'cellphone.required' => __('messages.quote.form.validations.cellphone_required'),
            'cellphone.string' => __('messages.quote.form.validations.cellphone_string'),
            'departure_address.required' => __('messages.quote.form.validations.departure_address_required'),
            'departure_address.string' => __('messages.quote.form.validations.departure_address_string'),
            'departure_address.max' => __('messages.quote.form.validations.departure_address_max'),
            'arrival_address.required' => __('messages.quote.form.validations.arrival_address_required'),
            'arrival_address.string' => __('messages.quote.form.validations.arrival_address_string'),
            'arrival_address.max' => __('messages.quote.form.validations.arrival_address_max'),
            'message.required' => __('messages.quote.form.validations.message_required'),
            'message.string' => __('messages.quote.form.validations.message_string'),
            'message.max' => __('messages.quote.form.validations.message_max'),
        ]);

        try{

            $notifiable = new AnonymousNotifiable($validatedData['email']);
            $notification = new CustomEmailNotification(
                __('messages.quote.mail.subject_anonymous'),
                __('messages.quote.mail.greeting_anonymous'),
                [__('messages.quote.mail.intro_anonymous_1')],
                null,
                null,
                [__('messages.quote.mail.outro_anonymous_2')],
                __('messages.quote.mail.salutation_anonymous'),
                null
            );

            $notifiable->notify($notification);

            $notifiable_admin = new AnonymousNotifiable(env('APP_ADMIN_EMAIL'));

            $notification_admin = new CustomEmailNotification(
                __('messages.quote.mail.subject_admin'),
                __('messages.quote.mail.greeting_admin'),
                [__('messages.quote.mail.intro_admin_1'),
                 __('messages.quote.mail.intro_admin_2'),
                 __('messages.quote.mail.intro_admin_3') . ' : ' . $validatedData['full_name'],
                 __('messages.quote.mail.intro_admin_4') . ' : ' . $validatedData['company'],
                 __('messages.quote.mail.intro_admin_5') . ' : ' . $validatedData['email'],
                 __('messages.quote.mail.intro_admin_6') . ' : ' . $validatedData['cellphone'],
                 __('messages.quote.mail.intro_admin_7') . ' : ' . $validatedData['departure_address'],
                 __('messages.quote.mail.intro_admin_8') . ' : ' . $validatedData['arrival_address'],
                 __('messages.quote.mail.intro_admin_9') . ' : ' . $validatedData['message']
                ],
                null,
                null,
                [],
                null,
                null
            );

            $notifiable_admin->notify($notification_admin);

            return redirect()->route('quote')->with('success', __('messages.quote.success'));

        } catch (\Exception $e) {
            // Log the error message for debugging
            Log::error('Failed to send quote email: ' . $e->getMessage());

            // Redirect with an error message if email sending fails
            return redirect()->route('quote')->with('error', __('messages.quote.error'));
        }

    }

    public function track()
    {

        $questions = [
            [
                'id' => 1,
                'question' => __('messages.track.questions.questions.question_1.question'),
                'answer' => __('messages.track.questions.questions.question_1.answer'),
            ],
            [
                'id' => 2,
                'question' => __('messages.track.questions.questions.question_2.question'),
                'answer' => __('messages.track.questions.questions.question_2.answer'),
            ],
            [
                'id' => 3,
                'question' => __('messages.track.questions.questions.question_3.question'),
                'answer' => __('messages.track.questions.questions.question_3.answer'),
            ],
            [
                'id' => 4,
                'question' => __('messages.track.questions.questions.question_4.question'),
                'answer' => __('messages.track.questions.questions.question_4.answer'),
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
