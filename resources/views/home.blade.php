@extends('adminlte::page')

@section('title', 'Servifacil | Home')


@section('content_header')
    <h4>{{ __('Atajos') }}</h4>
@stop

@section('content')

    @can('mgmt.desk')
        <x-adminlte-small-box title="{{ __('Mesas') }}" text="{{ __('Añadir mesas') }}" icon="fas fa-chart-bar" theme="info"
            url="mgmt/desk" url-text="{{ __('¡Clica aquí!') }}" />

        <x-adminlte-small-box title="{{ __('Comanda') }}" text="{{ __('Crear comand') }}a" icon="fas fa-chart-bar" theme="info"
            url="/note/create" url-text="{{ __('¡Clica aquí!') }}" />
    @endcan

    @can('create.dish')
        <x-adminlte-small-box title="{{ __('Platos') }}" text="{{ __('Añadir platos') }}" icon="fas fa-chart-bar"
            theme="teal" url="dish/create" url-text="{{ __('¡Clica aquí!') }}" />
    @endcan

    @if ($errors->any())
        <script>
            Swal.fire({
                title: "Oops...",
                text: "{{ $errors->first() }}",
            });
        </script>
    @endif

    @if (session('success'))
        <script>
            Swal.fire({
                title: "Good job!",
                text: "{{ session('success') }}",
            });
        </script>
    @endif

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
