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
            <div class="col-md-6 mt-3">
                <h3>Users</h3>
                <x-adminlte-datatable id="table1" :heads="$heads" :config="$config"
                    class="table table-striped table-bordered">
                    @foreach ($userData as $row)
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
            <div class="col-md-6 mt-3">
                <h3>Companies</h3>
                <x-adminlte-datatable id="table2" :heads="$cosHeads" :config="$coConfig"
                    class="table table-striped table-bordered">
                    @foreach ($coData as $row)
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
    </div>
@stop
