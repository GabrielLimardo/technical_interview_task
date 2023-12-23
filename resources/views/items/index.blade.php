@extends('layouts.app')

@section('content')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Item List</title>

    <style>
        body {
            font-family: sans-serif;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            background-color: #f2f2f2;
        }

        .filter {
            display: flex;
            align-items: center;
            padding: 10px 0;
        }

        .filter button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
        }

        .perPage {
            margin-right: 10px;
        }

        .orderBy, .operator, .selectFilter {
            display: flex;
            margin-bottom: 10px;
        }

        .selectFilter label, .orderBy label {
            margin-right: 10px;
        }

        .selectFilter select {
            width: 150px;
        }

        .table {
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 20px;
            width: 100%;
        }

        .table th, .table td {
            padding: 20px;
            margin: 10px;
            text-align: center;
            border: 1px solid #ccc;
        }

        td {
            padding: 10px;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .table th, .table td {
            width: 25%;
        }

        .photo {
            width: 100px;
            height: auto;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Item List</h1>

    <div>
        <h2>Filter:</h2>
        <form action="{{ url('/items') }}" method="get">
            <button type="submit" name="clearFilters" value="true">Clear Filters</button>

            <label for="perPage">Show:</label>
            <select name="perPage" id="perPage" onchange="this.form.submit()">
                <option value="5" {{ Request::input('perPage', 30) == 5 ? '' : 'selected' }}>5 products</option>
                <option value="10" {{ Request::input('perPage', 30) == 10 ? '' : 'selected' }}>10 products</option>
                <option value="15" {{ Request::input('perPage', 30) == 15 ? '' : 'selected' }}>15 products</option>
                <option value="30" {{ Request::input('perPage', 30) == 30 ? 'selected' : '' }}>30 products</option>
            </select>

            <div>
                <label for="orderBy">Sort by last modification:</label>
                <select name="orderBy" id="orderBy">
                    <option value="desc">Most recent to oldest</option>
                    <option value="asc">Oldest to most recent</option>
                </select>
            </div>

            <div>
                <select name="operator">
                    <option value="AND">AND</option>
                    <option value="OR">OR</option>
                </select>
            </div>

            <div>
                <label for="id">ID:</label>
                <select name="id_filter">
                    <option value="contains">Contains</option>
                    <option value="does_not_contain">Does not contain</option>
                    <option value="is">Is equal to</option>
                    <option value="is_not">Is not equal to</option>
                </select>
                <input type="text" name="id" id="id" value="{{ request('id') }}">
            </div>

            <div>
                <label for="name">Name:</label>
                <select name="name_filter">
                    <option value="contains">Contains</option>
                    <option value="does_not_contain">Does not contain</option>
                    <option value="is">Is equal to</option>
                    <option value="is_not">Is not equal to</option>
                </select>
                <input type="text" name="name" id="name" value="{{ request('name') }}">
            </div>

            <div>
                <label for="code">Code:</label>
                <select name="code_filter">
                    <option value="contains">Contains</option>
                    <option value="does_not_contain">Does not contain</option>
                    <option value="is">Is equal to</option>
                    <option value="is_not">Is not equal to</option>
                </select>
                <input type="text" name="code" id="code" value="{{ request('code') }}">
            </div>

            <div>
                <label for="ean">EAN:</label>
                <select name="ean_filter">
                    <option value="contains">Contains</option>
                    <option value="does_not_contain">Does not contain</option>
                    <option value="is">Is equal to</option>
                    <option value="is_not">Is not equal to</option>
                </select>
                <input type="text" name="ean" id="ean" value="{{ request('ean') }}">
            </div>

            <div>
                <button type="submit">Filter</button>
            </div>
        </form>
    </div>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Code</th>
                <th>EAN</th>
                <th>Price</th>
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
