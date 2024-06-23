@extends('adminlte::page')

@section('title', 'EPY Electronica')

@section('content_header')
    <div class="callout callout-success text-uppercase">
        <h3>Proveedor</h3>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body row">
            <div class="col-4 text-center d-flex align-items-center justify-content-center">
                <div class="">
                    <h2>EPY<strong>ELECTRONICA</strong></h2>
                    <p class="lead mb-5"><br>
                    </p>
                </div>
            </div>
            <div class="col-8">
                <div class="callout callout-success text-uppercase">
                    <address>
                        <strong>Nombre Completo: </strong> {{ $proveedor->full_name }}<br>
                        <strong>N° Documento o NIT: </strong> {{ $proveedor->nit }}<br>
                        <strong>Ciudad: </strong> {{ $proveedor->ci }}<br>
                        <strong>Dirección: </strong> {{ $proveedor->direction }}<br>
                        <strong>Correo: </strong> {{ $proveedor->email }}<br>
                    </address>
                </div>
                <div class="callout callout-danger text-uppercase">
                    <address>
                        <strong>Razon Social: </strong> {{ $proveedor->business_name }}<br>
                        <strong>NIT: </strong>{{ $proveedor->nit }}<br>
                        <strong>Estado: </strong> @if($proveedor->status == 1) Habilitado @else DEsabilitado @endif <br>
                    </address>
                </div>
            </div>
            <div class="card-footer text-muted">
                <a class="btn btn-danger text-uppercase" href="{{ route('proveedor.index') }}">Volver</a>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop
@section('js')
    <script>
        $(document).ready(function() {
            toastr.options.timeOut = 10000;
            @if (Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif (Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @endif
        });
    </script>
@stop
