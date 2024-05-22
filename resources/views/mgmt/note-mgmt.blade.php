@extends('adminlte::page')

@section('title', 'Servifacil | MGMT | Note')

@section('plugins.Datatables', true)

@section('content')

    {{-- resources/views/mgmt/note-mgmt.blade.php --}}

    @php
        $tableData = [];
        foreach ($data as $item) {
            $tableData[] = $item->toArray();
        }
    @endphp

    <div class="container-fluid">
        <div class="row justify-content-center align-items-start" style="height: 90vh;">

            <div class="col-md-10">
                <div class="row mt-2 mb-2 justify-content-between align-items-center">
                    <div class="col-md-8">
                        <h3 class="mb-3">Listado de comandas</h3>
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="{{ route('note.create') }}" class="btn btn-info" title="Crear Nota" style="width: 80%;">
                            <i class="fas fa-plus"></i> Crear Comanda
                        </a>
                    </div>
                </div>

                <x-adminlte-datatable id="table1" :heads="$heads" :config="$config"
                    class="table table-striped table-bordered">
                    @foreach ($tableData as $row)
                        <tr>
                            @foreach ($row as $cell)
                                <td>{{ $cell }}</td>
                            @endforeach
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('note.edit', $row['id']) }}" class="btn btn-xs btn-primary mx-1"
                                        title="Editar">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <form action="{{ route('note.delete', $row['id']) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-xs btn-danger mx-1" title="Eliminar"
                                            onclick="confirmDelete('{{ $row['id'] }}')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('note.index') }}" class="btn btn-xs btn-info mx-1" title="Detalles">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </div>
        </div>
    </div>








    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si se confirma la eliminación, enviar el formulario de eliminación
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>

@stop
