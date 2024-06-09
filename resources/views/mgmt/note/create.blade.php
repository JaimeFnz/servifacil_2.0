@extends('adminlte::page')

@section('title', 'Servifacil | MGMT | Crear Comanda')

@section('content')
    <div class="container-fluid">
        <h3 class="mb-3">Crear Comanda</h3>
        <form action="{{ route('note.store') }}" method="POST" id="comandaForm">
            @csrf
            @method('POST')
            <!-- Mesas y Cantidad de Clientes -->
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
                        <x-adminlte-input name="cant_clientes" placeholder="number" type="number" igroup-size="ml"
                            value="0" min=0 max="60">
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

            <!-- Bebidas -->
            <div id="bebida-container">
                <div class="row form-group-row original">
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <x-adminlte-select name="bebida[0][id]" label-class="text-lightblue" igroup-size="ml">
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
                        <x-adminlte-input name="bebida[0][cantidad]" type="number" igroup-size="ml" value="0" min=0
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

            <!-- Pica Pica -->
            <div id="picapica-container">
                <div class="row form-group-row original">
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <x-adminlte-select name="picapica[0][id]" label-class="text-lightblue" igroup-size="ml">
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
                        <x-adminlte-input name="picapica[0][cantidad]" type="number" igroup-size="ml" value="0" min=0
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

            <!-- Primer Plato -->
            <div id="primero-container">
                <div class="row form-group-row original">
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <x-adminlte-select name="primero[0][id]" label-class="text-lightblue" igroup-size="ml">
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
                    </div>
                    <div class="col-md-1">
                        <x-adminlte-input name="primero[0][cantidad]" type="number" igroup-size="ml" value="0" min=0
                            max="60">
                            <x-slot name="appendSlot">
                                <div class="input-group-text bg-dark">
                                    <i class="fas fa-hashtag"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>
                    <div class="col-md-1">
                        <x-adminlte-button theme="primary" icon="fas fa-solid fa-plus add-primero-btn" />
                    </div>
                </div>
            </div>

            <!-- Segundo Plato -->
            <div id="segundo-container">
                <div class="row form-group-row original">
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <x-adminlte-select name="segundo[0][id]" label-class="text-lightblue" igroup-size="ml">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-gradient-info">
                                        <i>Segundos</i>
                                    </div>
                                </x-slot>
                                @foreach ($products as $product)
                                    @if ($product->tipo == 'segundo')
                                        <option value="{{ $product->id }}">{{ $product->nombre }}</option>
                                    @endif
                                @endforeach
                            </x-adminlte-select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <x-adminlte-input name="segundo[0][cantidad]" type="number" igroup-size="ml" value="0"
                            min=0 max="60">
                            <x-slot name="appendSlot">
                                <div class="input-group-text bg-dark">
                                    <i class="fas fa-hashtag"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>
                    <div class="col-md-1">
                        <x-adminlte-button theme="primary" icon="fas fa-solid fa-plus add-segundo-btn" />
                    </div>
                </div>
            </div>

            <!-- Postres -->
            <div id="postre-container">
                <div class="row form-group-row original">
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <x-adminlte-select name="postre[0][id]" label-class="text-lightblue" igroup-size="ml">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-gradient-info">
                                        <i>Postres</i>
                                    </div>
                                </x-slot>
                                @foreach ($products as $product)
                                    @if ($product->tipo == 'postre')
                                        <option value="{{ $product->id }}">{{ $product->nombre }}</option>
                                    @endif
                                @endforeach
                            </x-adminlte-select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <x-adminlte-input name="postre[0][cantidad]" type="number" igroup-size="ml" value="0"
                            min=0 max="60">
                            <x-slot name="appendSlot">
                                <div class="input-group-text bg-dark">
                                    <i class="fas fa-hashtag"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>
                    <div class="col-md-1">
                        <x-adminlte-button theme="primary" icon="fas fa-solid fa-plus add-postre-btn" />
                    </div>
                </div>
            </div>

            <x-adminlte-button class="btn-ml" type="submit" label="Submit" theme="outline-success"
                icon="fas fa-paper-plane" />
            <x-adminlte-button class="btn-ml" type="reset" label="Reset" theme="outline-danger"
                icon="fas fa-lg fa-trash" id="resetButton" />
        </form>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            var counters = {
                bebida: 1,
                picapica: 1,
                primero: 1,
                segundo: 1,
                postre: 1
            };

            function cloneFormContainer(containerId, addButtonClass, type) {
                $(containerId).on('click', addButtonClass, function(e) {
                    e.preventDefault();
                    var formGroupRow = $(this).closest('.form-group-row').clone();
                    formGroupRow.find('select').attr('name', type + '[' + counters[type] + '][id]');
                    formGroupRow.find('input').attr('name', type + '[' + counters[type] + '][cantidad]')
                        .val('0');
                    counters[type]++;
                    formGroupRow.removeClass('original');
                    $(containerId).append(formGroupRow);
                });
            }

            cloneFormContainer('#bebida-container', '.add-drink-btn', 'bebida');
            cloneFormContainer('#picapica-container', '.add-picapica-btn', 'picapica');
            cloneFormContainer('#primero-container', '.add-primero-btn', 'primero');
            cloneFormContainer('#segundo-container', '.add-segundo-btn', 'segundo');
            cloneFormContainer('#postre-container', '.add-postre-btn', 'postre');

            // Manejar el botón de reset para eliminar los elementos clonados
            $('#resetButton').click(function() {
                $('.form-group-row:not(.original)').remove();
                counters = {
                    bebida: 1,
                    picapica: 1,
                    primero: 1,
                    segundo: 1,
                    postre: 1
                };
            });
        });
    </script>
@endsection
