@extends('adminlte::page')

@section('title', 'Servifacil | Cook')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center" style="height: 75vh;">
        {{-- Carrusel para mostrar las mesas --}}
        <div id="mesasCarousel" class="carousel slide" data-ride="carousel" data-interval="false"
            style="width: 75%; height: 75%;">
            {{-- Contenido del carrusel --}}
            <div class="carousel-inner">
                {{-- Iterar sobre cada mesa --}}
                @foreach ($mesas as $index => $mesa)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        {{-- Comprobar si la mesa tiene comandas --}}
                        @if ($mesa->comandas->isNotEmpty())
                            {{-- Crear un nuevo div para cada mesa --}}
                            <div class="card">
                                <div class="card-header bg-dark text-white">
                                    <h4 class="card-title">Mesa {{ $mesa->id }}</h4>
                                    <span class="float-right">Comandas: {{ $mesa->comandas->count() }}</span>
                                </div>
                                <div class="card-body">
                                    {{-- Iterar sobre cada tipo de producto --}}
                                    @foreach ($mesa->comandas->flatMap->productos->sortBy('tipo')->groupBy('tipo') as $tipo => $productos)
                                        <h5>{{ $tipo }}</h5>
                                        <ul class="list-group">
                                            {{-- Iterar sobre cada producto de este tipo --}}
                                            @foreach ($productos as $producto)
                                                <li class="list-group-item">{{ $producto->nombre }} - Precio:
                                                    {{ $producto->precio }}</li>
                                            @endforeach
                                        </ul>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            {{-- Botones de navegación --}}
            <a class="carousel-control-prev" href="#mesasCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#mesasCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
@stop
