@extends('adminlte::page')

@section('title', 'Servifacil | MGMT | Crear Plato')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-12 mt-3">
                <!-- Mensajes de estado -->
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Errores de validación -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header bg-gradient-info">
                        <h3 class="card-title">Crear Plato</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dish.store') }}" method="POST" id="platoForm" enctype="multipart/form-data">
                            @csrf

                            <!-- Nombre y Precio del Plato -->
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <x-adminlte-input name="nombre" placeholder="Nombre del Plato" igroup-size="md">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-gradient-info">
                                                <i class="fas fa-utensils"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <x-adminlte-input name="precio" placeholder="Precio" type="number" step="0.01"
                                        igroup-size="md">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-gradient-info">
                                                <i class="fas fa-euro-sign"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>
                            </div>

                            <!-- Imagen y Tipo del Plato -->
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <x-adminlte-input-file name="imagen" igroup-size="md"
                                        placeholder="Subir imagen del Plato...">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-gradient-info">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input-file>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <x-adminlte-select name="tipo" igroup-size="md">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-gradient-info">
                                                <i class="fas fa-list"></i>
                                            </div>
                                        </x-slot>
                                        <option value="primero">Primero</option>
                                        <option value="segundo">Segundo</option>
                                        <option value="postre">Postre</option>
                                        <option value="picapica">Picapica</option>
                                        <option value="bebida">Bebida</option>
                                    </x-adminlte-select>
                                </div>
                            </div>

                            <!-- Alérgenos del Plato -->
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <x-adminlte-select name="alergies[]" label="Alérgenos" igroup-size="md" multiple>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-gradient-info">
                                                <i class="fas fa-allergies"></i>
                                            </div>
                                        </x-slot>
                                        @foreach ($alergies as $alergeno)
                                            <option value="{{ $alergeno->id }}">{{ $alergeno->nombre }}</option>
                                        @endforeach
                                    </x-adminlte-select>
                                </div>
                            </div>

                            <!-- Botones de Guardar y Cancelar -->
                            <div class="form-row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">Guardar Plato</button>
                                    <a href="{{ route('home') }}" class="btn btn-secondary">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
