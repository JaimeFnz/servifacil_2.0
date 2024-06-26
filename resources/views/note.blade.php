@extends('adminlte::page')

@section('title', 'Servifacil | Note')

@section('content')
    <div class="container-fluid">
        <div class="row mx-auto">
            <div id="comandasCarousel" class="carousel slide w-100 mt-4" data-ride="carousel" data-interval="false">
                @if ($notes->isEmpty())
                    <div class="carousel-inner">
                        <x-adminlte-callout theme="info" class="bg-gradient-info" title-class="text-bold text-dark"
                            icon="fas fa-lg fa-bell text-dark" title="Notification">
                            {{ __('No hay ninguna comanda creada') }}
                        </x-adminlte-callout>
                    </div>
                @else
                    <div class="carousel-inner">
                        @foreach ($notes as $index => $note)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12 mt-3 mx-auto">
                                    <div class="card">
                                        <div class="card-header bg-dark text-white d-flex justify-content-between">
                                            <h4 class="card-title mb-0">{{ __('Mesa') }} {{ $note->mesa->id }}</h4>
                                            <span>{{ __('Comanda') }} {{ $note->id }}</span>
                                            <span>{{ __('Comensales') }} {{ $note->mesa->cant_clientes }}</span>
                                        </div>
                                        <div class="card-body">
                                            @if ($note->productos->isEmpty())
                                                <x-adminlte-callout theme="warning" class="bg-gradient-warning"
                                                    title-class="text-bold text-dark"
                                                    icon="fas fa-lg fa-exclamation-triangle text-dark" title="Advertencia">
                                                    {{ __('Esta comanda no tiene productos') }}
                                                </x-adminlte-callout>
                                            @else
                                                @foreach ($note->productos->sortBy('tipo')->groupBy('tipo') as $tipo => $productos)
                                                    <h5>{{ ucfirst($tipo) }}</h5>
                                                    <ul class="list-group">
                                                        @foreach ($productos as $producto)
                                                            <li class="list-group-item">
                                                                {{ $producto->nombre }} -
                                                                x{{ $producto->pivot->cantidad }} -
                                                                {{ __('Precio') }}:
                                                                {{ $producto->precio * $producto->pivot->cantidad }}€
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endforeach
                                                <div class="mt-3">
                                                    <h5>{{ __('Total') }}: {{ $note->totalCost }}€
                                                    </h5>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#comandasCarousel" role="button" data-slide="prev"
                        style="margin-left: -15px;">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">{{ __('Previous') }}</span>
                    </a>
                    <a class="carousel-control-next" href="#comandasCarousel" role="button" data-slide="next"
                        style="margin-right: -15px;">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">{{ __('Next') }}</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
@stop
