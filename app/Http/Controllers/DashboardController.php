<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class DashboardController extends Controller
{

    public function __construct()
    {
    }

    public function home()
    {
        return view('dashboard.dashboard');
    }

    public function services()
    {
        return view('dashboard.services');
    }

    public function orders()
    {
        return view('dashboard.orders');
    }

    public function transports()
    {
        return view('dashboard.transports');
    }

    public function billing()
    {
        return view('dashboard.billing');
    }

    public function web(Request $request)
    {
        // Retrieve the 'type' and 'page' query parameters
        $type = $request->input('type','review'); // Get the 'type' parameter
        $perPage = 10; // Default items per page
        $currentPage = $request->input('page', 1); // Get the current page from the request, defaulting to 1

        // Initialize the pagination variable
        $pagination = ['currentPage'=> 1, 'lastPage'=>1];

        if ($type === 'review') {
            // Retrieve paginated reviews
            $data = Review::paginate($perPage);

        } else {
            // Handle other types if needed (this part can be adjusted based on your requirements)
            $data = [];
        }

        // Pass the content array and pagination to the view
        return view('dashboard.web', [
            'type' => $type,
            'pagination' => $data, // Pass the pagination variable
        ]);
    }

    public function profile()
    {
        return view('dashboard.profile');
    }

    public function config()
    {
        return view('dashboard.config');
    }
}
