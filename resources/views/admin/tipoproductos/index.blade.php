@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="callout callout-info text-info text-uppercase">
        <h4>Tipo de Productos</h4>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <a class="btn btn-info text-uppercase" data-toggle="modal" data-target="#ModalCreate">Regsitrar Nuevo</a>
                </div>
                <form action={{ route('producttype.buscar') }} method="post">
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
                                <a href="{{ route('producttype.index') }}" class="btn btn-info"><i
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
                    {{ $tipoproductos->links() }}
                </div>
                <div class="col-sm-12 col-md-5 text-info">
                  Pagina {{$tipoproductos->currentPage()}}  Tiene  {{$tipoproductos->count()}} entradas, con un total de {{$tipoproductos->total()}}
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
                    @foreach ($tipoproductos as $tipoproducto)
                        <tr>
                            <th scope="row">{{ $loop->index +1 }}</th>
                            <td>{{ $tipoproducto->name }}</td>
                            <td>{{ $tipoproducto->description }}</td>
                            <td id="resp{{ $tipoproducto->id }}">
                                @if ($tipoproducto->statu == true)
                                    <p class="text-success">Habilitado</p>
                                @else
                                    <p class="text-danger">Desabilitado</p>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('producttype.show', $tipoproducto) }}"
                                    class="btn btn-outline-primary"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('producttype.edit', $tipoproducto) }}"
                                    class="btn btn-outline-secondary"><i class="fas fa-edit"></i></a>
                                <div class="btn-group">
                                    <div class="col">
                                        <div
                                            class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input id="{{ $tipoproducto->id }}" data-id="{{ $tipoproducto->id }}"
                                                class="custom-control-input" type="checkbox" data-onstyle="success"
                                                data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                                data-off="InActive" {{ $tipoproducto->statu ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="{{ $tipoproducto->id }}"></label>
                                        </div>
                                    </div>
                                    <form action="{{ route('producttype.delete', $tipoproducto->id) }}" method="POST">
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
    @include('admin.tipoproductos.create')

@stop

@section('css')
@stop

@section('js')
    <script>
        //para estados
        $('.custom-control-input').change(function() {
            //Verifico el estado del checkbox, si esta seleccionado sera igual a 1 de lo contrario sera igual a 0
            var statu = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('UpdateStatusTipoProducto') }}',
                data: {
                    'statu': statu,
                    'id': id
                },

                success: function(data) {
                    $('#resp' + id).html(data.var);
                    /*   console.log(data.var) */
                }
            });
        })
    </script>
@stop
