@extends('adminlte::page')

@section('title', 'Servifacil | Cook')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        {{-- @dd($mesas); --}}
                        @if ($mesas->count() > 0)
                            @foreach ($mesas as $mesa)
                                @foreach ($mesa->comandas as $comanda)
                                    @foreach ($comanda->productos as $index => $producto)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <div class="card">
                                                <img src="{{ asset('img/' . $producto->imagen) }}" class="card-img-top"
                                                    alt="{{ $producto->imagen }}">
                                                <div class="card-body">
                                                    <h4 class="card-title">{{ $producto->nombre }}</h4>
                                                    <p class="card-text">Número de mesa: <b>{{ $mesa->id }}</b></p>
                                                    <p class="card-text">Cantidad de producto:
                                                        <b>{{ $producto->pivot->cantidad }}</b></p>
                                                    <p class="card-text">Producto: <b>{{ $producto->nombre }}</b></p>
                                                    <p class="card-text">Alergias:
                                                        <b>
                                                            @if ($producto->alergenos->isEmpty())
                                                                No tiene alergenos.
                                                            @else
                                                                @foreach ($producto->alergenos as $alergeno)
                                                                    {{ $alergeno->nombre }},
                                                                @endforeach
                                                            @endif
                                                        </b>
                                                    </p>
                                                    <p class="card-text">Comentarios:
                                                        <b>{{ $producto->pivot->comentarios }}</b></p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            @endforeach
                        @else
                            <div class="col-md-12">
                                <div class="alert alert-info">
                                    No hay platos disponibles.
                                </div>
                            </div>
                        @endif
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
