@extends('adminlte::page')

@section('title', 'Cotizaciones')

@section('content_header')
    <div class="card text-uppercase">
        <div class="card-header text-center">
            <h1>Editar Cotización</h1>
        </div>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-7">
            <div class="card">
                <form action="{{ route('quote.store') }}" method="post">
                    @csrf
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <div class="text-center text-uppercase">
                                    <h5>Datos de cliente</h5>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control search_client" placeholder="Buscar N° Codigo/carnet" >
                                        <div class="input-group-append">
                                            <a id="btn_sarch" class="btn btn_sarch btn-primary">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        </div>
                                        <div class="input-group-append">
                                            <a type="button" class="btn btn-success text-uppercase" data-toggle="modal" data-target="#ModalCreate">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="row" id="list_client">
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
                                <b>Cotización #{{ $number_quote }}</b><br>
                                <input id="numeroCotizacion" name="numeroCotizacion" type="hidden" class="form-control"
                                    value="{{ $number_quote }}">
                                <br>
                                <b>Fecha: </b>{{ $nowday }}<br>
                                <input id="datemask" name="fechaCotizacion" type="hidden" class="form-control"
                                    data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask
                                    value="{{ $nowday }}">
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
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
                                        @foreach ($purchased_products as $product)
                                            <tr>
                                                <td>
                                                    <div class="form-group  clear"><input class="form-control "
                                                            id="product_id_' + {{ $product->product_id }} + '"
                                                            name="product_id[]" value="{{ $product->product_id }}"
                                                            type="hidden">{{ $product->product->name }}</div>
                                                </td>
                                                <td>
                                                    <div class="form-group  clear"> <input
                                                            class="form-control quantity quantity_{{ $row }}"
                                                            onkeydown="if(event.keyCode == 13){return nextrow({{ $row }} ,event,'quantity');}"
                                                            onchange="sumTotal({{ $product->product_id }});"
                                                            id="quantity_{{ $product->product_id }}" name="quantity[]"
                                                            value="{{ $product->stock }}" min="0"
                                                            type="number">
                                                        <label class="text-danger alert_text"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group  clear"> <input
                                                            class="form-control  purchase_price purchase_price_{{ $row }}"
                                                            onkeydown="if (event.keyCode == 13){return nextrow({{ $row }},event,'purchase_price');}"
                                                            onchange="sumTotal({{ $product->product_id }});"
                                                            id="purchase_price_{{ $product->product_id }}"
                                                            name="purchase_price[]" min="0" step="0.01"
                                                            value="{{ $product->cost }}" type="number">
                                                        <label class="text-danger alert_text"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group  clear"> <input
                                                            class="form-control total_amount  total_amount_{{ $row }}"
                                                            onkeydown="if (event.keyCode == 13){return nextrow({{ $row }},event,'total_amount');}"
                                                            name="total_amount[]" value="{{ $product->total_amount }}"
                                                            id="total_amount_{{ $product->product_id }}" type="number"
                                                            min="0" step="0.01"> <label
                                                            class="text-danger alert_text"></label> </div>
                                                </td>
                                                <td class="text-center"><a
                                                        onclick="deleteInfo({{ $product->id }},this);"
                                                        class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td>
                                            </tr>
                                            <?php $row++; ?>
                                        @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr class="">
                                        <th colspan="3" class="text-right "> Grand Total</th>
                                        <th id="total_amount"  class="text-center">
                                            {{ $grand_total }}
                                       </th>
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
                                <button type="submit" class="btn btn-primary bg-success"
                                    style="margin-top: 2em; border: 0;">Guardar</button>
                            </div>
                            <div class="col">
                                <a href="{{ route('quote.index') }}" class="btn btn-primary bg-danger"
                                    style="margin-top: 2em; border: 0;">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    <div class="text-center text-uppercase">
                        <h5>Productos</h5>
                    </div>
                {{--     <div class="form-group text-uppercase">
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
                    </div> --}}
                </div>
                <div class="row text-uppercase">
                   {{--  <div class="col-sm-12 col-md-7">
                        {{ $productos->links() }}
                    </div> --}}
                    {{-- <div class="col-sm-12 col-md-5 text-info">
                      Pagina: {{$productos->currentPage()}},  total: {{$productos->total()}}
                    </div> --}}
                </div>
                <div class="card-body">
                    <table id="detalles" class="table table-bordered dt-responsive text-uppercase">
                        <thead>
                            <tr class="text-center">
                                <th>Codigo</th>
                                <th>Producto</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody id="products" class="text-center">
                            @foreach ($productos as $producto)
                                <tr onclick="select( {{ $producto->id }},' {{ $producto->name }}',this)">
                                    <td>{{ $producto->code }}</td>
                                    <td>{{ $producto->productfamily->productstype->name }} {{ $producto->productfamily->name }} {{ $producto->name }}</td>
                                    <td>{{ $producto->salePrice }}</td>
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
            resposive: true,
            width: 100,
            searching: true,
            pageLength : 5,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
            info: false,
            language: { "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json" },
            /*  buttons: ['print', 'excel', 'pdf'], */
        });
    });
</script>

<script>
    $('.select2').select2()
</script>


{{-- buscador de cliente ci nit codigo --}}
<script>
    $(document).ready(function() {
        $("#btn_sarch").click(function(e) {
                e.preventDefault();
                var search = $(".search_client").val();
                $.ajax({
                    url: "{{ route('quote.bcliente') }}",
                    type: 'GET',
                    data: {
                        search: search
                    },
                    success: function(data) {
                        console.log(data);
                        if (data != null) {
                            $('#list_client').html("");
                            $.each(data, function(key, value) {
                                $('#list_client').append(
                                    '     <div class="col invoice-col text-uppercase">\
                                                    <address>\
                                                        <input type="hidden" name="client_id" value="' + value.id + '" readonly>\
                                                        <strong>Codigo: </strong>' + value.code + '<br>\
                                                        <strong>Nombre Completo: </strong>' + value.name + ' ' + value.lastname + '<br>\
                                                        <strong>N° Carnet: </strong>' + value.ci + '<br>\
                                                        <strong>Celular: </strong>' + value.phone + '<br>\
                                                        <strong>Correo: </strong>' + value.email + '\
                                                    </address>\
                                                </div>\
                                                <div class="col invoice-col text-uppercase">\
                                                    <address>\
                                                        <strong>NIT: </strong>' + value.nit + '<br>\
                                                        <strong>Razon Social: </strong>' + value.business_name + '<br>\
                                                        <strong>Ciudad: </strong>' + value.city + '<br>\
                                                        <strong>Dirección: </strong>' + value.address + '<br>\
                                                    </address>\
                                                </div>'
                                )
                            });
                        } else {
                            alert('Agrega un nuevo o busca por CI/NIT/CODIGO DE CLIENTE')
                        }
                }
            });
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
                                    '<tr onclick="select(' + value.id + ',\'' +
                                    value.name + '\',this)">\
                                        <td>' + value.code + '</td>\
                                        <td>' + value.name + '</td>\
                                        <td>' + value.price + '</td>\
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

    <script>
        var row = 0;
        if ('<?php echo $purchase_count; ?>' > 0) {
            console.log("called");
            row += '<?php echo $purchase_count; ?>'
        }
        function select(id, name, e) {
            var search_client = $("#search_client").val();
            console.log(search_client);
            if (search_client <= 0) {
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
                        search_client: search_client
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
                            price = response[0].salePrice;
                            $("#purchaseTable").append('<tr><td><div class="form-group  clear">'+
                                '<input class="form-control "  id="product_id_' + id +'" name="product_id[]" value="' + id + '" type="hidden">' + name +' </div></td>'+
                                '<td><div class="form-group  clear"> <input class="form-control quantity quantity_' +row + '"' + ' onkeydown="if (event.keyCode == 13){return nextrow(' + row +
                                ',event,\'quantity\');}"' + ' onchange="sumTotal(' + id +');" id="quantity_' + id + '"  name="quantity[]" value="0" min="0" type="number">  <label class="text-danger alert_text"></label></div></td>' +
                                '<td><div class="form-group  clear"> <input class="form-control  purchase_price purchase_price_' +row + '"' + ' onkeydown="if (event.keyCode == 13){return nextrow(' + row +
                                ',event,\'purchase_price\');}"' + ' onchange="sumTotal(' + id +');" id="purchase_price_' + id +'" name="purchase_price[]"  min="0" step="0.01" value="' + price +'" type="number"><label class="text-danger alert_text"></label></div></td><td>' +
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

    {{-- crear cliente --}}
    <script>
        $(function() {
            $('#add-client').on('submit', function(e) {
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
                            $('#list_client').html("");
                            $.each(response, function(key, value) {
                                $('#list_client').append('<input type="hidden" id="search_client" class="search_client" name="client_id" value="' + value.id + '" readonly>')
                                $('#list_client').append(
                                    '     <div class="col invoice-col text-uppercase">\
                                                    <address>\
                                                        <input type="hidden" name="client_id" value="' + value.id + '" readonly>\
                                                        <strong>Codigo: </strong>' + value.code + '<br>\
                                                        <strong>Nombre Completo: </strong>' + value.name + ' ' + value
                                    .lastname + '<br>\
                                                        <strong>N° Carnet: </strong>' + value.ci + '<br>\
                                                        <strong>Celular: </strong>' + value.phone + '<br>\
                                                        <strong>Correo: </strong>' + value.email + '\
                                                    </address>\
                                                </div>\
                                                <div class="col invoice-col text-uppercase">\
                                                    <address>\
                                                        <strong>NIT: </strong>' + value.nit + '<br>\
                                                        <strong>Razon Social: </strong>' + value.business_name + '<br>\
                                                        <strong>Ciudad: </strong>' + value.city + '<br>\
                                                        <strong>Dirección: </strong>' + value.address + '<br>\
                                                    </address>\
                                                </div>'
                                )
                            });
                        }
                    }
                });
            });
        });
    </script>
@stop
