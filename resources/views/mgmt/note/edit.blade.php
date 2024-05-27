@extends('adminlte::page')

@section('title', 'Servifacil | MGMT | Editar comanda')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center align-items-start" style="height: 90vh;">
            <div class="col-md-8 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Editar note</h3>
                    </div>
                    <div class="card-body">
                        {{-- Mostrar la información de la note --}}
                        <h4>Mesa: {{ $note->mesa->id }} - {{ $note->mesa->nombre }}</h4>
                        <hr>
                        <h4>Productos:</h4>
                        {{-- Iterar sobre los productos de la note --}}
                        <ul>
                            @foreach ($note->productos as $producto)
                                <li>{{ $producto->nombre }} - Precio: {{ $producto->precio }}</li>
                            @endforeach
                        </ul>
                        {{-- Campos de edición --}}
                        <hr>
                        <div class="text-right">
                            {{-- Botón para guardar los cambios --}}
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            {{-- Botón para cancelar la edición --}}
                            <a href="{{ route('note.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
