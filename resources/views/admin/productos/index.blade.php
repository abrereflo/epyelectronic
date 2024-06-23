@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <div class="callout callout-info text-uppercase text-info">
        <h5>Productos</h5>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header text-uppercase">
            <div class="row">
                <div class="col">
                    <a class="btn btn-info" data-toggle="modal" data-target="#ModalCreate">Regsitrar Nuevo</a>
                </div>
                <form action={{ route('product.buscar') }} method="post">
                    @csrf
                    <div class="col">
                        <div class="input-group input-group-sm text-uppercase">
                            <input name="buscar" type="text" class="form-control text-uppercase" placeholder="Buscar">
                            <select id="columnasProducto" name="columnasProducto" class="custom-select">
                                <option value="code">CODIGO</option>
                                <option value="name">PRODUCTO</option>
                                <option value="productfamily">FAMILIA</option>
                            </select>
                            <select id="statu" name="statu" class="custom-select text-uppercase">
                                <option value="1">HABILITADO</option>
                                <option value="0">DESAVILITADO</option>
                            </select>
                            <span class="input-group-append ">
                                <button type="submit" class="fas fa-search btn-info"></button>
                                <a href="{{ route('product.index') }}" class="btn btn-info"><i
                                        class="fas fa-sync"></i></a>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            @if (session('notification'))
                <div class="alert alert-success" role="alert">
                    {{ session('notification') }}
                </div>
            @endif
            <div class="row">
                <div class="col-sm-12 col-md-7">
                    {{ $productos->links() }}
                </div>
                <div class="col-sm-12 col-md-5 text-info">
                  Pagina {{$productos->currentPage()}}  Tiene  {{$productos->count()}} entradas, con un total de {{$productos->total()}}
                </div>
            </div>
            <table class="table table-striped text-uppercase">
                <thead>
                    <tr class="bg-info">
                        <th scope="col">#</th>
                        <th scope="col">Codigo</th>
                        <th scope="col">Producto</th>
                        <th scope="col" class="text-center">Precio Venta</th>
                        <th scope="col" class="text-center">Stock</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-uppercase">
                    @foreach ($productos as $producto)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $producto->code }}</td>
                            <td>{{ $producto->name }}</td>
                            <td class="text-center">{{ $producto->price }}</td>
                            <td class="text-center">{{ $producto->stock }}</td>
                            <td id="resp{{ $producto->id }}">
                                @if ($producto->statu == true)
                                    <p class="text-success">Habilitado</p>
                                @else
                                    <p class="text-danger">Desabilitado</p>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('product.show', $producto) }}" class="btn btn-outline-primary"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="{{ route('product.edit', $producto) }}" class="btn btn-outline-secondary"><i
                                            class="fas fa-edit"></i></a>

                                    <div class="btn-group">
                                        <div class="col">
                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input id="{{ $producto->id }}" data-id="{{ $producto->id }}"
                                                    class="custom-control-input" type="checkbox" data-onstyle="success"
                                                    data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                                    data-off="InActive" {{ $producto->statu ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="{{ $producto->id }}"></label>
                                            </div>
                                        </div>


                                        <form action="{{ route('product.delete', $producto->id) }}" method="POST">
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


    @include('admin.productos.create')
@stop

@section('css')
    <style>
        .file {
            visibility: hidden;
            position: absolute;
        }
    </style>
@stop

@section('js')
<script>
    $(document).ready(function() {
    $('.somente-numero').blur(function (e) {
     $(this).val($(this).val().replace(/[^0-9\.]/g,''));
       var v1 = Number(document.getElementById("salePrice").value);
            if (v1 !=""){
              var resl =  v1 * 0.16;
               var sum = (+resl) + (+v1);
               var v5 = document.getElementById("invoicePrice").value =  parseFloat(sum).toFixed(2);
             }
    });
  });
 </script>

    <script>
        $(document).on("click", ".browse", function() {
            var file = $(this)
                .parent()
                .parent()
                .parent()
                .find(".file");
            file.trigger("click");
        });
        $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[0].name;
            $("#file").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("preview").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
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
                url: '{{ route('UpdateStatusProducto') }}',
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
