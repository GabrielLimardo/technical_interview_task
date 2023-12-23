<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;
// use Carbon\Carbon;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->all();
        $connection = $request->get('operator');
        $query = Item::query();

        $data = [
            'id'=> true ,
            'name'=> true,
            'code'=> true,
            'ean'=> true
        ];

        foreach ($filters as $key => $value) {
            if (isset($data[$key])) {
                if (isset($value)) {
                    $this->applyFilter($query,$key,$request->get("{$key}_filter"),$value ,$connection);
                }
            }

        }

        $orderBy = $request->input('orderBy', 'desc');
        $query->orderBy('updated_at', $orderBy);

        if ($request->has('clearFilters')) {
            return redirect()->route('items.index');
        }

       $perPage = $request->input('perPage', 20);

       $items = $query->paginate($perPage);

      $items = $query->get();

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
            break;
            default:
            break;
        }
    }

}
