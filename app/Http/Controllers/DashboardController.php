<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\Order;

class DashboardController extends Controller
{

    public function __construct()
    {
    }

    public function home()
    {
        return view('dashboard.dashboard');
    }

    public function getOrders(Request $request)
    {
        try{

            // Get search_criteria from query params, default to "weekly"
            $searchCriteria = $request->query('search_criteria', 'weekly');

            // Determine the date range based on search_criteria
            $now = Carbon::now();
            switch ($searchCriteria) {
                case 'monthly': // Last 4 weeks
                    $startDate = $now->copy()->subWeeks(4)->startOfDay();
                    $endDate = Carbon::now()->endOfDay();
                    $interval = 'weeks'; // Group by week
                    $chunkSize = 1; // 1 week chunks
                    break;

                case 'yearly':
                    $startDate = $now->subMonths(6)->startOfDay();
                    $endDate = Carbon::now()->endOfDay();
                    $interval = 'months'; // Group by month
                    $chunkSize = 1; // 1 month chunks
                    break;

                default: // Weekly by default
                    $startDate = $now->subDays(6)->startOfDay(); // Last 7 days
                    $endDate = Carbon::now()->endOfDay();
                    $interval = 'days'; // Group by day
                    $chunkSize = 1; // 1 day chunks
                    break;
            }

            // Retrieve orders within the date range
            $orders = Order::whereBetween('created_at', [$startDate, $endDate])->get();

            // Process the orders and group by the desired criteria
            $response = [];

            for ($date = $startDate->copy(); $date->lte($endDate); $date->add($chunkSize, $interval)) {

                $chunkStart = $date->copy();

                if ($interval == 'days') {
                    // For weekly intervals, subtract one second to get the exact end time
                    $chunkEnd = $date->copy()->add($chunkSize, $interval)->subSecond();

                } else {
                    // For daily intervals, use end of the day
                    $chunkEnd = $date->copy()->add($chunkSize, $interval)->endOfDay();
                }

                $chunkOrders = $orders->filter(function ($order) use ($chunkStart, $chunkEnd) {
                    $createdAt = Carbon::parse($order->created_at);
                    return $createdAt >= $chunkStart && $createdAt <= $chunkEnd;
                });

                $response[] = [
                    'start_date' => $chunkStart->format('d/m/Y'),
                    'end_date' => $chunkEnd->format('d/m/Y'),
                    'active' => $chunkOrders->whereNotIn('status', ['COMPLETED'])->where('canceled', false)->count(),
                    'completed' => $chunkOrders->where('status', 'COMPLETED')->count(),
                    'cancelled' => $chunkOrders->where('canceled', true)->count(),
                ];
            }

            // Return the JSON response
            return response()->json($response);
        } catch (\Exception $e) {
            // Log the error message
            Log::error('An error occurred: ' . $e->getMessage(), ['exception' => $e]);
        }
    }

    public function getOrdersAmount(Request $request)
    {
        try{

            // Get search_criteria from query params, default to "weekly"
            $searchCriteria = $request->query('search_criteria', 'weekly');

            // Determine the date range based on search_criteria
            $now = Carbon::now();
            switch ($searchCriteria) {
                case 'monthly': // Last 4 weeks
                    $startDate = $now->copy()->subWeeks(4)->startOfDay();
                    $endDate = Carbon::now()->endOfDay();
                    $interval = 'weeks'; // Group by week
                    $chunkSize = 1; // 1 week chunks
                    break;

                case 'yearly':
                    $startDate = $now->subMonths(6)->startOfDay();
                    $endDate = Carbon::now()->endOfDay();
                    $interval = 'months'; // Group by month
                    $chunkSize = 1; // 1 month chunks
                    break;

                default: // Weekly by default
                    $startDate = $now->subDays(6)->startOfDay(); // Last 7 days
                    $endDate = Carbon::now()->endOfDay();
                    $interval = 'days'; // Group by day
                    $chunkSize = 1; // 1 day chunks
                    break;
            }

            // Retrieve orders within the date range
            $orders = Order::whereBetween('created_at', [$startDate, $endDate])->get();

            // Process the orders and group by the desired criteria
            $response = [];

            for ($date = $startDate->copy(); $date->lte($endDate); $date->add($chunkSize, $interval)) {

                $chunkStart = $date->copy();

                if ($interval == 'days') {
                    // For weekly intervals, subtract one second to get the exact end time
                    $chunkEnd = $date->copy()->add($chunkSize, $interval)->subSecond();

                } else {
                    // For daily intervals, use end of the day
                    $chunkEnd = $date->copy()->add($chunkSize, $interval)->endOfDay();
                }

                $chunkOrders = $orders->filter(function ($order) use ($chunkStart, $chunkEnd) {
                    $createdAt = Carbon::parse($order->created_at);
                    return $createdAt >= $chunkStart && $createdAt <= $chunkEnd;
                });

                $response[] = [
                    'start_date' => $chunkStart->format('d/m/Y'),
                    'end_date' => $chunkEnd->format('d/m/Y'),
                    'active' => $chunkOrders->whereNotIn('status', ['COMPLETED'])->where('canceled', false)->sum('net_amount'),
                    'completed' => $chunkOrders->where('status', 'COMPLETED')->sum('net_amount'),
                    'cancelled' => $chunkOrders->where('canceled', true)->sum('net_amount'),
                ];
            }

            // Return the JSON response
            return response()->json($response);
        } catch (\Exception $e) {
            // Log the error message
            Log::error('An error occurred: ' . $e->getMessage(), ['exception' => $e]);
        }
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
