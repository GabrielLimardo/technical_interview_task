@extends('adminlte::page')

@section('title', 'Dashboard')

{{-- @if(!is_null(Auth::user()->company_id)) --}}

    @section('content_header')
        <h1>Dashboard</h1>
    @stop

    @section('content')
        <p>Welcome to this beautiful admin panel.</p>
    @stop

    {{-- @include('company.createsinheader') --}}

{{-- @else
    @section('content_header')
    <h1>Paso 1</h1>
    @stop


@endif --}}

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
