@extends('adminlte::page')

@section('title', 'Servifacil | Home')


@section('content_header')
    <h1>Home</h1>
@stop

@section('content')

    @can('mgmt.desk')
        <x-adminlte-small-box title="Mesas" text="Añadir mesas" icon="fas fa-chart-bar" theme="info" url="mgmt/desk"
            url-text="¡Clica aquí!" />
    @endcan

    @can('create.dish')
        <x-adminlte-small-box title="Platos" text="Añadir platos" icon="fas fa-chart-bar" theme="teal" url="dish/create"
            url-text="¡Clica aquí!" />
    @endcan

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
