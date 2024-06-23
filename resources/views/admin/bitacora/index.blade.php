@extends('adminlte::page')

@section('title', 'Bitacora')

@section('content_header')
    <h1>Lista de Bitacora</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
               {{--  <form action={{ route('orders.buscar') }} method="post">
                    @csrf
                    <div class="col">
                        <div class="input-group input-group-sm">
                            <input name="buscar" type="text" class="form-control" placeholder="Buscar">
                            <select id="parametros" name="parametros" class="custom-select">
                                <option value="" disabled selected>Parametros</option>
                                <option value="id">ID</option>
                            </select>
                            <select id="statu" name="statu" class="custom-select">
                                <option value="" disabled selected>Estados</option>
                                <option value="1">Habilitado</option>
                                <option value="0">Anulado</option>
                            </select>
                            <span class="input-group-append ">
                                <button type="submit" class="fas fa-search btn-info"></button>
                                <a href="{{ route('orders.index') }}" class="btn btn-info"><i
                                        class="fas fa-sync"></i></a>
                            </span>
                        </div>
                    </div>
                </form> --}}
            </div>
        </div>
        <div class="card-body">
            <div id="article" class="container">
                <table class="table table-striped">
                    <thead>
                        <tr class="bg-info">
                            <th>Codigo Usuario</th>
                            <th>Evento</th>
                            <th>URL</th>
                        </tr>
                    </thead>
                    <tbody class="text-uppercase">
                        @foreach ($metadata as $data)
                            <tr>
                                <td><strong>{{ $data.user_id }}</strong></td>
                                <td class="danger">{{ $data.event }}</td>
                                <td class="success">{{ $data.old_values }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>

@stop

@section('css')

@stop

@section('js')

@stop
