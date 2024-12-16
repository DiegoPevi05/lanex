<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Web\AbstractEntityController;
use App\Models\Order;
use App\Services\FormService;
use Illuminate\Http\Request;

class HistoryController extends AbstractEntityController
{
    public function __construct(FormService $formService)
    {
        parent::__construct(new Order(), $formService);
    }

    public function index(Request $request)
    {
        $filterKey = $request->input('filterKey');
        $filterValue = $request->input('filterValue');
        $perPage = 5;
        $query = $this->model->query();

        // Filter for orders where canceled is false
        $query->where('canceled', true)->orWhere('status', 'COMPLETED');

        $filterableFields = $this->model->filterFields();
        $filterableValues = array_column($filterableFields, 'value');

        if ($filterKey && in_array($filterKey, $filterableValues)) {
            $query->where($filterKey, 'like', "%{$filterValue}%");
        }

        $entities = $query->paginate($perPage);

        return view($this->model::getRedirectRoutes("index"), [
            'pagination' => $entities,
            'currentFilter' => $filterKey,
            'filters' => $filterableFields,
            'EntityType' => "history",
        ]);
    }
}
