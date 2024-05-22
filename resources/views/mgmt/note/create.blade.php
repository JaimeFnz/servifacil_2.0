@extends('adminlte::page')

@section('title', 'Crear Comanda')

@section('content')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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

            <div id="drinks-container">
                <div class="row form-group-row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <x-adminlte-select name="drinks[]" label-class="text-lightblue" igroup-size="ml">
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
                    <div class="col-md-1">
                        <x-adminlte-input name="cant_platos[]" placeholder="cantidad" type="number" igroup-size="ml" min=1
                            max="60">
                            <x-slot name="appendSlot">
                                <div class="input-group-text bg-dark">
                                    <i class="fas fa-hashtag"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>
                    <div class="col-md-1">
                        <x-adminlte-button theme="primary" icon="fas fa-solid fa-plus add-drink-btn" />
                    </div>
                </div>
            </div>

            <div id="picapica-container">
                <div class="row form-group-row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <x-adminlte-select name="picapica[]" label-class="text-lightblue" igroup-size="ml">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-gradient-info">
                                        <i>Pica Pica</i>
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
                        <x-adminlte-input name="cant_platos[]" placeholder="cantidad" type="number" igroup-size="ml" min=1
                            max="60">
                            <x-slot name="appendSlot">
                                <div class="input-group-text bg-dark">
                                    <i class="fas fa-hashtag"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>
                    <div class="col-md-1">
                        <x-adminlte-button theme="primary" icon="fas fa-solid fa-plus add-picapica-btn" />
                    </div>
                </div>
            </div>

            <x-adminlte-button class="btn-ml" type="submit" label="Submit" theme="outline-success"
                icon="fas fa-paper-plane" />
            <x-adminlte-button class="btn-ml" type="reset" label="Reset" theme="outline-danger"
                icon="fas fa-lg fa-trash" />
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Clonar un grupo de formularios de bebidas cuando se hace clic en el botón "+"
            $('#drinks-container').on('click', '.add-drink-btn', function(e) {
                e.preventDefault();
                var formGroupRow = $(this).closest('.form-group-row').clone();
                formGroupRow.find('input').val(''); // Limpiar los valores de entrada
                $('#drinks-container').append(formGroupRow);
            });

            // Clonar un grupo de formularios de picapica cuando se hace clic en el botón "+"
            $('#picapica-container').on('click', '.add-picapica-btn', function(e) {
                e.preventDefault();
                var formGroupRow = $(this).closest('.form-group-row').clone();
                formGroupRow.find('input').val(''); // Limpiar los valores de entrada
                $('#picapica-container').append(formGroupRow);
            });
        });
    </script>




@endsection
