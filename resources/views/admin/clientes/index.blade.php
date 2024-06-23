@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="callout callout-info">
    <h1 class="text-info text-uppercase">Clientes</h1>
  </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <a class="btn btn-info text-uppercase" data-toggle="modal" data-target="#ModalCreate">Regsitrar Nuevo</a>
                </div>
                <form action={{ route('client.buscar') }} method="post">
                    @csrf
                    <div class="col">
                        <div class="input-group input-group-sm">
                            <input name="buscar" type="text" class="form-control text-uppercase"  placeholder="Buscar">
                            <select id="columnasClientes" name="columnasClientes" class="custom-select text-uppercase">
                                <option value="code">Codigo</option>
                                <option value="name">Nombre</option>
                                <option value="ci">N° documento</option>
                                <option value="city">Ciudad</option>
                            </select>
                            <select id="statu" name="statu" class="custom-select text-uppercase">
                                <option value="1">Habilitado</option>
                                <option value="0">Desavilidtado</option>
                            </select>
                            <span class="input-group-append ">
                                <button type="submit" class="fas fa-search btn-info"></button>
                                <a href="{{ route('client.index') }}" class="btn btn-info"><i
                                        class="fas fa-sync"></i></a>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            {{ $clientes->links() }}
            <table class="table table-striped text-uppercase">
                <thead>
                    <tr class="bg-info">
                        <th scope="col">#</th>
                        <th scope="col">Codigo</th>
                        <th scope="col">Nombres y Apellidos</th>
                        <th scope="col">Carnet</th>
                        <th scope="col">telefono</th>
                        <th scope="col">Ciudad</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-uppercase">
                    @foreach ($clientes as $cliente)
                        <tr>
                            <th scope="row">{{ $loop->index+1 }}</th>
                            <td>{{ $cliente->code }}</td>
                            <td>{{ $cliente->name }} {{ $cliente->lastname }}</td>
                            <td>{{ $cliente->ci }}</td>
                            <td>{{ $cliente->phone }}</td>
                            <td>{{ $cliente->city }}</td>
                            <td  id="resp{{ $cliente->id }}">
                                @if ($cliente->statu == true)
                                    <p class="text-success"> Habilitado</p>
                                @else
                                    <p class="text-danger"> Desabilitado</p>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('client.show', $cliente) }}" class="btn btn-outline-primary"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="{{ route('client.edit', $cliente) }}" class="btn btn-outline-secondary"><i
                                            class="fas fa-edit"></i></a>
                                    <div class="btn-group">
                                        <div class="col">
                                            <div
                                                class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input id="{{ $cliente->id }}" data-id="{{ $cliente->id }}"
                                                    class="custom-control-input" type="checkbox" data-onstyle="success"
                                                    data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                                    data-off="InActive" {{ $cliente->statu ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="{{ $cliente->id }}"></label>
                                            </div>
                                        </div>

                                        <form action="{{ route('client.delete', $cliente->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button id="Eliminar" type="submit" class="btn btn-outline-danger"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
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
    @include('admin.clientes.create')
@stop

@section('css')

@stop

@section('js')
    <script>
        $(document).ready(function() {
            toastr.options.timeOut = 10000;
            @if (Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif(Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @endif
        });
    </script>
    <script>
        //para estados
        $('.custom-control-input').change(function() {
            //Verifico el estado del checkbox, si esta seleccionado sera igual a 1 de lo contrario sera igual a 0
            var statu = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            console.log(statu);
            $.ajax({
                type: "GET",
                dataType: "json",
                //url: '/StatusNoticia',
                url: '{{ route('UpdateStatusclient') }}',
                data: {
                    'statu': statu,
                    'id': id
                },
                success: function(data) {
                    $('#resp' + id).html(data.var);
                    console.log(data.var)
                }
            });
        })
    </script>
@stop
