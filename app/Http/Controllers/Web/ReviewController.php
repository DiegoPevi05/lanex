<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\View\Components\WebReviewForm;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     *
     *
    */
    public function index(Request $request)
    {
        $filterKey = $request->input('filterKey'); // e.g., 'stars'
        $filterValue = $request->input('filterValue'); // e.g., '5'
        $perPage = 10;
        $query = Review::query();

         // Get the fields that can be filtered from the model
        $filterableFields = (new Review)->filterFields();

        // Extract just the values from the filterable fields for comparison
        $filterableValues = array_column($filterableFields, 'value');

        // Check if the filterKey is in the filterableValues and apply filtering
        if ($filterKey && in_array($filterKey, $filterableValues)) {
            // Determine if the filter value is numeric
            if (is_numeric($filterValue)) {
                $query->where($filterKey, '=', $filterValue); // Exact match for numeric fields
            } else {
                $query->where($filterKey, 'like', "%{$filterValue}%"); // Use like for string fields
            }
        }

        // Check if the filterKey is in the filterableFields and apply filtering
        if ($filterKey && in_array($filterKey, $filterableFields)) {
            $query->where($filterKey, 'like', "%{$filterValue}%");
        }

        // Paginate the filtered result
        $reviews = $query->paginate($perPage);


        return view('dashboard.web-review', [
            'pagination' => $reviews,
            'currentFilter' => $filterKey,
            'filters' => $filterableFields,
        ]);
    }

    /**
     * .Return the redenr of the form for creation of form
     */

    public function renderForm(Request $request)
    {
        // Retrieve the JSON data from the request body
        $data = json_decode($request->getContent(), true); // Decode JSON to an associative array
        // You can pass any data required for the form here
        $formRequest = $data['type'] ?? null; // Fetch the 'type' parameter safely
        $content = $data['content'] ?? null; // Fetch the 'content' parameter safely

        $review = null;

        if ($content) {
            $review = $content;
        };

        // Create the form component instance
        $formComponent = new WebReviewForm($formRequest, $review);

        // Render the component's view
        return $formComponent->render();
    }


    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'charge' => 'required|string|max:255',
            'date_review' => 'required|date',
            'review' => 'required|string|max:500',
            'stars' => 'required|integer|min:1|max:5',
        ];

        // Run validation
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        // Create the review if validation passes
        $review = Review::create($request->only([
            'name',
            'charge',
            'date_review',
            'review',
            'stars',
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Review created successfully',
            'data' => $review
        ], 201);
    }

    /**
     * Update the specified review in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the review by ID
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'success' => false,
                'message' => 'Review not found',
            ], 404);
        }

        // Define validation rules
        $rules = [
            'name' => 'sometimes|required|string|max:255',
            'charge' => 'sometimes|required|string|max:255',
            'date_review' => 'sometimes|required|date',
            'review' => 'sometimes|required|string|max:500',
            'stars' => 'sometimes|required|integer|min:1|max:5',
        ];

        // Run validation
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        // Update the review with the valid data
        $review->update($request->only([
            'name',
            'charge',
            'date_review',
            'review',
            'stars',
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Review updated successfully',
            'data' => $review
        ], 200);
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy($id)
    {
        // Find the review by ID
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'success' => false,
                'message' => 'Review not found',
            ], 404);
        }

        // Delete the review
        $review->delete();

        return response()->json([
            'success' => true,
            'message' => 'Review deleted successfully',
        ], 200);
    }
}
