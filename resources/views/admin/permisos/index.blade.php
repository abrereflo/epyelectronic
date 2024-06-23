@extends('adminlte::page')

@section('title', 'Funciones')

@section('content_header')
<div class="callout callout-info text-info text-uppercase">
    <h4>Lista Permisos</h4>
</div>

@stop

@section('content')
<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        {{$routeCollection->links()}}
        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr class="text-center">
                    <th>N°</th>
                    <th>Nombre</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($routeCollection as $route)
                    <tr>
                        <td scope="row">{{ $loop->index + 1 }}</td>
                        <td>{{$route->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
    <div class="card-footer text-muted">
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop
