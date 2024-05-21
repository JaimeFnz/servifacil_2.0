@extends('adminlte::page')

@section('title', 'Servifacil | Dishes')

@section('content')
    <div class="container mt-4">
        <div class="row">
            @if ($dishes->count() > 0)
                @foreach ($dishes as $dish)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card h-100">
                            <a href="{{ route('dish.show', $dish->id) }}">
                                <img src="{{ asset('img/' . $dish->imagen) }}" class="card-img-top" alt="{{ $dish->imagen }}">
                                <div class="card-body text-dark">
                                    <h4 class="card-title">{{ $dish->nombre }}</h4>
                                    <p class="card-text">Precio: <b>{{ $dish->precio }}</b></p>
                                    <p class="card-text"><strong>Alergias:</strong>
                                        @if (!empty($dish->alergenos))
                                            {{ implode(', ', $dish->alergenos->pluck('nombre')->toArray()) }}
                                        @else
                                            No tiene alergenos.
                                        @endif
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12">
                    <div class="alert alert-info">
                        No hay platos disponibles.
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop
