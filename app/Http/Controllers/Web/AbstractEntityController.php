<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

abstract class AbstractEntityController extends Controller
{
    protected $model;
    protected $formService;

    public function __construct(Model $model, $formService)
    {
        $this->model = $model;
        $this->formService = $formService;
    }

    public function index(Request $request)
    {
        $filterKey = $request->input('filterKey');
        $filterValue = $request->input('filterValue');
        $perPage = 5;
        $query = $this->model->query();

        $filterableFields = $this->model->filterFields();
        $filterableValues = array_column($filterableFields, 'value');

        if ($filterKey && in_array($filterKey, $filterableValues)) {
            $query->where($filterKey, 'like', "%{$filterValue}%");
        }

        $entities = $query->paginate($perPage);

        // Apply castFields if the method exists in the model
        if (method_exists($this->model, 'castFields')) {
            $entities->each(function ($entity) {
                $this->model::castFields($entity);
            });
        }

        return view($this->model::getRedirectRoutes("index"), [
            'pagination' => $entities,
            'currentFilter' => $filterKey,
            'filters' => $filterableFields,
            'EntityType' => $this->model::getType(),
        ]);
    }

    public function renderForm(Request $request)
    {
        $formRequest = $request->input('formRequest');
        $typeEntity = $request->input('typeEntity');
        $idEntity = $request->input('idEntity');
        $entity = $idEntity ? $this->model->find($idEntity) : null;

        if($entity && method_exists($this->model, 'castFields')){
            $this->model::castFields($entity);
        };

        $formComponent = $this->formService->getFormComponent($formRequest, $typeEntity, $entity);

        return $formComponent ? $formComponent->render() : response()->json(['success' => false], 500);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), $this->model::getValidationRules(), $this->model::getValidationMessages());

        if ($validator->fails()) {
            return redirect()->route($this->model::getRedirectRoutes("store"))
                ->withErrors($validator)
                ->withInput()
                ->with('formRequest', 'create')
                ->with('error', $this->model::getErrorMessage('validation_failed'));
        }

        $entity = $this->model->create($this->model::getFillableFields($validator->validated(), $request ));

        return redirect()->route($this->model::getRedirectRoutes("store"))->with('success', $this->model::getSuccessMessage('create'));
    }

    public function update(Request $request, $id)
    {
        $entity = $this->model->find($id);

        if (!$entity) {
            return redirect()->route($this->model::getRedirectRoutes("update"))
                ->with('error', $this->model::getErrorMessage('not_found'));
        }


        $validator = Validator::make($request->all(), $this->model::getValidationRules('update'), $this->model::getValidationMessages());

        if ($validator->fails()) {
            return redirect()->route($this->model::getRedirectRoutes("update"))
                ->withErrors($validator)
                ->withInput()
                ->with('formRequest', 'update')
                ->with('EntityId', $id);
        }

        // Pass the current entity to getFillableFields
        $entityData = $this->model::getFillableFields($validator->validated(), $request, $entity);

        $entity = $entity->update($entityData);

        return redirect()->route($this->model::getRedirectRoutes("update"))->with('success', $this->model::getSuccessMessage('update'));
    }

    public function destroy($id)
    {
        $entity = $this->model->find($id);

        if (!$entity) {
            return redirect()->route($this->model::getRedirectRoutes("destroy"))
                ->with('error', $this->model::getErrorMessage('not_found'));
        }

        $entity->delete();

        return redirect()->route($this->model::getRedirectRoutes("destroy"))->with('success', $this->model::getSuccessMessage('delete'));
    }
}
