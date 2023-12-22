@extends('layouts.app')

@section('content')

    <!-- resources/views/items/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
</head>
<body>
    <h1>Lista de Productos</h1>

    <!-- Formulario de filtrado -->
    <form action="{{ url('/items') }}" method="get">

        <button type="submit" name="clearFilters" value="true">Limpiar Filtros</button>

        <label for="perPage">Mostrar:</label>
        <select name="perPage" id="perPage" onchange="this.form.submit()">
            <option value="5" {{ Request::input('perPage') == 5 ? 'selected' : '' }}>5 productos</option>
            <option value="10" {{ Request::input('perPage') == 10 ? 'selected' : '' }}>10 productos</option>
            <option value="15" {{ Request::input('perPage') == 15 ? 'selected' : '' }}>15 productos</option>
            <option value="30" {{ Request::input('perPage') == 15 ? 'selected' : '' }}>15 productos</option>
            <!-- Puedes agregar más opciones según lo necesites -->
        </select>

        <div>
            <input type="date" name="updated_at" id="updated_at" value="{{ request('updated_at') }}">
        </div>

        <div>
        <!-- Agregar un campo para el operador (AND/OR) -->
            <select name="operator">
                <option value="AND">AND</option>
                <option value="OR">OR</option>
            </select>
        </div>
        <!-- Filtrado por ID -->
        <div>
            <label for="id">ID:</label>
            <select name="id_filter">
                <option value="contains">Contiene</option>
                <option value="does_not_contain">No contiene</option>
                <option value="is">Es igual a</option>
                <option value="is_not">Es diferente de</option>
            </select>
            <input type="text" name="id" id="id" value="{{ request('id') }}">
        </div>

        <!-- Filtrado por Nombre -->
        <div>
            <label for="name">Nombre:</label>
            <select name="name_filter">
                <option value="contains">Contiene</option>
                <option value="does_not_contain">No contiene</option>
                <option value="is">Es igual a</option>
                <option value="is_not">Es diferente de</option>
            </select>
            <input type="text" name="name" id="name" value="{{ request('name') }}">
        </div>

        <!-- Filtrado por Código -->
        <div>
            <label for="code">Código:</label>
            <select name="code_filter">
                <option value="contains">Contiene</option>
                <option value="does_not_contain">No contiene</option>
                <option value="is">Es igual a</option>
                <option value="is_not">Es diferente de</option>
            </select>
            <input type="text" name="code" id="code" value="{{ request('code') }}">
        </div>

        <!-- Filtrado por EAN -->
        <div>
            <label for="ean">EAN:</label>
            <select name="ean_filter">
                <option value="contains">Contiene</option>
                <option value="does_not_contain">No contiene</option>
                <option value="is">Es igual a</option>
                <option value="is_not">Es diferente de</option>
            </select>
            <input type="text" name="ean" id="ean" value="{{ request('ean') }}">
        </div>

        <!-- Botón para enviar el formulario -->
        <div>
            <button type="submit">Filtrar</button>
        </div>
    </form>

    <!-- Tabla de productos -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Código</th>
                <th>EAN</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td><img src="{{ $item->photo }}" alt="{{ $item->name }}" width="100"></td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->code }}</td>
                <td>{{ $item->ean }}</td>
                <td>{{ $item->price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

@endsection
