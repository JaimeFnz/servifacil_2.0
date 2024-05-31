    @extends('adminlte::page')

    @section('title', 'Servifacil | MGMT | Master')

    @section('plugins.Datatables', true)

    @section('content')

        @php
            $userData = [];
            foreach ($usersData as $item) {
                $userData[] = $item->toArray();
            }

            $coData = [];
            foreach ($cosData as $item) {
                $coData[] = $item->toArray();
            }
        @endphp
        <div class="container-fluid">
            {{-- @if ($errors->any())
                <script>
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "{{ $errors->first() }}", // Mostrará solo el primer error
                        footer: '<a href="#">Why do I have this issue?</a>'
                    });
                </script>
            @endif --}}

            @if ($errors->any())
                <div class="w-75 bg-red-500 p-2 text-center my-2 text-dark">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- @if (session('success'))
                <script>
                    Swal.fire({
                        title: "Good job!",
                        text: "{{ session('success') }}",
                        icon: "success"
                    });
                </script>
            @endif --}}

            @if (session('success'))
                <div class="w-75 bg-green-500 p-2 text-center my-2 text-dark">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row justify-content-center align-items-start">
                <div class="col-md-12 mt-3">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Listado Usuarios') }}</h3>
                        </div>
                        {{-- -> LISTADO DE USUARIOS --}}
                        <div class="card-body">
                            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config"
                                class="table table-striped table-bordered">
                                @foreach ($userData as $row)
                                    <tr>
                                        @foreach ($row as $key => $cell)
                                            <td>{{ $cell }}</td>
                                        @endforeach
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('master-mgmt.user.edit', $row['id']) }}"
                                                    class="btn btn-xs btn-primary mx-1" title="Editar">
                                                    <i class="fa fa-pen"></i>
                                                </a>
                                                <form action="{{ route('master-mgmt.user.delete', $row['id']) }}"
                                                    method="POST" class="mx-1">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-xs btn-danger mx-1"
                                                        title="Eliminar">
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
                </div>
            </div>
        </div>
        <div class="row justify-content-center align-items-start mt-3">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Listado Empresas') }}</h3>
                    </div>
                    {{-- -> LISTADO DE EMPRESAS --}}
                    <div class="card-body">
                        <x-adminlte-datatable id="table2" :heads="$cosHeads" :config="$coConfig"
                            class="table table-striped table-bordered">
                            @foreach ($coData as $row)
                                <tr>
                                    @foreach ($row as $key => $cell)
                                        <td>{{ $cell }}</td>
                                    @endforeach
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <form action="{{ route('co.delete', $row['id']) }}" method="POST"
                                                class="mx-1">
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
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Crear empresa') }}</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('co.store') }}" class="space-y-6">
                            @csrf

                            <!-- Field to Create Company Name -->
                            <div class="form-group">
                                <label for="nombre_empresa">{{ __('Nombre de la Empresa') }}</label>
                                <input id="nombre_empresa" name="nombre_empresa" type="text" class="form-control"
                                    value="{{ old('nombre_empresa') }}" required>
                                @if ($errors->has('nombre_empresa'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->first('nombre_empresa') }}
                                    </div>
                                @endif
                            </div>

                            <!-- Field to Assign Company Boss -->
                            <div class="form-group">
                                <label for="jefe_empresa">{{ __('Jefe de la Empresa') }}</label>
                                <select id="jefe_empresa" name="jefe_empresa" class="form-control">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->dni }} | {{ $user->name }}
                                            |
                                            {{ $user->puesto }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('jefe_empresa'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->first('jefe_empresa') }}
                                    </div>
                                @endif
                            </div>

                            <!-- Button to Create Company -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">{{ __('Crear Empresa') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @stop
