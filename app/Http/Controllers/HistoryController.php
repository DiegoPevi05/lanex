<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $perPage = 5;
        $query = Order::query();  // Add the "::" to correctly reference the model
        $query->where('canceled', true);
        $query->orWhere('status', 'COMPLETED');
        $orders = $query->paginate($perPage);

        return view('dashboard.history', [
            'pagination' => $orders,
        ]);
    }
}
