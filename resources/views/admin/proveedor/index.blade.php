@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="callout callout-info">
    <h1 class="text-info text-uppercase">proveedores</h1>
  </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <a class="btn btn-info text-uppercase" data-toggle="modal" data-target="#ModalCreate">Regsitrar Nuevo</a>
                </div>
                <form action={{ route('proveedor.buscar') }} method="post">
                    @csrf
                    <div class="col">
                        <div class="input-group input-group-sm">
                            <input name="buscar" type="text" class="form-control text-uppercase"  placeholder="Buscar">
                            <select id="parametros" name="parametros" class="custom-select text-uppercase">
                                <option value="name">Nombre</option>
                                <option value="last_name">Apellido</option>
                                <option value="nit">N° documento o NIT</option>
                            </select>
                            <select id="status" name="status" class="custom-select text-uppercase">
                                <option value="1">Habilitado</option>
                                <option value="2">Desavilidtado</option>
                            </select>
                            <span class="input-group-append ">
                                <button type="submit" class="fas fa-search btn-info"></button>
                                <a href="{{ route('proveedor.index') }}" class="btn btn-info"><i
                                        class="fas fa-sync"></i></a>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            {{ $proveedores->links() }}
            <table class="table table-striped text-uppercase">
                <thead>
                    <tr class="bg-info">
                        <th scope="col">#</th>
                        <th scope="col">Nombres y Apellidos</th>
                        <th scope="col">NIT o CI</th>
                        <th scope="col">telefono</th>
                        <th scope="col">Empresa</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-uppercase">
                    @foreach ($proveedores as $proveedor)
                        <tr>
                            <th scope="row">{{ $loop->index+1 }}</th>
                            <td>{{ $proveedor->full_name }}</td>
                            <td>{{ $proveedor->nit }}</td>
                            <td>{{ $proveedor->phone }}</td>
                            <td>{{ $proveedor->business_name }}</td>

                            <td  id="resp{{ $proveedor->id }}">
                                @if ($proveedor->status == 1)
                                    <p class="text-success"> Habilitado</p>
                                @else
                                    <p class="text-danger"> Desabilitado</p>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('proveedor.show', $proveedor) }}" class="btn btn-outline-primary"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="{{ route('proveedor.edit', $proveedor) }}" class="btn btn-outline-secondary"><i
                                            class="fas fa-edit"></i></a>
                                    <div class="btn-group">
                                        <div class="col">
                                            <div
                                                class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input id="{{ $proveedor->id }}" data-id="{{ $proveedor->id }}"
                                                    class="custom-control-input" type="checkbox" data-onstyle="success"
                                                    data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                                    data-off="InActive" {{ $proveedor->status == 1 ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="{{ $proveedor->id }}"></label>
                                            </div>
                                        </div>

                                        <form action="{{ route('proveedor.delete', $proveedor->id) }}" method="POST">
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
    @include('admin.proveedor.create', ['content' => 'proveedor'])
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
            var status = $(this).prop('checked') == true ? 1 : 2;
            var id = $(this).data('id');
            console.log(status);
            $.ajax({
                type: "GET",
                dataType: "json",
                //url: '/StatusNoticia',
                url: '{{ route('UpdateStatusproveedor') }}',
                data: {
                    'status': status,
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
