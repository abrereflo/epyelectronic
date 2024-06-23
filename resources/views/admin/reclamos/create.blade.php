@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="callout callout-info text-info text-uppercase">
        <h4>Nuevo Registro</h4>
    </div>
@stop

@section('content')

<form action="{{ route('reclamos.store') }}" method="post">
    @csrf
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-4 invoice-col">
                        <div class="form-group">
                            <label for="">Buscar Cliente</label>
                            <div class="input-group">
                                <input type="text" id="clients_search" class="form-control" placeholder="Codi/CI/"
                                    data-prefetch="data.json">
                                <input type="hidden" id="clients_search-id">
                                <ul id="ui-id-1" tabindex="0"
                                    class="ui-menu ui-widget ui-widget-content ui-autocomplete ui-front"
                                    style="width: 401.667px; top: 253.8px; left: 285.5px; display: none;">
                                </ul>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <select multiple="" id="list-client" name="list-client" class="form-control d-none">
                            </select>
                        </div>
                </div>
                <div class="col-4 invoice-col">
                </div>
                <div class="col-sm-4 invoice-col text-right">
                    <h4 class=""><strong>N° {{ $number }}</strong><input type="hidden" name="number" value="{{ $number }}" readonly></h4>
                    <h5><strong>Fecha: {{ $date }}</strong></h5><br>
                </div>
            </div>
            <div class="row invoice-info" id="list-clients">
                <div class="col-sm-4 invoice-col">
                    <address>
                        <strong>Nombre: </strong><br>
                        <strong>N° documento: </strong><br>
                        <strong>Dirección: </strong>
                    </address>
                </div>

                <div class="col-sm-4 invoice-col">
                    <address>
                        <strong>Ciudad: </strong><br>
                        <strong>Empresa: </strong><br>
                        <strong>NIT: </strong><br>
                    </address>
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Buscar Producto</label>
                        <div class="input-group">
                            <input type="search" id="product_search" class="form-control form-control"
                                placeholder="N° serie">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <select multiple="" id="list-product" name="list-product" class="form-control d-none">
                        </select>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-inverse">
                <thead class="thead-inverse">
                    <tr>
                        <th>Producto</th>
                        <th>N° Serie</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody id="table-product">
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">
            <a href="{{ route('reclamos.index') }}" class="btn btn-danger"> Cancelar</a>
            <button type="submit" class="btn btn-info">Registrar</button>
        </div>
    </div>
</form>
@stop

@section('css')
@stop

@section('js')

{{--Buscar Cliente --}}
    <script>
        $('#clients_search').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('client.search') }}",
                    dataType: 'json',
                    data: {
                        name: request.term
                    },
                    success: function(data) {
                        if (data != null) {
                            $('#list-client').html("")
                            $('#list-client').removeClass("d-none");
                            $.each(data, function(key, value) {
                                $('#list-client').append(
                                    '<option  class="btn-click" value="' + value.id +
                                    '"> ' + value.fullname + '</option>'
                                )
                            })
                            console.log(data)
                        }
                    }
                });
            }
        });
    </script>
{{-- Seleccionar cliente --}}
<script>
    //Select dinamico tipo producto a familia producto
    $(document).ready(function() {
        $('select[name="list-client"]').on('change', function() {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    url: "{{ url('/admin/cliente/list') }}/" + id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#list-client').addClass("d-none");
                        $("#list-clients").empty();
                        $.each(data, function(key, value) {
                            console.log(value)
                            $("#list-clients").append('<div class="col-sm-4 invoice-col">\
                                    <address>\
                                        <input type="hidden" name="client_id" value="'+id+'">\
                                        <strong>Nombre: ' + value.name + '</strong><br>\
                                        <strong>N° documento: ' + value.ci + '</strong><br>\
                                        <strong>Dirección:' + value.address + ' </strong>\
                                    </address>\
                                </div>\
                                <div class="col-sm-4 invoice-col">\
                                    <address>\
                                        <strong>Ciudad: ' + value.city + '</strong><br>\
                                        <strong>Empresa:' + value.job + ' </strong><br>\
                                        <strong>NIT:' + value.nit + ' </strong><br>\
                                    </address>\
                                </div>')
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
</script>

  {{-- Bucar Producto --}}
    <script>
        $('#product_search').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('product.search') }}",
                    dataType: 'json',
                    data: {
                        name: request.term
                    },
                    success: function(data) {
                        if (data != null) {
                            $('#list-product').html("")
                            $('#list-product').removeClass("d-none");
                            $.each(data, function(key, value) {
                                $('#list-product').append(
                                    '<option  class="btn-click" value="' + value.id +
                                    '"> ' + value.name + '</option>'
                                )
                            })
                            console.log(data)
                        }
                    }
                });
            }
        });
    </script>


<script>
    //Select dinamico tipo producto a familia producto
    $(document).ready(function() {
        $('select[name="list-product"]').on('change', function() {
            var id = $(this).val();
            if (id) {
                var row = 0;
                $.ajax({
                    url: "{{ url('/admin/producto/list') }}/" + id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                    $('#list-product').addClass("d-none");
                        console.log(data)
                        $("#table-product").append('<tr>\
                                <td>'+data.name+'<input type="hidden" name="product_id[]" value="'+id+'"></td>\
                                <td><input type="text" class="form-control form-control-border border-width-2" name="serial[]" placeholder="numero serial"></td>\
                                <td><input type="text" class="form-control form-control-border border-width-2" name="description[]" placeholder="descripcion del problema"></td>\
                                </tr>');
                        row++;
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
</script>

@stop
