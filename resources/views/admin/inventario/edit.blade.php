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
            <form action="{{ route('inventories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="callout callout-info">
                        <div class="text-center text-info text-uppercase">
                            <h5>EDITAR REGISTRO</h5>
                        </div>
                    </div>
                    <div class="card-header">
                        <div class="form-group text-uppercase">
                            <div class="input-group" id="search-proveedor">
                                <input id="proveedor_search" type="search" class="form-control" value="{{ $inventario->proveedor->full_name }}" placeholder="Buscar Proveedor">
                                <div class="input-group-append" >
                                    <a id="btn_proveedor" class="btn btn-primary" data-toggle="modal" data-target="#ModalCreate">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <select multiple="" id="list-proveedor" name="list-proveedor" class="form-control d-none">
                            </select>
                        </div>
                        <div class="callout callout-info">
                            <label for="">Datos del Proveedor</label>
                        <div class="row" id="listproveedor">
                            <div class="col">
                                <div class="text-left text-uppercase">
                                    <div class="col"><label for="" class="text-info">Nombre:</label> {{ $inventario->proveedor->full_name }}</div>
                                    <div class="col"><label for="" class="text-info">Celuar:</label> {{ $inventario->proveedor->phone }}</div>
                                    <div class="col"><label for="" class="text-info">Direccion:</label> {{ $inventario->proveedor->direction }}</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-left text-uppercase">
                                    <div class="col"><label for="" class="text-info">Razon Social:</label> {{ $inventario->proveedor->business_name }}</div>
                                    <div class="col"><label for="" class="text-info">Celuar Corporativo:</label> {{ $inventario->proveedor->phone_company }}</div>
                                    <div class="col"><label for="" class="text-info">NIT o CI:</label> {{ $inventario->proveedor->nit }}</div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col">

                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>N° Factura o Recibo</label>
                                    <input type="text" class="form-control" name="numero" value="{{ $inventario->nit }}" placeholder="N° Factura / Recibo">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Fecha:</label>
                                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                          <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" value="{{ $inventario->fecha }}">
                                          <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                          </div>
                                      </div>
                                  </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <table id="detalles2" class="table table-bordered text-uppercase">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Costo</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>

                                    <tbody id="purchaseTable">
                                        <?php $row=0;?>
                                        @if ($purchase_count > 0)
                                        @foreach ($inventario->producto as $product)
                                            <tr>
                                                <td><div class="form-group  clear"><input class="form-control "  id="product_id_' + {{$product->pivot->product_id}} + '" name="product_id[]" value="{{$product->pivot->product_id}}" type="hidden">{{$product->name}}</div></td>
                                                <td><div class="form-group  clear"> <input class="form-control quantity quantity_{{$row}}" onkeydown="if(event.keyCode == 13){return nextrow({{$row}} ,event,'quantity');}" onchange="sumTotal({{$product->pivot->product_id}});" id="quantity_{{$product->pivot->product_id}}"  name="quantity[]" value="{{$product->pivot->quantity}}" min="0" type="number">  <label class="text-danger alert_text"></label></div></td>
                                                <td><div class="form-group  clear"> <input class="form-control  product_price product_price_{{$row}}" onkeydown="if (event.keyCode == 13){return nextrow({{$row}},event,'product_price');}" onchange="sumTotal({{$product->pivot->product_id}});" id="product_price_{{$product->pivot->product_id}}" name="product_price[]"  min="0" step="0.01" value="{{$product->pivot->price}}" type="number">  <label class="text-danger alert_text"></label></div></td>
                                                <td><div class="form-group  clear"> <input class="form-control total_amount  total_amount_{{$row}}" onkeydown="if (event.keyCode == 13){return nextrow({{$row}},event,'total_amount');}" name="total_amount[]"  value="{{$product->pivot->total_amount}}" id="total_amount_{{$product->pivot->product_id}}" type="number" min="0" step="0.01" > <label class="text-danger alert_text"></label> </div></td>
                                                <td class="text-center"><a onclick="deleteInfo({{$product->pivot->id}},this);" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td>
                                            </tr>
                                            <?php $row++;?>
                                            @endforeach
                                        @endif
                                        </tbody>
                                        <tfoot>
                                        <tr class="">
                                            <th colspan="3" class="text-center "> Grand Total</th>
                                            <th id="grand_total" class="text-center">
                                                {{$grand_total}}
                                            </th>
                                            <td></td>
                                        </tr>
                                        </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-uppercase">
                        <a class="btn btn-danger" href="{{ route('inventories.index') }}">Cancelar</a>
                        <button type="submit" class="btn btn-info">Registrar</button>
                    </div>
                </div>
            </form>
        </div>

    @include('admin.proveedor.create', ['content' => 'inventario'])

    <div class="col-5">
            <div class="card">
                <div class="callout callout-info">
                    <div class="text-center text-info text-uppercase">
                        <h5>Productos</h5>
                    </div>
                </div>
                <div class="card-header">
                </div>
                <div class="card-body">
                    <table id="detalles" class="table table-bordered text-uppercase">
                        <thead>
                            <tr class="text-center">
                                <th>Codigo</th>
                                <th>Tipo</th>
                                <th>Famalia</th>
                                <th>Producto</th>

                            </tr>
                        </thead>
                        <tbody id="products">
                            @foreach ($productos as $producto)
                                <tr  onclick="select( {{ $producto->id }},' {{ $producto->name }}' ,this)">
                                    <td>{{ $producto->code }}</td>
                                    <td>{{ $producto->productfamily->name }}</td>
                                    <td>{{ $producto->productfamily->productstype->name }}</td>
                                    <td>{{ $producto->name }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        </tfoot>
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
    $('#reservationdate').datetimepicker({
        format: 'yy/M/D'
    });
</script>
{{-- detalle de producto --}}
<script>
    $(document).ready(function () {
        $('#detalles').dataTable({
            paging: true,
            searching: true,
            pageLength : 5,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
            info: false,
            language: { "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json" },
        });
    });
</script>

{{-- nuevo proveedor --}}
<script>
    $(function() {
        $('#add-proveedor').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(form).find('span.error-text').text('');
                },
                success: function(response) {
                    console.log(response);
                    if (response.status == 400) {
                        $('#list_errors').html("");
                        $('#list_errors').addClass('alert alert-danger');
                        $.each(response.errors, function(key, error_value) {
                            $('#list_errors').append('<li>' + error_value + '</li>')
                        });
                    } else {

                        $('#list_errors').html("");
                        $('#ModalCreate').modal('hide');
                        $('#ModalCreate').find('input').val("");
                        $('#listproveedor').html("");
                        $('#search-proveedor').html("");
                        $.each(response, function(key, value) {
                            console.log(value);
                            $('#search-proveedor').append('<input id="proveedor_search" type="search" class="form-control" value="' + value.full_name + '" placeholder="Buscar Proveedor">\
                                <div class="input-group-append" >\
                                    <a id="btn_proveedor" class="btn btn-primary" data-toggle="modal" data-target="#ModalCreate">\
                                        <i class="fa fa-plus"></i>\
                                    </a>\
                                </div>')

                            $('#listproveedor').append('<div class="col">\
                                <div class="text-left text-uppercase">\
                                    <input type="hidden" value="' + value.id + '" name="proveedor_id">\
                                    <div class="col"><label for="" class="text-info">Nombre:</label> ' + value.full_name + '</div>\
                                    <div class="col"><label for="" class="text-info">Celuar:</label> ' + value.phone + '</div>\
                                    <div class="col"><label for="" class="text-info">Direccion:</label> ' + value.direction + '</div>\
                                </div>\
                            </div>\
                            <div class="col">\
                                <div class="text-left text-uppercase">\
                                    <div class="col"><label for="" class="text-info">Razon Social:</label> ' + value.business_name + '</div>\
                                    <div class="col"><label for="" class="text-info">Celuar Corporativo:</label> ' + value.phone_company + '</div>\
                                    <div class="col"><label for="" class="text-info">NIT o CI:</label> ' + value.nit + '</div>\
                                </div>\
                            </div>')
                        });
                    }
                }
            });
        });
    });
</script>

{{-- Buscar proveedor --}}
<script>
    $('#proveedor_search').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{{ route('proveedor.search') }}",
                dataType: 'json',
                data: {
                    name: request.term
                },
                success: function(data) {
                    if (data != null) {
                        $('#list-proveedor').html("")
                        $('#list-proveedor').removeClass("d-none");
                        $.each(data, function(key, value) {
                            $('#list-proveedor').append(
                                '<option  class="btn-click" value="' + value.id +
                                '"> ' + value.full_name + '</option>'
                            )
                        })
                        console.log(data)
                    }
                }
            });
        }
    });
</script>

{{-- Select dinamico proveedor --}}
<script>
    $(document).ready(function() {
        $('select[name="list-proveedor"]').on('change', function() {
            var id = $(this).val();
            if (id) {
                var row = 0;
                $.ajax({
                    url: "{{ url('/admin/proveedor/list/') }}/" + id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                    $('#listproveedor').html("");
                    $('#list-proveedor').addClass("d-none");
                        console.log(data)
                        $("#listproveedor").append('<div class="col">\
                                <div class="text-left text-uppercase">\
                                    <input type="hidden" value="' + data.id + '" name="proveedor_id">\
                                    <div class="col"><label for="" class="text-info">Nombre:</label> ' + data.full_name + '</div>\
                                    <div class="col"><label for="" class="text-info">Celuar:</label> ' + data.phone + '</div>\
                                    <div class="col"><label for="" class="text-info">Direccion:</label> ' + data.direction + '</div>\
                                </div>\
                            </div>\
                            <div class="col">\
                                <div class="text-left text-uppercase">\
                                    <div class="col"><label for="" class="text-info">Razon Social:</label> ' + data.business_name + '</div>\
                                    <div class="col"><label for="" class="text-info">Celuar Corporativo:</label> ' + data.phone_company + '</div>\
                                    <div class="col"><label for="" class="text-info">NIT o CI:</label> ' + data.nit + '</div>\
                                </div>\
                            </div>');
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
</script>

{{-- Seleccion dinamico producto --}}
<script>
    var row = 0;

    function select(id, name, e) {
        var proveedor_search = $("#proveedor_search").val();
        console.log(proveedor_search);
        if (proveedor_search <= 0) {
            alert("Busque un cliente o agrega");
        } else {
            $(e).remove();
            $(".result").remove();
            var manu2, exp2;
            $.ajax({
                type: "get",
                url: "{{ url('admin/cotizacion/table') }}",
                data: {
                    id: id,
                    proveedor_search: proveedor_search
                },
                success: function(response) {
                    if (response == '') {
                        manu2 = '';
                        exp2 = '';
                        $("#purchaseTable").append('<tr><td><div class="form-group  clear"> ' +
                            '<input class="form-control product_id"  id="product_id_' + id + '"' +
                            ' onkeydown="if (event.keyCode == 13){return nextrow(' + row +
                            ',event,\'product_id\');}"' + ' name="product_id[]" value="' + id +
                            '" type="hidden">' + name + ' </div></td>' +
                            '<td><div class="form-group   clear"> <input class="form-control quantity quantity_' +
                            row + '"' + ' onkeydown="if (event.keyCode == 13){return nextrow(' + row +
                            ',event,\'quantity\');}"' + ' onchange="sumTotal(' + id +
                            ');" id="quantity_' + id +
                            '"  name="quantity[]" value="0" min="0" type="number">  <label class="text-danger alert_text"></label></div></td>' +
                            '<td><div class="form-group  clear"> <input class="form-control purchase_price purchase_price_' +
                            row + '"' + ' onkeydown="if (event.keyCode == 13){return nextrow(' + row +
                            ',event,\'purchase_price\');}"' + ' onchange="sumTotal(' + id +
                            ');" id="purchase_price_' + id +
                            '" name="purchase_price[]" value="'+ price +'"  min="0" step="0.01" type="number"> <label class="text-danger alert_text"></label> </div></td><td>' +
                            '<div class="form-group  clear"> <input class="form-control total_amount total_amount_' +
                            row + '"' + ' onkeydown="if (event.keyCode == 13){return nextrow(' + row +
                            ',event,\'total_amount\');}"' +
                            ' name="total_amount[]" type="number" min="0" step="0.01" value="0" id="total_amount_' +
                            id + '"> <label class="text-danger alert_text"></label> </div> ' +
                            ' </td><td class="text-center"><a onclick="removePurchase(this)" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td></tr>'
                        );
                    } else {
                        manu2 = response[0].manufacturing_date;
                        exp2 = response[0].expired_date;
                        price = 0;
                        $("#purchaseTable").append('<tr><td><div class="form-group  clear">'+
                            '<input class="form-control "  id="product_id_' + id +'" name="product_id[]" value="' + id + '" type="hidden">' + name +' </div></td>'+
                            '<td><div class="form-group  clear"> <input class="form-control quantity quantity_' +row + '"' + ' onkeydown="if (event.keyCode == 13){return nextrow(' + row +
                            ',event,\'quantity\');}"' + ' onchange="sumTotal(' + id +');" id="quantity_' + id + '"  name="quantity[]" value="0" min="0" type="number">  <label class="text-danger alert_text"></label></div></td>' +
                            '<td><div class="form-group  clear"> <input class="form-control  purchase_price purchase_price_' +row + '"' + ' onkeydown="if (event.keyCode == 13){return nextrow(' + row +
                            ',event,\'purchase_price\');}"' + ' onchange="sumTotal(' + id +');" id="purchase_price_' + id +'" name="purchase_price[]"  min="0" step="0.01" value="0" type="number"><label class="text-danger alert_text"></label></div></td><td>' +
                            '<div class="form-group  clear"> <input class="form-control total_amount  total_amount_' +
                            row + '"' + ' onkeydown="if (event.keyCode == 13){return nextrow(' + row +',event,\'total_amount\');}"' +' name="total_amount[]"  value="0" id="total_amount_' + id +'" type="number" min="0" step="0.01" > <label class="text-danger alert_text"></label></div> ' +
                            ' </td><td class="text-center"><a onclick="removePurchase(this)" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td></tr>'
                        );

                    }

                },
                error: function(e) {
                    console.log(e)
                }
            });
            row++;
        }
    }
    function sumTotal(id) {
            var total = $('#quantity_' + id).val() * $('#purchase_price_' + id).val();
            $('#total_amount_' + id).val(total);
            var sum = 0.0;
            $('.total_amount').each(function () {
                sum += Number($(this).val());
            });

            $('#grand_total').html(sum);
            $("#grand_total2").append('<input type="hidden" name="total" id="grand_total" value="'+sum+'" >')

        }

   /*  function sumTotal(id) {
        var total = $('#quantity_' + id).val() * $('#purchase_price_' + id).val();
        $('#total_amount_' + id).val(total);
        var sum = 0.0;
        $('.total_amount').each(function() {
            sum += Number($(this).val());
        });
        $('#total_amount').html(sum);

    } */

    //remove purchase
    function removePurchase(e) {
        if (confirm("Estas seguro de remover el producto?")) {
            $(e).parent().parent().remove(); //play with data
            var sum = 0.0;

            $('.total_amount').each(function() {
                sum += Number($(this).val());
            });

            $('#total_amount').html(sum);
        }
        row--;
    }
</script>
@stop
