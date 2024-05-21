@extends('adminlte::page')

@section('title', 'Servifacil | Home')


@section('content_header')
    <h1>Home</h1>
@stop

@section('content')
    <x-adminlte-alert>Minimal example</x-adminlte-alert>
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        // Swal.fire({
        //     title: "Good job!",
        //     text: "You clicked the button!",
        //     icon: "success",
        // });
    </script>
@stop
