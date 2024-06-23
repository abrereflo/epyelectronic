@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="callout callout-info">
        <h4 class="text-info">
            <img src="{{ url('http://127.0.0.1:8000/vendor/adminlte/dist/img/logofinal.png') }}"
                class="brand-image img-circle elevation-3" style="opacity:.8;" height="40" width="40"> EPY ELectronica
            <small class="float-right">Fecha: {{ $despacho->date }}</small>
        </h4>
    </div>
@stop

@section('content')

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
                <div class="col">
                    <h3 class="text-info">Datos de Cliente</h3>
                    <address>
                        <strong>{{ $despacho->pedidos->cotizacion->clientee->codigoCliente }} </strong><br>
                        <strong>Nombre: </strong>{{ $despacho->pedidos->cotizacion->clientee->name }}
                        {{ $despacho->pedidos->cotizacion->clientee->lastname }} <br>
                        <strong>Celular: </strong>{{ $despacho->pedidos->cotizacion->clientee->phone }} <br>
                        <strong>Correo: </strong>{{ $despacho->pedidos->cotizacion->clientee->email }}<br>
                        <strong>Carnet: </strong>{{ $despacho->pedidos->cotizacion->clientee->ci }}<br>
                        <strong>Dirección de despacho: </strong>{{ $despacho->direction }}<br>
                        <strong>Hora de despacho: </strong>{{ $despacho->hour }}<br>
                        <strong>Referencia o Observación: </strong>{{ $despacho->reference }}<br>
                    </address>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="conter-center">
                <table class="table table-striped text-uppercase">
                    <thead class="table-info">
                        <tr class="bg-info">
                            <th scope="col" class="text-center">N°</th>
                            <th scope="col" class="text-center">Nombre Producto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $despacho->pedidos->products as $detail)
                            <tr>
                                <td class="text-center">{{ $loop->index+1}}</td>
                                <td class="text-center">{{$detail->name}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted">
            <a href="{{ route('despachos.index')}}" class="btn btn-danger">Volver</a>
        </div>
    </div>


@stop

@section('css')

@stop

@section('js')

@stop
