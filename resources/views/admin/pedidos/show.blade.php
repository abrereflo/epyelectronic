@extends('adminlte::page')

@section('title', 'EPY Electronica')

@section('content_header')
    <div class="callout callout-info">
        <h4 class="text-info">
            <img src="{{ url('http://127.0.0.1:8000/vendor/adminlte/dist/img/logofinal.png') }}"
                class="brand-image img-circle elevation-3" style="opacity:.8;" height="40" width="40"> EPY ELectronica
            <small class="float-right">Fecha: {{ $fechaHoy }}</small>
        </h4>
    </div>
@stop

@section('content')
    <!-- Content Header (Page header) -->

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3 class="text-info">Datos de Empresa</h3>
                    <address>
                        <strong>EPY Electronica</strong><br>
                        <strong>Dirección: </strong>La Paz, Av. Jaimes Freyre #2088 Ref. Restaurante El Pollo
                        Académico<br>
                        <strong>WhatsApp: </strong> 79652343 -71541075 -6090201<br>
                        <strong>Correo: </strong> ordonezcallisayabernardo@gmail.com
                    </address>
                </div>
                <!-- /.col -->
                <div class="col">
                    <h3 class="text-info">Datos de Cliente</h3>

                    @if ($pedidos->cotizacion->clientes_id == '1')
                        <address>
                            <strong> </strong><br>
                            <strong>Nombre: </strong>Sin nombre<br>
                            <strong>Celular: </strong>Sin Celular<br>
                            <strong>Correo: </strong>sin correo<br>
                            <strong>Carnet: </strong>sin Carnet <br>
                        </address>
                    @else
                        <address>
                            <strong>{{ $pedidos->cotizacion->clientee->codigoCliente }} </strong><br>
                            <strong>Nombre: </strong>{{ $pedidos->cotizacion->clientee->name }}
                            {{ $pedidos->cotizacion->clientee->lastname }} <br>
                            <strong>Celular: </strong>{{ $pedidos->cotizacion->clientee->phone }} <br>
                            <strong>Correo: </strong>{{ $pedidos->cotizacion->clientee->email }}<br>
                            <strong>Carnet: </strong>{{ $pedidos->cotizacion->clientee->ci }}<br>
                        </address>
                    @endif
                </div>
                <!-- /.col -->
                <div class="col">
                    <h2 class="text-info">N° Pedido: {{ $pedidos->number }}</h2><br>

                    <b>Fecha Pedido: </b> {{ $pedidos->date }}<br><br>
                    <b>N° Cotización: </b>{{ $pedidos->cotizacion->number }}<br>
                    <address>
                        <strong>Razon Social: </strong>{{ $pedidos->cotizacion->clientee->job->nit }}<br>
                        <strong>NIT: </strong>{{ $pedidos->cotizacion->clientee->job->nit }} <br>
                    </address>
                </div>
                <!-- /.col -->
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped text-uppercase">
                    <thead class="table-info">
                        <tr class="bg-info">
                            <th scope="col" class="text-center">N°</th>
                            <th scope="col" class="text-center">Codigo Producto</th>
                            <th scope="col" class="text-center">Producto</th>
                            <th scope="col" class="text-center">Precio Unidad</th>
                            <th scope="col" class="text-center">Cantidad</th>
                            <th scope="col" class="text-center">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedidoDetalle->products as $detalle)
                            <tr>
                                <td class="text-center">{{ $loop->index+1}}</td>
                                <td>{{ $detalle->code }}</td>
                                <td>{{ $detalle->name }}</td>
                                <td class="text-center">{{ $detalle->pivot->UnitPrice }}</td>
                                <td class="text-center">{{ $detalle->pivot->amount }}</td>
                                <td class="text-center">{{ $detalle->pivot->UnitPrice * $detalle->pivot->amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <th >Subtotal:</th>
                            <td>{{ $pedidos->totalprice }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <th style="width:50%">Total:</th>
                            <td>{{ $pedidos->totalprice }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted">
            <a href="{{ route('orders.index') }}" class="btn btn-primary bg-info"
                style="margin-top: 2em; border: 0;">Volver</a>
        </div>
    </div>

@stop

@section('js')

@stop
