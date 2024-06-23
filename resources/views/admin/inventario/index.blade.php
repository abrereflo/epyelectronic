@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="callout callout-info text-info text-uppercase">
        <h4>Compras</h4>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <a class="btn btn-info text-uppercase" href="{{ route('inventories.create')}}">Regsitrar Nuevo</a>
                </div>
                <form action={{ route('inventories.buscar') }} method="post">
                    @csrf
                    <div class="col">
                        <div class="input-group input-group-sm text-uppercase">
                            <input name="buscar" type="text" class="form-control" placeholder="Buscar">
                            <select id="parametros" name="parametros" class="custom-select">
                                <option value="serial_number">N° SERIE</option>
                                <option value="name">Nombre Producto</option>
                                {{-- <option value="product">PRODUCTO</option> --}}
                            </select>
                            <select id="status" name="status" class="custom-select">
                                <option value="habilitado">HABILITADO</option>
                                <option value="delivered">ENVIADO</option>
                            </select>
                            <span class="input-group-append ">
                                <button type="submit" class="fas fa-search btn-info"></button>
                                <a href="{{ route('inventories.index') }}" class="btn btn-info"><i
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
                    {{ $inventarios->appends(Request::except('page'))->links() }}
                    {{-- {{ $inventarios->links() }} --}}
                </div>
                <div class="col-sm-12 col-md-5 text-info">
                  Pagina {{$inventarios->currentPage()}}  Tiene  {{$inventarios->count()}} entradas, con un total de {{$inventarios->total()}}
                </div>
            </div>
            <table class="table table-striped text-uppercase">
                <thead>
                    <tr class="bg-info">
                        <th scope="col">#</th>
                        <th scope="col">Proveedor</th>
                        <th scope="col">N° Fact. Rec.</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventarios as $inventario)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $inventario->proveedor->full_name }}</td>
                        <td>{{ $inventario->nit }}</td>
                        <td>{{ $inventario->fecha }}</td>
                        <td  id="resp{{ $inventario->id }}">
                            @if ($inventario->status == 'habilitado')
                                <p class="text-success"> Habilitado</p>
                            @else
                                <p class="text-danger"> Desabilitado</p>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('inventories.show', $inventario) }}" class="btn btn-outline-primary"><i
                                        class="fas fa-eye"></i></a>
                                <a href="{{ route('inventories.edit', $inventario) }}" class="btn btn-outline-secondary"><i
                                        class="fas fa-edit"></i></a>
                                <div class="btn-group">
                                    <div class="col">
                                        <div
                                            class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input id="{{ $inventario->id }}" data-id="{{ $inventario->id }}"
                                                class="custom-control-input" type="checkbox" data-onstyle="success"
                                                data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                                data-off="InActive" {{ $inventario->status == 'habilitado' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="{{ $inventario->id }}"></label>
                                        </div>
                                    </div>

                                    <form action="{{ route('inventories.delete', $inventario->id) }}" method="POST">
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
@stop

@section('css')
@stop

@section('js')
@stop
