@extends('adminlte::page')

@section('title', 'Servifacil | MGMT | Desk')

@section('plugins.Datatables', true)

@section('content')

    @php
        $tableData = [];
        foreach ($data as $item) {
            $tableData[] = $item->toArray();
        }
    @endphp

    <div class="container-fluid">
        <!-- Errores de validación -->
        @if ($errors->any())
            <div class="w-75 bg-red-500 p-2 text-center my-2 text-white">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="w-75 bg-green-500 p-2 text-center my-2 text-white">
                {{ session('success') }}
            </div>
        @endif

        <div class="row justify-content-center align-items-start">
            <div class="col-md-10 mt-3">
                <h3>Listado de mesas</h3>
                <x-adminlte-datatable id="table1" :heads="$heads" :config="$config"
                    class="table table-striped table-bordered">
                    @foreach ($tableData as $row)
                        <tr>
                            @foreach ($row as $key => $cell)
                                <td>{{ $cell }}</td>
                            @endforeach
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form id="deleteForm{{ $row['id'] }}" action="{{ route('desk.delete', $row['id']) }}"
                                        method="POST" class="mx-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-xs btn-danger mx-1" title="Eliminar"
                                            onclick="confirmDelete('{{ $row['id'] }}')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header bg-gradient-info">
                        <h3 class="card-title">Crear Mesa</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('desk.store') }}" method="POST" id="mesaForm">
                            @csrf

                            <!-- Nombre y Código del Camarero -->
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <x-adminlte-input name="nombre" placeholder="Nombre de la Mesa" igroup-size="md">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-gradient-info">
                                                <i class="fas fa-utensils"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <x-adminlte-select name="cod_camarero" igroup-size="md">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-gradient-info">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </x-slot>
                                        @foreach ($waiters as $waiter)
                                            <option value="{{ $waiter->id }}">{{ $waiter->name }} {{ $waiter->surname }}
                                            </option>
                                        @endforeach
                                    </x-adminlte-select>
                                </div>
                            </div>

                            <!-- Cantidad de Clientes -->
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <x-adminlte-input name="cant_clientes" placeholder="Cantidad de Clientes"
                                        igroup-size="md">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-gradient-info">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>
                            </div>

                            <!-- Botones de Guardar y Cancelar -->
                            <div class="form-row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
