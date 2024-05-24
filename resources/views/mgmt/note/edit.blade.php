@extends('adminlte::page')

@section('title', 'Detalles de Comanda')

@section('content')
    <div class="container-fluid">
        <h3 class="mb-3">Detalles de Comanda</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Mesa</th>
                        <th>Número de Comensales</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($info as $detail)
                        <tr>
                            <td>{{ $detail->desk->nombre }}</td>
                            <td>{{ $detail->cant_clientes }}</td>
                            <td>{{ $detail->product->nombre }}</td>
                            <td>{{ $detail->cantidad }}</td>
                            <td>
                                <form action="{{ route('comanda_detail.destroy', $detail->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este detalle de comanda?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
