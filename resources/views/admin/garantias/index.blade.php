@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="callout callout-info text-info text-uppercase">
        <h4>Garantias</h4>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <a class="btn btn-info" href="{{ route('garantias.create') }}">Registrar Nuevo</a>
                </div>
                <form action={{ route('garantias.buscar') }} method="post">
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
                                <a href="{{ route('despachos.index') }}" class="btn btn-info"><i
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
                        <th scope="col">Producto</th>
                        <th scope="col">Descrpción</th>
                        <th scope="col">Garantia</th>
                        <th scope="col">Fecha</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($garantias  as $garantia)
                            <tr>
                                @foreach ($garantia->product as $detail)
                                <td>{{$detail->name }}</td>
                                <td>{{$detail->pivot->description }}</td>
                                @endforeach
                                <td>{{ $garantia->warranties}}</td>
                                <td>{{ $garantia->date}}</td>

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
