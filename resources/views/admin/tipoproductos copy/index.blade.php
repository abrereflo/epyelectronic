@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="callout callout-info text-info text-uppercase">
        <h4>Entregas</h4>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <a class="btn btn-info text-uppercase" data-toggle="modal" data-target="#ModalCreate">Regsitrar Nuevo</a>
                </div>
                <form action={{ route('entregas.buscar') }} method="post">
                    @csrf
                    <div class="col">
                        <div class="input-group input-group-sm text-uppercase">
                            <input name="buscar" type="text" class="form-control" placeholder="Buscar">
                            <select id="parametros" name="parametros" class="custom-select">
                                {{-- <option value="id">Codigo</option> --}}
                                <option value="name">NOMBRE</option>
                                <option value="description">DESCRIPCIÓN</option>
                            </select>
                            <select id="statu" name="statu" class="custom-select">
                                <option value="1">HABILITADO</option>
                                <option value="0">DESAVILITADO</option>
                            </select>
                            <span class="input-group-append ">
                                <button type="submit" class="fas fa-search btn-info"></button>
                                <a href="{{ route('entregas.index') }}" class="btn btn-info"><i
                                        class="fas fa-sync"></i></a>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body text-uppercase">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('notification'))
                <div class="alert alert-success" role="alert">
                    {{ session('notification') }}
                </div>
            @endif
            <div class="row">
                <div class="col-sm-12 col-md-7">
                    {{ $entregas->links() }}
                </div>
                <div class="col-sm-12 col-md-5 text-info">
                  Pagina {{$entregas->currentPage()}}  Tiene  {{$entregas->count()}} entradas, con un total de {{$entregas->total()}}
                </div>
            </div>
            <table class="table table-striped text-uppercase">
                <thead>
                    <tr class="bg-info">
                        <th scope="col">#</th>
                        <th scope="col">Tipo Producto</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entregas as $entrega)
                        <tr>
                            <th scope="row">{{ $loop->index +1 }}</th>
                            <td>{{ $entrega->name }}</td>
                            <td>{{ $entrega->description }}</td>
                            <td id="resp{{ $entrega->id }}">
                                @if ($entrega->statu == true)
                                    <p class="text-success">Habilitado</p>
                                @else
                                    <p class="text-danger">Desabilitado</p>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('entregas.show', $entrega) }}"
                                    class="btn btn-outline-primary"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('entregas.edit', $entrega) }}"
                                    class="btn btn-outline-secondary"><i class="fas fa-edit"></i></a>
                                <div class="btn-group">
                                    <div class="col">
                                        <div
                                            class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input id="{{ $entrega->id }}" data-id="{{ $entrega->id }}"
                                                class="custom-control-input" type="checkbox" data-onstyle="success"
                                                data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                                data-off="InActive" {{ $entrega->statu ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="{{ $entrega->id }}"></label>
                                        </div>
                                    </div>
                                    <form action="{{ route('entregas.delete', $entrega->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button id="Eliminar" type="submit" class="btn btn-outline-danger"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
        </div>
    </div>
    @include('admin.entregas.create')

@stop

@section('css')
@stop

@section('js')

@stop
