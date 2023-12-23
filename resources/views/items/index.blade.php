@extends('adminlte::page')


@section('css')
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@stop



@section('template_title')
    Item List
@endsection
@section('content')


{{-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

@section('css')
    <link rel="stylesheet" href="/css/style.css">
@stop --}}

<section class="content container-fluid">
    <div class="items">
            @include('items.filter')

            @include('items.table')
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

@endsection


