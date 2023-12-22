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
            $this->applyFilter($query, 'id', $request->input('id_filter'), $request->input('id'));
        }

        if ($request->has('name')) {
            $this->applyFilter($query, 'name', $request->input('name_filter'), $request->input('name'));
        }

        if ($request->has('code')) {
            $this->applyFilter($query, 'code', $request->input('code_filter'), $request->input('code'));
        }

        // Filtrado por EAN
        if ($request->has('ean')) {
            $this->applyFilter($query, 'ean', $request->input('ean_filter'), $request->input('ean'));
        }

        $orderBy = $request->input('orderBy', 'desc');
        $query->orderBy('updated_at', $orderBy);

        if ($request->has('clearFilters')) {
            return redirect()->route('items.index');
        }

       $perPage = $request->input('perPage', 10);

       $items = $query->paginate($perPage);

        $items = $query->get();

        return view('items.index', compact('items'));
    }

    private function applyFilter($query, $column, $filterType, $value, $operator = 'AND')
    {
        switch ($filterType) {
            case 'contains':
                if ($operator == 'AND') {
                    $query->where($column, 'LIKE', '%' . $value . '%');
                } else {
                    $query->orWhere($column, 'LIKE', '%' . $value . '%');
                }
                break;
            case 'does_not_contain':
                if ($operator == 'AND') {
                    $query->where($column, 'NOT LIKE', '%' . $value . '%');
                } else {
                    $query->orWhere($column, 'NOT LIKE', '%' . $value . '%');
                }
                break;
            case 'is':
                if ($operator == 'AND') {
                    $query->where($column, $value);
                } else {
                    $query->orWhere($column, $value);
                }
                break;
            case 'is_not':
                if ($operator == 'AND') {
                    $query->where($column, '!=', $value);
                } else {
                    $query->orWhere($column, '!=', $value);
                }
                break;
            case 'updated_at':
                if ($operator == 'AND') {
                    $query->whereDate('updated_at', $value);
                } else {
                    $query->orWhereDate('updated_at', $value);
                }
                break;
            default:
                break;
        }
    }
}
