<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
    }

    public function home()
    {
        return view('dashboard.dashboard');
    }

    public function orders()
    {
        return view('dashboard.orders');
    }

    public function transports()
    {
        return view('dashboard.transports');
    }

    public function history()
    {
        return view('dashboard.history');
    }

    public function billing()
    {
        return view('dashboard.billing');
    }

    public function web(Request $request)
    {
        return view('dashboard.web');
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
