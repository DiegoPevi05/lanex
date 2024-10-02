<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class WebController extends Controller
{
    public function home()
    {
        return view('client.home');
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
        $service = Service::findOrFail($id);

        // Decode the JSON webcontent into an array
        $service->webcontent = json_decode($service->webcontent, true); // true converts it to an associative array

        // Pass the service data to the view
        return view('client.service', ['service' => $service]);
    }

    public function providers()
    {
        return view('client.providers');
    }

    public function contact()
    {
        return view('client.contact');
    }
}
