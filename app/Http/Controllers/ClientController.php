<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Web\AbstractEntityController;
use App\Models\Client;
use App\Services\FormService;
use Illuminate\Http\Request;

class ClientController extends AbstractEntityController
{
    public function __construct(FormService $formService)
    {
        parent::__construct(new Client(), $formService);
    }

    public function searchByCompany(Request $request)
    {
        // Validate the search query input
        $request->validate([
            'company' => 'required|string|max:255',
        ]);

        // Retrieve clients based on the 'company' query, using a case-insensitive match
        $clients = Client::where('company', 'LIKE', '%' . $request->input('company') . '%')
            ->get(['id', 'company']); // Specify which fields to return

        // Return the results as a JSON response
        return response()->json($clients);
    }
}
