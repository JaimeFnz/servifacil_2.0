@extends('adminlte::page')

@section('content')
    <div class="container mt-4">
        <div class="row">
            {{-- @dd($dishes); --}}
            @if (count($dishes) > 0)
                @foreach ($dishes as $dish)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card">
                            <img src="{{ asset('img/' . $dish->imagen) }}" class="card-img-top" alt="{{ $dish->imagen }}">
                            <div class="card-body">
                                <h4 class="card-title">{{ $dish->nombre }}</h4>
                                <p class="card-text">Precio: <b>{{ $dish->precio }}</b></p>
                                @if (!empty($dish->alergenos))
                                    @foreach ($dish->alergenos as $alergeno)
                                        {{ $alergeno }}
                                    @endforeach
                                @else
                                    No tiene alergenos.
                                @endif
                            </div>
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
