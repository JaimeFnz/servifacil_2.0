@extends('adminlte::page')

@section('title', 'Servifacil | Dish')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 mt-5">
                @dd($dish)
                @if ($dish)
                    <div class="card">
                        <img src="{{ asset('img/' . $dish->imagen) }}" class="card-img-top" alt="{{ $dish->imagen }}">
                        <div class="card-body">
                            <h2 class="card-title w-100 text-center mb-3">{{ $dish->nombre }}</h2>
                            <div class="row">
                                <div class="col-md-6 text-dark">
                                    <p class="card-text"><strong>Precio:</strong> {{ $dish->precio }}</p>
                                    <p class="card-text"><strong>Alergias:</strong>
                                        {{ $dish->alergias ? $dish->alergias : 'No tiene alergenos' }}</p>
                                    <p class="card-text"><strong>Tipo:</strong> {{ ucfirst($dish->tipo) }}</p>
                                </div>
                                <div class="col-md-6 text-dark">
                                    <p class="card-text"><strong>Comentarios:</strong>
                                        {{ $dish->comentarios ? $dish->comentarios : 'No hay comentarios.' }}</p>
                                    <p class="card-text"><strong>Tiempo de preparación:</strong> {{ $dish->main }} minutos
                                    </p>
                                    <p class="card-text"><strong>Última actualización:</strong> {{ $dish->updated_at }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            No hay platos disponibles.
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop
