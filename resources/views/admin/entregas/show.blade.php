@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="callout callout-info">
        <h4 class="text-info">
            <img src="{{ url('http://127.0.0.1:8000/vendor/adminlte/dist/img/logofinal.png') }}"
                class="brand-image img-circle elevation-3" style="opacity:.8;" height="40" width="40"> EPY ELectronica
            <small class="float-right">Fecha: {{ $entrega->date }}</small>
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
                        <strong>{{ $entrega->pedidos->cotizacion->clientee->codigoCliente }} </strong><br>
                        <strong>Nombre: </strong>{{ $entrega->pedidos->cotizacion->clientee->name }}
                        {{ $entrega->pedidos->cotizacion->clientee->lastname }} <br>
                        <strong>Celular: </strong>{{ $entrega->pedidos->cotizacion->clientee->phone }} <br>
                        <strong>Correo: </strong>{{ $entrega->pedidos->cotizacion->clientee->email }}<br>
                        <strong>Carnet: </strong>{{ $entrega->pedidos->cotizacion->clientee->ci }}<br>
                        <strong>Dirección de entrega: </strong>{{ $entrega->direction }}<br>
                        <strong>Hora de entrega: </strong>{{ $entrega->hour }}<br>
                        <strong>Referencia o Observación: </strong>{{ $entrega->reference }}<br>
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
                            <th scope="col" class="text-center">N° Serie</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($entrega->product as $detail)
                            <tr>
                                <td class="text-center">{{ $loop->index+1}}</td>
                                <td class="text-center">{{ $detail->name}}</td>
                                <td class="text-center">{{ $detail->pivot->serial_number}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted">
            <a href="{{ route('entregas.index')}}" class="btn btn-danger">Volver</a>
        </div>
    </div>


@stop

@section('css')

@stop

@section('js')

@stop
