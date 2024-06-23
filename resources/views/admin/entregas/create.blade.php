@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="callout callout-info text-info text-uppercase">
        <h4>Entregas</h4>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-7">
            <form action="{{ route('entregas.store') }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="row invoice-info">
                            <div id="client" class="col invoice-col text-uppercase">
                                <div>
                                    Cliente
                                    <address>
                                        <strong>Nombre: </strong>... <br>
                                        <strong>Celular: </strong> (+591) ... <br>
                                        <strong>Correo: </strong>... <br>
                                        <strong>Ciudad: </strong>...
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div>
                                    Empresa
                                    <address>
                                        <strong>Razon Social: </strong>... <br>
                                        <strong>NIT: </strong>... <br>
                                    </address>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col text-uppercase">
                                <b>Entraga # {{ $number_de }}</b><br>
                                <input type="hidden" id="elemento" class="form-control" name="number"
                                    value="{{ $number_de }}" readonly>
                                <br>
                                <b>Fecha:</b>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" name="nowday" class="form-control datetimepicker-input"
                                        data-target="#reservationdate" required>
                                    <div class="input-group-append" data-target="#reservationdate"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <br>
                                <b>Hora:</b>
                                <div class="input-group date" id="timepicker" data-target-input="nearest">
                                    <input type="text" name="hour" class="form-control datetimepicker-input"
                                        data-target="#timepicker" required>
                                    <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                </div>


                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="text-uppercase">
                            <div class="form-group" id="direction">
                                <label>dirección de entrega: </label>
                                <input type="text" class="form-control" name="direction" placeholder="Dirección..."
                                    readonly>
                            </div>
                        </div>
                        <div class="text-uppercase">
                            <div class="form-group">
                                <label>Referencia o observacion: </label>
                                <textarea class="form-control" rows="3" name="reference" placeholder="Enter ..." required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0 text-uppercase">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Nombre Producto</th>
                                    <th>Numero de serial</th>
                                </tr>
                            </thead>
                            <tbody id="detail">

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-muted">
                        <div class="btn-group">
                            <div class="col">
                                <a href="{{ route('entregas.index') }}" class="btn btn-primary bg-danger"
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

        {{-- para los pedidos --}}

        <div class="col-5">
            <div class="card text-uppercase">
                <div class="callout callout-info text-info">
                    Pedidos
                </div>
                <div class="card-body">
                    <table id="pedidos" class="table text-center">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Numero Ped.</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody id="detail">
                            @foreach ($pedidos as $pedido)
                                {{-- @if ($pedido->cotizacion->clientee->city == 'LA PAZ') --}}
                                <tr
                                    onclick="select( {{ $pedido }},{{ $pedido->id }},' {{ $pedido->quotations_id }}' ,this)">
                                    <td scope="row">{{ $pedido->cotizacion->clientee->name  }} {{ $pedido->cotizacion->clientee->lastname  }}</td>
                                    <td>{{ $pedido->number }}</td>
                                    <td>{{ $pedido->date }}</td>
                                </tr>
                                {{-- @endif --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted">
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script>
        document.addEventListener('keypress', function(evt) {
            // Si el evento NO es una tecla Enter
            if (evt.key !== 'Enter') {
                return;
            }
            let element = evt.target;
            // Si el evento NO fue lanzado por un elemento con class "focusNext"
            if (!element.classList.contains('focusNext')) {
                return;
            }
            // AQUI logica para encontrar el siguiente
            let tabIndex = element.tabIndex + 1;
            var next = document.querySelector('[tabindex="' + tabIndex + '"]');
            // Si encontramos un elemento
            if (next) {
                next.focus();
                event.preventDefault();
            }
        });
    </script>
    <script>

        $('#reservationdate').datetimepicker({
            format: 'Y/MM/DD'
        });

        $('#timepicker').datetimepicker({
            format: 'HH:mm',
        })
    </script>

    <script>
        $(document).ready(function () {
        $('#pedidos').dataTable({
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
        function select(pedido, id, client_id, event) {
            console.log(id);
            $.ajax({
                type: "GET",
                url: "{{ url('admin/entregas/pedido') }}",
                dataType: "json",
                data: {
                    id: id,
                    client_id: client_id,
                },
                success: function(data) {
                    $('#detail').empty();
                    $('#client').empty();
                    $('#direction').empty();
                    $.each(data['data'], function(key, value) {
                        $('#client').append(
                            '<div>\
                                        Cliente\
                                        <address>\
                                            <input type="hidden" id="elemento" class="form-control" name="pedido_id" value="' +
                            value.pedido_id + '" readonly>\
                                            <strong>Nombre: </strong> ' + value.cliente_name + ' ' + value
                            .cliente_lastname + '<br>\
                                            <strong>Celular: </strong> (+591)' + value.cliente_phone + '<br>\
                                            <strong>Correo: </strong> ' + value.cliente_email + ' <br>\
                                            <strong>Ciudad: </strong>' + value.city + '\
                                        </address>\
                                    </div>\
                                    <div>\
                                        Empresa\
                                        <address>\
                                            <strong>Razon Social: </strong> ' + value.business_name + '<br>\
                                            <strong>NIT: </strong> ' + value.nit + ' <br>\
                                        </address>\
                                    </div>'
                        )
                        if (value.city != 'LA PAZ') {
                            $('#direction').append('<label>dirección de entrega: </label>\
                                    <input type="text" class="form-control"  name="direction" value="Terminal" readonly>')
                        } else {
                            $('#direction').append(
                                '<label>dirección de entrega: </label>\
                                    <input type="text" class="form-control"  name="direction" value="" placeholder="Dirección...">')
                        }
                    });
                    $.each(data['dato'], function(key, value) {
                        var i = 0;
                        for (let index = 0; index < value.amount; index++) {
                            $('#detail').append(
                                '<tr>\
                                        <td>' + value.product +
                                '  <input type="hidden" id="elemento" class="form-control" name="product_id[]" value="' +
                                value.product_id +
                                '" readonly></td>\
                                        <td>\
                                             <input type="text" class="form-control form-control-border focusNext" tabindex="' + i + '"  name="sn[]" id="sn" placeholder="NUMERO SERIAL">\
                                        </td>\
                                    </tr>'
                            )
                        }
                    });
                }
            });
        }
    </script>
@stop
