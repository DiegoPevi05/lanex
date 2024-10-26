<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Services\FormService;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{

    protected $formService;

    public function __construct(FormService $formService)
    {
        $this->formService = $formService;
    }
    /**
     *
     *
    */
    public function index(Request $request)
    {
        $filterKey = $request->input('filterKey'); // e.g., 'stars'
        $filterValue = $request->input('filterValue'); // e.g., '5'
        $perPage = 5;
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
        $entities = $query->paginate($perPage);


        return view(Review::getRedirectRoutes("index"), [
            'pagination' => $entities,
            'currentFilter' => $filterKey,
            'filters' => $filterableFields,
            'EntityType' => Review::getType()
        ]);
    }

    /**
     * .Return the redenr of the form for creation of form
     */

    public function renderForm(Request $request)
    {
        $formRequest = $request->input('formRequest', null);

        $typeEntity = $request->input('typeEntity', null);

        $idEntity = $request->input('idEntity', null);

        $entity = null;

        if($idEntity){
            $entity = Review::find($idEntity);
        }

        // Create the form component instance
        $formComponent = $this->formService->getFormComponent($formRequest,$typeEntity,$entity);

        if(!$formComponent){
            return response()->json([
                'success' => false,
            ], 500);
        }

        // Render the component's view
        return $formComponent->render();
    }


    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request)
    {
        $rules = Review::getValidationRules();
        $messages = Review::getValidationMessages();
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route(Review::getRedirectRoutes("store"))
                ->withErrors($validator)
                ->withInput()
                ->with('formRequest', 'create')
                ->with('error', Review::getErrorMessage('validation_failed'));
        };

        // Create the review if validation passes
        // Get only validated fields
        $validatedFields = $validator->validated();

        // Filter validated fields to include only fillable ones
        $fillableFields = Review::getFillableFields($validatedFields);

        // Create the review using filtered fields
        $entity = Review::create($fillableFields);

        return redirect()->route(Review::getRedirectRoutes("store"))->with('success', Review::getSuccessMessage('create'));
    }

    /**
     * Update the specified review in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the review by ID
        $entity = Review::find($id);

        if (!$entity) {
            return redirect()
                ->route(Review::getRedirectRoutes("update"))
                ->with('error', Review::getErrorMessage('not_found'));
        }

        $rules = Review::getValidationRules('update');
        $messages = Review::getValidationMessages();
        $validator = Validator::make($request->all(), $rules, $messages);


        if ($validator->fails()) {
            return redirect()
                ->route(Review::getRedirectRoutes("update"))
                ->with('formRequest', 'update')
                ->with('EntityId', $id)
                ->withErrors($validator) // Pass errors to the session
                ->withInput(); // Retain the input data
        };

        // Update the review with the valid data
        // Get only validated fields
        $validatedFields = $validator->validated();

        // Filter validated fields to include only fillable ones
        $fillableFields = Review::getFillableFields($validatedFields);

        $entity->update($fillableFields);

        return redirect()->route(Review::getRedirectRoutes("update"))->with('success', Review::getSuccessMessage('update'));
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy($id)
    {
        // Find the review by ID
        $entity = Review::find($id);

        if (!$entity) {
            return redirect()
                ->route(Review::getRedirectRoutes('destroy'))
                ->with('error', Review::getErrorMessage('not_found'));
        }

        // Delete the review
        $entity->delete();

        return redirect()->route(Review::getRedirectRoutes('destroy'))->with('success', Review::getSuccessMessage('delete'));
    }
}
