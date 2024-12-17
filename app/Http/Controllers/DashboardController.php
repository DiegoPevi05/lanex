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

    public function home(Request $request)
    {

        $perPage = 2;
        $query = Order::query();  // Add the "::" to correctly reference the model
        $query->where('canceled', false);
        $query->whereIn('status', ['IN_TRANSIT','PENDING']);
        $orders = $query->paginate($perPage);

        return view('dashboard.dashboard', [
            'pagination' => $orders,
        ]);
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
            $chunkStart = $startDate->copy();

            while ($chunkStart->lte($endDate)) {
                $chunkEnd = $chunkStart->copy()->add($chunkSize, $interval)->subSecond();

                // Ensure chunkEnd does not exceed endDate
                if ($chunkEnd->gt($endDate)) {
                    $chunkEnd = $endDate->copy();
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

                // Move to the next chunk
                $chunkStart = $chunkEnd->copy()->addSecond();
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
            $chunkStart = $startDate->copy();

            while ($chunkStart->lte($endDate)) {
                $chunkEnd = $chunkStart->copy()->add($chunkSize, $interval)->subSecond();

                // Ensure chunkEnd does not exceed endDate
                if ($chunkEnd->gt($endDate)) {
                    $chunkEnd = $endDate->copy();
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

                // Move to the next chunk
                $chunkStart = $chunkEnd->copy()->addSecond();
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
