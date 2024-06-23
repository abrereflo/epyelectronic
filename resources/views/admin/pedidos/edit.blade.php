@extends('adminlte::page')

@section('title', 'Pedidos')

@section('content_header')
    <div class="card text-uppercase">
        <div class="card-header text-center">
            <h1>Editar Pedido</h1>
        </div>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-8">
            <form action="{{ route('orders.store') }}" method="post">
                @csrf
                <div class="card" id="pedido">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <div class="text-center text-uppercase">
                                    <h5>Datos de cliente</h5>
                                </div>
                            </div>
                            <div class="col">
                            </div>
                        </div>
                        <div class="row" id="list_client" >
                            <div class="col-8">
                                <div class="row" >
                                    <div class="col invoice-col text-uppercase">
                                        <address>
                                            <strong>Codigo: </strong>.....<br>
                                            <strong>Nombre Completo: </strong>.....<br>
                                            <strong>N° Carnet: </strong>.....<br>
                                            <strong>Celular: </strong>.....<br>
                                            <strong>Correo: </strong>.....
                                        </address>
                                    </div>
                                    <div class="col invoice-col text-uppercase">
                                        <address>
                                            <strong>NIT: </strong>.....<br>
                                            <strong>Razon Social: </strong>.....<br>
                                            <strong>Ciudad: </strong>.....<br>
                                            <strong>Dirección: </strong>.....<br>
                                        </address>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 invoice-col text-uppercase">
                                <b>Pedido #{{ $number_order }}</b><br>
                                <input id="numero_pedido" name="numero_pedido" type="hidden" class="form-control"
                                    value="{{ $number_order }}">
                                <br>
                                <strong>N° Cotización: </strong>.....<br>
                                <b>Fecha: </b>{{ $nowday }}<br>
                                <input id="datemask" name="fechaCotizacion" type="hidden" class="form-control"
                                    data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask
                                    value="{{ $nowday }}">
                            </div>
                        </div>
                    </div>
                    <div class="card-body" >
                        <div class="table-responsive">
                            <table class="table table-bordered  ">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <td class="text-center w-50">Nombre Producto</td>
                                        <td class="text-center">Cantidad</td>
                                        <td class="text-center">Precio Venta</td>
                                        <td class="text-center">Total</td>
                                        <td class="text-center"></td>
                                    </tr>
                                </thead>
                                <tbody id="purchaseTable">
                                    <?php $row = 0; ?>
                                    @if ($purchase_count > 0)
                                        @foreach ($purchased_products as $purchase)
                                            <tr id="list_details">
                                                <td>
                                                    <div class="form-group  clear"><input class="form-control "
                                                            id="product_id_' + {{ $purchase->product_id }} + '"
                                                            name="product_id[]" value="{{ $purchase->product_id }}"
                                                            type="hidden">{{ $purchase->product->name }}</div>
                                                </td>
                                                <td>
                                                    <div class="form-group  clear"> <input
                                                            class="form-control quantity quantity_{{ $row }}"
                                                            onkeydown="if(event.keyCode == 13){return nextrow({{ $row }} ,event,'quantity');}"
                                                            onchange="sumTotal({{ $purchase->product_id }});"
                                                            id="quantity_{{ $purchase->product_id }}" name="quantity[]"
                                                            value="{{ $purchase->quantity }}" min="0"
                                                            type="number">
                                                        <label class="text-danger alert_text"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group  clear"> <input
                                                            class="form-control  purchase_price purchase_price_{{ $row }}"
                                                            onkeydown="if (event.keyCode == 13){return nextrow({{ $row }},event,'purchase_price');}"
                                                            onchange="sumTotal({{ $purchase->product_id }});"
                                                            id="purchase_price_{{ $purchase->product_id }}"
                                                            name="purchase_price[]" min="0" step="0.01"
                                                            value="{{ $purchase->purchase_price }}" type="number">
                                                        <label class="text-danger alert_text"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group  clear"> <input
                                                            class="form-control total_amount  total_amount_{{ $row }}"
                                                            onkeydown="if (event.keyCode == 13){return nextrow({{ $row }},event,'total_amount');}"
                                                            name="total_amount[]" value="{{ $purchase->total_amount }}"
                                                            id="total_amount_{{ $purchase->product_id }}" type="number"
                                                            min="0" step="0.01"> <label
                                                            class="text-danger alert_text"></label> </div>
                                                </td>
                                                <td class="text-center"><a
                                                        onclick="deleteInfo({{ $purchase->id }},this);"
                                                        class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td>
                                            </tr>
                                            <?php $row++; ?>
                                        @endforeach
                                    @endif
                                </tbody>
                                <tfoot id="total">
                                    <tr class="">
                                        <th colspan="3" class="text-right "> Grand Total</th>
                                        <th id="total_amount" class="text-center"> {{ $grand_total }} </th>
                                        <input name="total" type="hidden" value="{{ $grand_total }}">
                                        <td>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer clearfix">
                        <div class="btn-group">
                            <div class="col">
                                <a href="{{ route('orders.index') }}" class="btn btn-primary bg-danger"
                                    style="margin-top: 2em; border: 0;">Cancelar</a>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary bg-success"
                                    style="margin-top: 2em; border: 0;">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <div class="text-center text-uppercase">
                        <h5>Cotizaciones Pendientes</h5>
                    </div>
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
                    <table id="detalles" class="table table-bordered text-uppercase">
                        <thead>
                            <tr class="text-center">
                                <th>N° Cotización</th>
                                <th>Cliente</th>
                                <th>fecha</th>
                            </tr>
                        </thead>
                        <tbody id="cotizaciones" class="text-center">
                            @foreach ($cotizaciones as $cotizacion)
                                <tr onclick="select( {{ $cotizacion->id }},' {{ $cotizacion->number }}',this)">
                                    <td>{{ $cotizacion->number }}</td>
                                    <td>{{ $cotizacion->clientee->name }} {{ $cotizacion->clientee->lastname }}</td>
                                    <td>{{ $cotizacion->date }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>

    @include('admin.cotizaciones.save')
@stop

@section('css')

@stop

@section('js')
<script>
    $(document).ready(function () {
        $('#detalles').dataTable({
            paging: true,
            searching: false,
            pageLength : 5,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
            info: false,
            language: { "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json" },
        });
    });
</script>
    <script>
        $('.select2').select2()
    </script>

    <script>
        var row = 0;
        row += '<?php echo $purchase_count; ?>'
        function select(id, number, e) {
            if (id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('admin/pedido/detalle') }}",
                    dataType: "json",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        $("#list_client").empty();
                        $("#purchaseTable").empty();
                        $("#total").empty();
                        $.each(data['data'],function(key, value)
                        {
                           $("#list_client").append('<div class="col-8">\
                                <div class="row">\
                                    <div class="col invoice-col text-uppercase">\
                                        <address>\
                                            <strong>Codigo: </strong>'+ value.code +'<br>\
                                            <strong>Nombre Completo: </strong>'+ value.name+' '+ value.lastname+'<br>\
                                            <strong>N° Carnet: </strong>'+ value.ci+'<br>\
                                            <strong>Celular: </strong>'+ value.phone+'<br>\
                                            <strong>Correo: </strong>'+ value.email+'\
                                        </address>\
                                    </div>\
                                    <div class="col invoice-col text-uppercase">\
                                        <address>\
                                            <strong>NIT: </strong>'+ value.nit+'<br>\
                                            <strong>Razon Social: </strong>'+ value.business_name +'<br>\
                                            <strong>Ciudad: </strong>'+value.city+'<br>\
                                            <strong>Dirección: </strong>'+value.address+'<br>\
                                        </address>\
                                    </div>\
                                </div>\
                            </div>\
                            <div class="col-4 invoice-col text-uppercase">\
                                <b>Pedido #{{ $number_order }}</b><br>\
                                <input id="numero_pedido" name="numero_pedido" type="hidden" class="form-control"\
                                    value="{{ $number_order }}"><br>\
                                <strong>N° Cotización: </strong>'+value.number+'<br>\
                                <input type="hidden" name="cotizacion_id" value="'+value.id+'">\
                                <b>Fecha: </b>{{ $nowday }}<br>\
                                <input id="datemask" name="fechapedido" type="hidden" class="form-control"\
                                    data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask\
                                    value="{{ $nowday }}">\
                            </div>')
                        });
                        $('#purchaseTable').html("")
                        $.each(data['dato'],function(key, value)
                        {
                            total_amount = value.amount * value.UnitPrice;

                            if(value.stock < value.amount)
                            {
                                $("#purchaseTable").append('<tr><td><div class="form-group  clear">'+
                                    '<input class="form-control "  id="product_id_' + value.product_id +'" name="product_id[]" value="' + value.product_id + '" type="hidden">' + value.name +' </div></td>'+
                                    '<td><div class="form-group text-danger clear"> <input class="form-control text-danger quantity quantity_' +row + '"' + ' onkeydown="if (event.keyCode == 13){return nextrow(' + row +
                                    ',event,\'quantity\');}"' + ' onchange="sumTotal(' + value.product_id +');" id="quantity_' + value.product_id + '"  name="quantity[]" value="'+ value.amount +'" min="0" type="number">  <label class="text-danger alert_text">En Stock hay</label> '+ value.stock +'</div></td>' +
                                    '<td><div class="form-group  clear"> <input class="form-control  purchase_price purchase_price_' +row + '"' + ' onkeydown="if (event.keyCode == 13){return nextrow(' + row +
                                    ',event,\'purchase_price\');}"' + ' onchange="sumTotal(' + value.product_id +');" id="purchase_price_' + value.product_id +'" name="purchase_price[]"  min="0" step="0.01" value="'+ value.UnitPrice +'" type="number" readonly><label class="text-danger alert_text"></label></div></td><td>' +
                                    '<div class="form-group  clear"> <input class="form-control total_amount  total_amount_' +
                                    row + '"' + ' onkeydown="if (event.keyCode == 13){return nextrow(' + row +',event,\'total_amount\');}"' +' name="total_amount[]"  value="'+ total_amount  +'" id="total_amount_' + value.product_id +'" type="number" min="0" step="0.01" readonly> <label class="text-danger alert_text"></label></div> ' +
                                    ' </td><td class="text-center"><a onclick="removePurchase(this)" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td></tr>'
                                );
                            }
                            else
                            {
                                $("#purchaseTable").append('<tr><td><div class="form-group  clear">'+
                                    '<input class="form-control "  id="product_id_' + value.product_id +'" name="product_id[]" value="' + value.product_id + '" type="hidden">' + value.name +' </div></td>'+
                                    '<td><div class="form-group  clear"> <input class="form-control quantity quantity_' +row + '"' + ' onkeydown="if (event.keyCode == 13){return nextrow(' + row +
                                    ',event,\'quantity\');}"' + ' onchange="sumTotal(' + value.product_id +');" id="quantity_' + value.product_id + '"  name="quantity[]" value="'+ value.amount +'" min="0" type="number">  <label class="text-danger alert_text"></label></div></td>' +
                                    '<td><div class="form-group  clear"> <input class="form-control  purchase_price purchase_price_' +row + '"' + ' onkeydown="if (event.keyCode == 13){return nextrow(' + row +
                                    ',event,\'purchase_price\');}"' + ' onchange="sumTotal(' + value.product_id +');" id="purchase_price_' + value.product_id +'" name="purchase_price[]"  min="0" step="0.01" value="'+ value.UnitPrice +'" type="number" readonly><label class="text-danger alert_text"></label></div></td><td>' +
                                    '<div class="form-group  clear"> <input class="form-control total_amount  total_amount_' +
                                    row + '"' + ' onkeydown="if (event.keyCode == 13){return nextrow(' + row +',event,\'total_amount\');}"' +' name="total_amount[]"  value="'+ total_amount +'" id="total_amount_' + value.product_id +'" type="number" min="0" step="0.01" readonly> <label class="text-danger alert_text"></label></div> ' +
                                    ' </td><td class="text-center"><a onclick="removePurchase(this)" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td></tr>'
                                );
                            }



                        });
                        $.each(data['data'],function(key, value)
                        {
                            $("#total").append('<tr class="">\
                                <th colspan="3" class="text-right "> Grand Total</th>\
                                <th id="total_amount" class="text-center"><input name="total" type="hidden" value="'+value.totalprice+'"> '+value.totalprice+' </th>\
                                <td></td>\
                            </tr>');
                        });

                    },
                    error: function(e) {
                        console.log(e)
                    }
                });
            }
        }

        function sumTotal(id) {

            var total = $('#quantity_' + id).val() * $('#purchase_price_' + id).val();
            $('#total_amount_' + id).val(total);
            var sum = 0.0;
            $('.total_amount').each(function() {
                sum += Number($(this).val());
            });
            $('#total_amount').html(sum);

        }

        //remove purchase
        function removePurchase(e) {
            if (confirm("Are you sure to remove Purchase?")) {
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
