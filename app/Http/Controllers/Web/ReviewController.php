<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{

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
