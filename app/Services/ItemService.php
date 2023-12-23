<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemService
{
    public function filterItems(Request $request)
    {
        $filters = $request->all();
        $connection = $request->get('operator');
        $query = Item::query();

        if (isset($filters['fields'])) {
            foreach ($filters['fields'] as $key => $value) {
                if (isset($value) && isset($filters['filterValues'][$key])) {
                    $this->applyFilter($query, $value, $filters['filterTypes'][$key], $filters['filterValues'][$key], $connection);
                }
            }
        }

        $orderBy = $request->input('orderBy', 'desc');
        $query->orderBy('updated_at', $orderBy);

        if ($request->has('clearFilters')) {
            return Item::paginate(20);
        }

        $perPage = $request->input('perPage', 20);
        return $query->paginate($perPage);
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
            break;
            default:
            break;
        }
    }

    private function applyPriceRangeFilter($query, $range)
    {
        $minPrice = isset($range['min']) ? $range['min'] : null;
        $maxPrice = isset($range['max']) ? $range['max'] : null;

        if ($minPrice !== null) {
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice !== null) {
            $query->where('price', '<=', $maxPrice);
        }
    }
}
