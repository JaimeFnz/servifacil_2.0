@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row">
            @if (count($dishes) > 0)
                @foreach ($dishes as $dish)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                {{ $dish->name }}
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12">
                    <div class="alert alert-info">
                        No hay platos disponibles.
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop
