@extends('adminlte::page')

@section('title', 'Crear Comanda')

@section('content')

    <div class="container-fluid">
        <h3 class="mb-3">Crear Comanda</h3>
        <form action="{{ route('note.store') }}" method="POST" id="comandaForm">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <x-adminlte-select name="desks" label-class="text-lightblue" igroup-size="ml">
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-gradient-info">
                                    <i>Mesas</i>
                                </div>
                            </x-slot>
                            @foreach ($desks as $desk)
                                <option value="{{ $desk->id }}">{{ $desk->id }} | {{ $desk->nombre }}</option>
                            @endforeach
                        </x-adminlte-select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-adminlte-input name="cant_clientes" placeholder="number" type="number" igroup-size="ml" min=1
                            max="60">
                            <x-slot name="appendSlot">
                                <div class="input-group-text bg-dark">
                                    <i class="fas fa-hashtag"></i>
                                </div>
                            </x-slot>
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-gradient-info">
                                    <i>Numero de comensales</i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-group">
                            <x-adminlte-select name="drinks" label-class="text-lightblue" igroup-size="ml">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-gradient-info">
                                        <i>Bebidas</i>
                                    </div>
                                </x-slot>
                                @foreach ($products as $product)
                                    @if ($product->tipo == 'bebida')
                                        <option value="{{ $product->id }}">{{ $product->nombre }}</option>
                                    @endif
                                @endforeach
                            </x-adminlte-select>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <x-adminlte-input name="cant_platos" placeholder="cantidad" type="number" igroup-size="ml" min=1
                        max="60">
                        <x-slot name="appendSlot">
                            <div class="input-group-text bg-dark">
                                <i class="fas fa-hashtag"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="col-md-1">
                    <x-adminlte-button theme="primary" icon="fas fa-solid fa-plus"/>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <x-adminlte-select name="picapica" label-class="text-lightblue" igroup-size="ml">
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-gradient-info">
                                    <i>Pica PIca</i>
                                </div>
                            </x-slot>
                            @foreach ($products as $product)
                                @if ($product->tipo == 'picapica')
                                    <option value="{{ $product->id }}">{{ $product->nombre }}</option>
                                @endif
                            @endforeach
                        </x-adminlte-select>
                    </div>
                </div>
                <div class="col-md-1">
                    <x-adminlte-input name="cant_platos" placeholder="cantidad" type="number" igroup-size="ml" min=1
                        max="60">
                        <x-slot name="appendSlot">
                            <div class="input-group-text bg-dark">
                                <i class="fas fa-hashtag"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="col-md-1">
                    <x-adminlte-button theme="primary" icon="fas fa-solid fa-plus"/>
                </div>
            </div>

            <div class="form-group">
                <x-adminlte-select name="first" label-class="text-lightblue" igroup-size="ml">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i>Primeros</i>
                        </div>
                    </x-slot>
                    @foreach ($products as $product)
                        @if ($product->tipo == 'primero')
                            <option value="{{ $product->id }}">{{ $product->nombre }}</option>
                        @endif
                    @endforeach
                </x-adminlte-select>
            </div>
            <x-slot name="appendSlot">
                <x-adminlte-button theme="primary" icon="fas fa-paper-plane" label="Send" />
            </x-slot>
            <x-adminlte-button class="btn-lg" type="reset" label="Reset" theme="outline-danger"
                icon="fas fa-lg fa-trash" />
        </form>
    </div>


@endsection
