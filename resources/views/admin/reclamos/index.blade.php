@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="callout callout-info text-info text-uppercase">
        <h4>Reclamos</h4>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <a class="btn btn-info" href="{{ route('reclamos.create') }}">Registrar Nuevo</a>
                </div>
                <form action={{ route('reclamos.buscar') }} method="post">
                    @csrf
                    <div class="col">
                        <div class="input-group input-group-sm">

                            <input name="buscar" type="text" class="form-control" placeholder="Buscar">
                            <select id="parametros" name="parametros" class="custom-select">
                                <option value="" disabled selected>Parametros</option>
                                <option value="id">ID</option>
                                <option value="code">Codigo</option>
                                <option value="name">Nombre</option>
                                <option value="lastname">Apellido</option>
                            </select>
                            <select id="statu" name="statu" class="custom-select">
                                <option value="" disabled selected>Estados</option>
                                <option value="1">Habilitado</option>
                                <option value="0">Anulado</option>
                            </select>
                            <span class="input-group-append ">
                                <button type="submit" class="fas fa-search btn-info"></button>
                                <a href="{{ route('reclamos.index') }}" class="btn btn-info"><i
                                        class="fas fa-sync"></i></a>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr class="bg-info">
                        <th scope="col">Nombre Cliente</th>
                        <th scope="col">N° Reclamo</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reclamos as $reclamo)
                        <tr>
                            <td>{{ $reclamo->client->name }} {{ $reclamo->client->lastname }}</td>
                            <td>{{ $reclamo->number }}</td>
                            <td>{{ $reclamo->date }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('reclamos.show', $reclamo) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-eye"></i></a>
                                    <a href="{{ route('reclamos.edit', $reclamo) }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-edit"></i></a>
                                    <form action="{{ route('reclamos.delete', $reclamo->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                        <button id="Eliminar" type="submit" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </td>
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
