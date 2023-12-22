<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::query();

           // Aplicar filtros basados en AND o OR
        if ($request->has('filters')) {
            $filters = $request->input('filters');

            foreach ($filters as $filter) {
                $this->applyFilter($query, $filter['column'], $filter['type'], $filter['value'], $filter['operator']);
            }
        }


        // Filtrado por ID
        if ($request->has('id')) {
            $this->applyFilter($query, 'id', $request->input('id_filter'), $request->input('id'));
        }

        // Filtrado por nombre
        if ($request->has('name')) {
            $this->applyFilter($query, 'name', $request->input('name_filter'), $request->input('name'));
        }

        // Filtrado por código
        if ($request->has('code')) {
            $this->applyFilter($query, 'code', $request->input('code_filter'), $request->input('code'));
        }

        // Filtrado por EAN
        if ($request->has('ean')) {
            $this->applyFilter($query, 'ean', $request->input('ean_filter'), $request->input('ean'));
        }

        if ($request->has('clearFilters')) {
            return redirect()->route('items.index');
        }

        //TODO
        if ($request->has('updated_at')) {
            $this->applyFilter($query, 'updated_at', $request->input('updated_at_filter'), $request->input('updated_at'));
        }

       // Establecer cantidad de productos por página
       $perPage = $request->input('perPage', 10); // 10 por defecto

       // Obtener los productos paginados
       $items = $query->paginate($perPage);

        // Ejecuta la consulta
        $items = $query->get();

        return view('items.index', compact('items'));
    }

    private function applyFilter($query, $column, $filterType, $value)
    {
        switch ($filterType) {
            case 'contains':
                $query->where($column, 'LIKE', '%' . $value . '%');
                break;
            case 'does_not_contain':
                $query->where($column, 'NOT LIKE', '%' . $value . '%');
                break;
            case 'is':
                $query->where($column, $value);
                break;
            case 'is_not':
                $query->where($column, '!=', $value);
                break;
            case 'updated_at':
                $query->whereDate('updated_at', now()->toDateString());
                break;
            default:
                break;
        }
    }
}
