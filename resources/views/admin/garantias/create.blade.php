@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="callout callout-info  text-uppercase">
        <h5 class="text-info">Inventario</h5>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col">
            <form action="{{ route('garantias.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header text-uppercase">
                        <h4 class="text-info">Nuevo Registro</h4>
                    </div>
                    <div class="card-body">
                        <div class="callout callout-info">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Fecha:</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" name="date_start"
                                                class="form-control datetimepicker-input" data-target="#reservationdate">
                                            <div class="input-group-append" data-target="#reservationdate"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-group">
                                        <label>Garantia :</label>
                                        <div class="input-group date" id="warranties">
                                            <input type="text" name="warranties" class="form-control"
                                                data-target="#warranties">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover" id="tab_logic">
                                    <thead>
                                        <tr>
                                            <th class="text-center"> Codigo </th>
                                            <th class="text-center"> Producto </th>
                                            <th class="text-center"> Descripción </th>
                                        </tr>
                                    </thead>
                                    <tbody id="list">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-uppercase">
                        <a class="btn btn-danger" href="{{ route('garantias.index') }}">Cancelar</a>
                        <button type="submit" class="btn btn-info">Registrar</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-4">
            <div class="card">
                <div class="callout callout-info">
                    <div class="text-center text-info text-uppercase">
                        <h5>Productos</h5>
                    </div>
                </div>
                <div class="card-header">
                    <div class="form-group text-uppercase">
                        <div class="input-group">
                            <input id="search_product" type="search" class="form-control" placeholder="Buscar...">
                            <select id="parametros" class="custom-select rounded-0 text-uppercase">
                                <option value="code">Codigo</option>
                                <option value="name">Nombre</option>
                                <option value="family">Familia</option>
                                <option value="type">Tipo</option>
                            </select>
                            <div class="input-group-append">
                                <a id="btn_product" class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-7">
                            {{ $productos->links() }}
                        </div>
                        <div class="col-sm-12 col-md-5 text-info">
                           <strong>Pagina:</strong> {{ $productos->currentPage() }} <strong>Tiene:</strong> {{ $productos->count() }}
                        </div>
                    </div>
                    <table id="detalles" class="table table-bordered text-uppercase">
                        <thead>
                            <tr class="text-center">
                                <th>Codigo</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody id="products">
                            @foreach ($productos as $producto)
                                <tr onclick="select( {{ $producto->id }},' {{ $producto->name }}' ,this)">
                                    <td>{{ $producto->code }}</td>
                                    <td>{{ $producto->name }}</td>
                                    <td>{{ $producto->stock }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>



@stop

@section('css')

@stop

@section('js')
    <script>
        function select(id, name, e) {
            $(e).remove();
            console.log(id);
            if (id) {
                $.ajax({
                    url: "{{ url('/admin/garantias/producto/') }}/" + id,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        $('#list').html("");
                        $.each(data, function(key, value) {
                            $('#list').append(
                                '<tr>\
                                    <td>' + value.code +
                                '<input type="hidden"  name="product_id" value="' + value
                                .product_id + '"></td>\
                                                <td>' + value.product + '</td>\
                                                <td style="padding: 0px;"><input type="text" name="description" id="description" style="padding: 0px;border: 0px;width: 100%;height: 50px;"></td>\
                                                </tr>')
                        });

                    },
                    error: function(xhr, status, error){
                        alert('Todos los Items estan listos ' + errorMessage);
                    }

                });
            }
        }
    </script>
    <script>
        $('#reservationdate').datetimepicker({
            format: 'YYYY/MM/DD'
        });
        $('#reservationdate1').datetimepicker({
            format: 'YYYY/MM/DD'
        });
    </script>
    {{-- Agregar filas para codigos de barras --}}
    <script>
        $(document).ready(function() {
            var i = 1;
            $("#add_row").click(function() {
                b = i - 1;
                $('#addr' + i).html($('#addr' + b).html()).find('td:first-child').html(i + 1);
                $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
                i++;
            });
            $("#delete_row").click(function() {
                if (i > 1) {
                    $("#addr" + (i - 1)).html('');
                    i--;
                }

            });

        });
    </script>

    {{-- buscar producto --}}
    <script>
        $(document).ready(function() {
            $("#btn_product").click(function(e) {
                e.preventDefault();
                var search_prod = $("#search_product").val();
                var parametro = $("#parametros").val();
                $.ajax({
                    url: "{{ route('quote.bproduct') }}",
                    type: 'GET',
                    data: {
                        search_prod: search_prod,
                        parametro: parametro,
                    },
                    success: function(data) {
                        console.log(data);
                        if (data != null) {
                            $('#products').html("");
                            $.each(data, function(key, value) {
                                $('#products').append(
                                    '<tr onclick="select(' +value.id+ ',\'' +value.name+ '\',this>\
                                            <td>' + value.code + ' </td>\
                                            <td>' + value.name + ' </td>\
                                            <td>' + value.stock + '</td>\
                                        </tr>'
                                )
                            });
                        } else {
                            alert('Agrega un nuevo o busca por CI/NIT/CODIGO DE CLIENTE')
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('El valor no coresponde');
                    }
                });
            });
        });
    </script>
@stop
