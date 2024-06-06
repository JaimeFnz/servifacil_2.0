@extends('adminlte::page')

@section('title', 'Servifacil | MGMT | Company')

@section('plugins.Datatables', true)

@section('content')
    @php
        $tableData = [];
        foreach ($data as $item) {
            $tableData[] = $item->toArray();
        }
    @endphp
    <div class="container-fluid">
        <!-- Validation Errors -->
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
                <h3>Listado de usuarios</h3>
                <x-adminlte-datatable id="table1" :heads="$heads" :config="$config"
                    class="table table-striped table-bordered">
                    @foreach ($tableData as $row)
                        <tr>
                            @foreach ($row as $key => $cell)
                                <td>{{ $cell }}</td>
                            @endforeach
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="{{ route('desk.delete', $row['id']) }}" method="POST" class="mx-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-danger mx-1" title="Eliminar">
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

        <!-- Section to Update Company Boss and Name -->
        <div class="row justify-content-center align-items-start mt-4">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">Actualizar Empresa</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('co.update') }}" class="space-y-6">
                            @csrf
                            @method('PATCH');

                            <!-- Field to Update Company Name -->
                            <div class="form-group">
                                <label for="nombre_empresa">{{ __('Nombre de la Empresa') }}</label>
                                <input id="nombre_empresa" name="nombre_empresa" type="text" class="form-control"
                                    value="{{ old('nombre_empresa', $co->name) }}" required>
                                @if ($errors->has('nombre_empresa'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->first('nombre_empresa') }}
                                    </div>
                                @endif
                            </div>

                            <!-- Field to Update Company Boss -->
                            <div class="form-group">
                                <label for="jefe_empresa">{{ __('Jefe de la Empresa') }}</label>
                                <select id="jefe_empresa" name="jefe_empresa" class="form-control">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" <?php
                                        $usr = $co->returnBoss();
                                        ?>
                                            {{ $user->id == old('jefe_empresa', $user->name) ? 'selected' : '' }}>
                                            {{ $user->dni }} | {{ $user->name }} | {{ $user->puesto }}
                                        </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('jefe_empresa'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->first('jefe_empresa') }}
                                    </div>
                                @endif
                            </div>

                            <!-- Button to Save Changes -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section to Delete the Company -->
        <div class="row justify-content-center align-items-start mt-4">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">Eliminar Empresa</h3>
                    </div>
                    <div class="card-body text-center">
                        <form method="post" action="{{ route('co.delete') }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">{{ __('Eliminar Empresa') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
