@extends('adminlte::page')

@section('title', 'Servifacil | Note')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center" style="height: 75vh;">
        {{-- Carrusel para mostrar las comandas --}}
        <div id="comandasCarousel" class="carousel slide" data-ride="carousel" data-interval="false"
            style="width: 75%; height: 75%;">
            {{-- Contenido del carrusel --}}
            <div class="carousel-inner">
                {{-- Iterar sobre cada mesa --}}
                {{-- @dd($mesas) --}}
                @foreach ($mesas as $mesa)
                    {{-- Iterar sobre cada comanda de la mesa --}}
                    @foreach ($mesa->comandas as $index => $comanda)
                        <div class="carousel-item {{ $loop->parent->first && $loop->first ? 'active' : '' }}">
                            {{-- Crear un nuevo div para cada comanda --}}
                            <div class="card">
                                <div class="card-header bg-dark text-white">
                                    <h4 class="card-title">Mesa {{ $mesa->id }}</h4>
                                    <span class="float-right">Comanda {{ $comanda->id }}</span>
                                </div>
                                <div class="card-body">
                                    {{-- Iterar sobre cada tipo de producto --}}
                                    @foreach ($comanda->productos->sortBy('tipo')->groupBy('tipo') as $tipo => $productos)
                                        <h5>{{ ucfirst($tipo) }}</h5>
                                        <ul class="list-group">
                                            {{-- Iterar sobre cada producto de este tipo --}}
                                            @foreach ($productos as $producto)
                                                <li class="list-group-item">
                                                    {{ $producto->nombre }} - Precio: {{ $producto->precio }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>

            {{-- Botones de navegación --}}
            <a class="carousel-control-prev" href="#comandasCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#comandasCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
@stop
