<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FlightTracker;
use App\Models\WebService;
use App\Models\WebSupplier;
use App\Models\WebReview;
use App\Models\WebProduct;
use App\Models\WebBlog;
use App\Models\Subscription;
use App\Models\Setting;
use App\Notifications\CustomEmailNotification;
use App\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Throwable;

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

        $reviews = WebReview::orderBy('created_at', 'desc')->limit(4)->get();

        $blogs = WebBlog::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $blogs->each(function ($blog) {
            WebBlog::castFields($blog);
        });

        // Find the service by ID or throw a 404 error if not found
        $suppliers = WebSupplier::select('id', 'name', 'logo','webpage','category')->get();

        return view('client.home', ['questions' => $questions, 'suppliers' => $suppliers, 'blogs' => $blogs, 'reviews' => $reviews]);
    }

    public function getBlogs(Request $request)
    {
        // Get the current page from the query parameters, defaulting to 1
        $page = $request->query('page_blogs', 1);

        // Get the supplier_name filter from the request
        $blogContent = $request->query('blog_content', null);

        // Base query for suppliers
        $query = WebBlog::query();

        // Apply case-insensitive name filter if supplier_name is present
        $query->where('status', 'published');

        if ($blogContent) {
            $query->whereRaw('LOWER(content) LIKE ?', ['%' . strtolower($blogContent) . '%']);
        }

        // Paginate suppliers with a limit of 6 items per page
        $blogs = $query->paginate(6, ['*'], 'page', $page);

        // Append custom query parameters for pagination links
        $blogs->appends([
            'page_blogs' => $page,
            'blog_content' => $blogContent,
        ]);

        $blogs->each(function ($blog) {
            WebBlog::castFields($blog);
        });

        // Return a JSON response with the paginated suppliers
        return response()->json([
            'blogs' => $blogs,
        ]);
    }

    public function blog($id)
    {
        $blog = WebBlog::findOrFail($id);

        WebBlog::castFields($blog);

        return view('client.blog', ['blog' => $blog]);
    }

    public function blogs()
    {
        return view('client.blogs');
    }

    public function about()
    {
        $services = WebService::all();
        $blogs = WebBlog::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $blogs->each(function ($blog) {
            WebBlog::castFields($blog);
        });

        return view('client.about', ['services' => $services, 'blogs' => $blogs]);
    }

    public function services()
    {

        // Find the service by ID or throw a 404 error if not found
        $suppliers = WebSupplier::select('id', 'name', 'logo')->get();
        $blogs = WebBlog::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $blogs->each(function ($blog) {
            WebBlog::castFields($blog);
        });

        return view('client.services',['suppliers' => $suppliers, 'blogs' => $blogs]);
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
            $decoded = is_string($supplier->details) ? json_decode($supplier->details, true) : $supplier->details;
            $supplier->details = is_array($decoded) ? array_values(array_filter($decoded, 'is_string')) : [];
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
        $page = $request->query('page_products', 1);

        // Fetch the products associated with the supplier using the relationship
        $productsQuery = $supplier->products();

        // Paginate the products (6 per page)
        $products = $productsQuery->paginate(3, ['*'], 'page_products', $page);

        // Append query parameters for pagination links
        $products->appends([
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

            $adminEmails = Setting::getEmails('contact_notification_email', config('app.admin_email', env('APP_ADMIN_EMAIL', 'operaciones@lanexsac.com')));
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

            foreach ($adminEmails as $adminEmail) {
                $notifiable_admin = new AnonymousNotifiable($adminEmail);
                $notifiable_admin->notify($notification_admin);
            }

            return redirect()->route('contact')->with('success', __('messages.contact.success'));

        } catch (\Exception $e) {
            // Log the error message for debugging
            Log::error('Failed to send contact email: ' . $e->getMessage());

            // Redirect with an error message if email sending fails
            return redirect()->route('contact')->with('error', __('messages.contact.error'));
        }

    }

    public function claims()
    {
        return view('client.claims');
    }

    public function submitClaim(Request $request)
    {
        $validatedData = $request->validate([
            'claim_type' => 'required|in:reclamo,queja',
            'full_name' => 'required|string|max:255',
            'doc_type' => 'required|string|max:20',
            'doc_number' => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',
            'address' => 'required|string|max:255',
            'service_type' => 'required|string|max:255',
            'amount' => 'nullable|string|max:50',
            'detail' => 'required|string|max:2000',
            'request' => 'required|string|max:2000',
        ]);

        $claimCode = 'LR-' . date('Y') . '-' . str_pad(rand(100, 9999), 5, '0', STR_PAD_LEFT);

        try {
            // 1. Send confirmation copy to the consumer
            $notifiableConsumer = new AnonymousNotifiable($validatedData['email']);
            $notificationConsumer = new CustomEmailNotification(
                "Constancia de Reclamación Virtual — Código: {$claimCode}",
                "Estimado(a) {$validatedData['full_name']},",
                [
                    "Hemos recibido su " . strtoupper($validatedData['claim_type']) . " a través de nuestro Libro de Reclamaciones Virtual.",
                    "Código de Registro Oficial: {$claimCode}",
                    "Fecha y hora: " . now()->format('d/m/Y H:i:s'),
                    "Documento de Identidad: {$validatedData['doc_type']} {$validatedData['doc_number']}",
                    "Servicio reclamado: {$validatedData['service_type']}",
                    "Detalle: {$validatedData['detail']}",
                    "Pedido del reclamante: {$validatedData['request']}",
                    "Conforme a lo dispuesto por la Ley N° 29571 (Código de Protección y Defensa del Consumidor), daremos respuesta formal a su caso en un plazo máximo de quince (15) días hábiles."
                ],
                null,
                null,
                [
                    "EXPRESS LANE LOGISTICS S.A.C. — RUC: 20612739481",
                    "Domicilio legal: Callao, Lima - Perú"
                ],
                "Atentamente,\nÁrea de Atención al Consumidor — LanEx",
                'primary'
            );
            $notifiableConsumer->notify($notificationConsumer);

            // 2. Send notification to configured claims admin email(s)
            $claimsEmails = Setting::getEmails('claims_notification_email', config('app.admin_email', env('APP_ADMIN_EMAIL', 'operaciones@lanexsac.com')));
            $notificationAdmin = new CustomEmailNotification(
                "⚠️ [Nuevo Registro en Libro de Reclamaciones] {$claimCode} — " . strtoupper($validatedData['claim_type']),
                "Atención Equipo de Operaciones y Legal LanEx,",
                [
                    "Se ha registrado un nuevo " . strtoupper($validatedData['claim_type']) . " en el Libro de Reclamaciones Virtual.",
                    "Código Oficial: {$claimCode}",
                    "Consumidor: {$validatedData['full_name']} ({$validatedData['doc_type']} {$validatedData['doc_number']})",
                    "Correo: {$validatedData['email']}",
                    "Teléfono: {$validatedData['phone']}",
                    "Dirección: {$validatedData['address']}",
                    "Servicio: {$validatedData['service_type']}",
                    "Monto reclamado: " . ($validatedData['amount'] ?: 'No especificado'),
                    "Detalle del caso: {$validatedData['detail']}",
                    "Pedido formulado: {$validatedData['request']}",
                    "Plazo perentorio de respuesta: 15 días hábiles (Ley N° 29571)."
                ],
                "Ver Configuración de Correos",
                route('dashboard_settings'),
                [],
                "LanEx Logistics Telemetry & Compliance",
                'primary'
            );

            foreach ($claimsEmails as $adminEmail) {
                $notifiableAdmin = new AnonymousNotifiable($adminEmail);
                $notifiableAdmin->notify($notificationAdmin);
            }
        } catch (\Throwable $e) {
            Log::error('[Claims Email Notification Error] ' . $e->getMessage(), ['exception' => $e]);
        }

        return redirect()->route('claims')->with('success', "Su reclamación ha sido registrada satisfactoriamente con el código: {$claimCode}. Se ha enviado una constancia formal a su correo ({$validatedData['email']}). Conforme a Ley N° 29571, recibirá respuesta formal en un plazo máximo de quince (15) días hábiles.");
    }

    public function quote(Request $request)
    {
        // Retrieve the query parameters
        $type = $request->query('type', null);
        $id = $request->query('id', null);

        $product = null;
        $service = null;
        $supplier = null;
        $interestItem = null;

        if ($type && $id) {
            if ($type === 'product') {
                $product = WebProduct::with('suppliers')->find($id);
                $interestItem = $product;
            } elseif ($type === 'service') {
                $service = WebService::find($id);
                $interestItem = $service;
            } elseif ($type === 'supplier') {
                $supplier = WebSupplier::with('products')->find($id);
                $interestItem = $supplier;
            }
        }

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

        return view('client.quote', [
            'questions' => $questions,
            'product' => $product,
            'service' => $service,
            'supplier' => $supplier,
            'interestItem' => $interestItem,
            'type' => $type,
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
            'interest_type' => 'nullable|string|max:50',
            'interest_id' => 'nullable|string|max:50',
            'interest_name' => 'nullable|string|max:255',
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

            $quoteEmails = Setting::getEmails('quote_notification_email', config('app.admin_email', env('APP_ADMIN_EMAIL', 'operaciones@lanexsac.com')));

            $introLinesAdmin = [
                __('messages.quote.mail.intro_admin_1'),
                __('messages.quote.mail.intro_admin_2'),
            ];

            if (!empty($validatedData['interest_name'])) {
                $introLinesAdmin[] = '🎯 Requerimiento Específico: ' . strtoupper($validatedData['interest_type'] ?? 'GENERAL') . ' — ' . $validatedData['interest_name'];
            }

            $introLinesAdmin[] = __('messages.quote.mail.intro_admin_3') . ' : ' . $validatedData['full_name'];
            $introLinesAdmin[] = __('messages.quote.mail.intro_admin_4') . ' : ' . ($validatedData['company'] ?: 'No indicada');
            $introLinesAdmin[] = __('messages.quote.mail.intro_admin_5') . ' : ' . $validatedData['email'];
            $introLinesAdmin[] = __('messages.quote.mail.intro_admin_6') . ' : ' . $validatedData['cellphone'];
            $introLinesAdmin[] = __('messages.quote.mail.intro_admin_7') . ' : ' . $validatedData['departure_address'];
            $introLinesAdmin[] = __('messages.quote.mail.intro_admin_8') . ' : ' . $validatedData['arrival_address'];
            $introLinesAdmin[] = __('messages.quote.mail.intro_admin_9') . ' : ' . $validatedData['message'];

            $notification_admin = new CustomEmailNotification(
                __('messages.quote.mail.subject_admin') . (!empty($validatedData['interest_name']) ? ' [' . $validatedData['interest_name'] . ']' : ''),
                __('messages.quote.mail.greeting_admin'),
                $introLinesAdmin,
                null,
                null,
                [],
                null,
                null
            );

            foreach ($quoteEmails as $adminEmail) {
                $notifiable_admin = new AnonymousNotifiable($adminEmail);
                $notifiable_admin->notify($notification_admin);
            }

            return redirect()->route('quote')->with('success', __('messages.quote.success'));

        } catch (\Exception $e) {
            // Log the error message for debugging
            Log::error('Failed to send quote email: ' . $e->getMessage());

            // Redirect with an error message if email sending fails
            return redirect()->route('quote')->with('error', __('messages.quote.error'));
        }

    }

    public function submitSubscriptionForm(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ], [
            'email.required' => 'Por favor, ingresa tu correo electrónico.',
            'email.email'    => 'Ingresa una dirección de correo válida.',
        ]);

        $email = strtolower(trim($validated['email']));

        // Check if already subscribed to prevent duplicates
        if (Subscription::where('email', $email)->exists()) {
            return back()->with('info', '¡Este correo ya se encuentra suscrito a nuestro boletín de noticias!');
        }

        $traceId = (string) Str::uuid();

        try {
            // 1) Store subscription
            $subscription = Subscription::create(['email' => $email]);

            // 2) Email to subscriber (welcome & thank you)
            $notifiableUser = new AnonymousNotifiable($email);
            $notifiableUser->notify(new CustomEmailNotification(
                '¡Gracias por suscribirte al Boletín de LanEx!',
                '¡Bienvenido(a)!',
                [
                    'Gracias por unirte a nuestra comunidad de comercio exterior y logística internacional.',
                    'A través de este boletín recibirás periódicamente reportes de tarifas de flete marítimo y aéreo, novedades de aduanas SUNAT y consejos para optimizar tus importaciones y exportaciones.'
                ],
                'Visitar LanEx Logistics',
                route('home'),
                [
                    'Si deseas darte de baja en cualquier momento, puedes responder a este correo.',
                    'Express Lane Logistics S.A.C. — Callao, Perú.'
                ],
                "Atentamente,\nEquipo de LanEx Logistics",
                'primary'
            ));

            // 3) Email to admin(s)
            $adminEmails = Setting::getEmails('contact_notification_email', config('app.admin_email', env('APP_ADMIN_EMAIL', 'operaciones@lanexsac.com')));
            $notificationAdmin = new CustomEmailNotification(
                '📰 [Nuevo Suscriptor Web] ' . $email,
                'Hola Equipo LanEx,',
                [
                    'Un nuevo usuario se ha suscrito al boletín de noticias desde el portal web.',
                    'Correo del suscriptor: ' . $email,
                    'Fecha: ' . now()->format('d/m/Y H:i:s'),
                ],
                'Ver Directorio de Suscriptores',
                route('dashboard_subscribers'),
                [],
                'LanEx Notifications',
                'primary'
            );

            foreach ($adminEmails as $adminEmail) {
                (new AnonymousNotifiable($adminEmail))->notify($notificationAdmin);
            }

            return back()->with('success', '¡Gracias por suscribirte a nuestro boletín! Hemos registrado tu correo correctamente.');

        } catch (Throwable $e) {
            Log::error('[SUBSCRIBE] FAILED', [
                'traceId' => $traceId,
                'subscriberEmail' => $email,
                'message' => $e->getMessage(),
            ]);

            return back()->with('error', 'Ocurrió un error al procesar tu suscripción. Por favor, inténtalo nuevamente.');
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
