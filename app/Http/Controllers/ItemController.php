<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::query();

        if ($request->has('filters')) {
            $filters = $request->input('filters');

            foreach ($filters as $filter) {
                $this->applyFilter($query, $filter['column'], $filter['type'], $filter['value'], $filter['operator']);
            }
        }

        if ($request->has('id')) {
            $this->applyFilter($query, 'id', $request->input('id_filter'), $request->input('id'),$request->input('operator'));
        }

        if ($request->has('name')) {
            $this->applyFilter($query, 'name', $request->input('name_filter'), $request->input('name'),$request->input('operator'));
        }

        if ($request->has('code')) {
            $this->applyFilter($query, 'code', $request->input('code_filter'), $request->input('code'),$request->input('operator'));
        }

        if ($request->has('ean')) {
            $this->applyFilter($query, 'ean', $request->input('ean_filter'), $request->input('ean'),$request->input('operator'));
        }

        $orderBy = $request->input('orderBy', 'desc');
        $query->orderBy('updated_at', $orderBy);

        if ($request->has('clearFilters')) {
            return redirect()->route('items.index');
        }

       $perPage = $request->input('perPage', 10);

       $items = $query->paginate($perPage);

        $items = $query->get();
        // dd($query->toSql());

        return view('items.index', compact('items'));
    }

    private function applyFilter($query, $column, $filterType, $value, $logicalOperator = 'AND')
    {
        $method = ($logicalOperator == 'AND') ? 'where' : 'orWhere';

        switch ($filterType) {
            case 'contains':
            $query->{$method}($column, 'LIKE', '%' . $value . '%');
            break;
            case 'does_not_contain':
            $query->{$method}($column, 'NOT LIKE', '%' . $value . '%');
            break;
            case 'is':
            $query->{$method}($column, $value);
            break;
            case 'is_not':
            $query->{$method}($column, '!=', $value);
            break;
            case 'updated_at':
            $query->{$method . 'Date'}('updated_at', $value);
            // Agregar declaración break aquí
            break;
            default:
            break;
        }
    }

}
