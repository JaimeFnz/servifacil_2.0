@extends('adminlte::page')

@section('title', ' Master | User Edition')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center"> <!-- Añadimos la clase justify-content-center para centrar el contenido -->
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Actualizar Usuario') }}</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('master-mgmt.user.update', $user->id) }}">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input id="name" name="name" type="text" class="form-control"
                                    value="{{ $user->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="last_name">Apellidos</label>
                                <input id="last_name" name="last_name" type="text" class="form-control"
                                    value="{{ $user->surname }}">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" class="form-control"
                                    value="{{ $user->email }}" required>
                            </div>

                            <div class="form-group">
                                <label for="dni">DNI</label>
                                <input id="dni" name="dni" type="text" class="form-control"
                                    value="{{ $user->dni }}" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input id="password" name="password" type="password" class="form-control">
                            </div>

                            <div class="form-group">
                                <x-adminlte-select name="company" label="Empresa" label-class="text-lightblue"
                                    igroup-size="lg">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-building"></i>
                                        </div>
                                    </x-slot>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}"
                                            @if ($company->id == $user->id_empresa) selected @endif>
                                            {{ $company->name }}
                                        </option>
                                    @endforeach
                                </x-adminlte-select>
                            </div>

                            <div class="form-group">
                                <x-adminlte-select name="position" label="Puesto" label-class="text-lightblue"
                                    igroup-size="lg">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-user-tie"></i>
                                        </div>
                                    </x-slot>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position }}"
                                            @if ($position == $user->puesto) selected @endif>
                                            {{ $position }}
                                        </option>
                                    @endforeach
                                </x-adminlte-select>
                            </div>

                            <x-adminlte-button type="submit" label="Submit" theme="primary" icon="fas fa-lg fa-save"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
