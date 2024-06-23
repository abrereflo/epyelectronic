@extends('adminlte::page')

@section('title', 'EPY Electronica')

@section('content_header')
    <div class="callout callout-info text-uppercase ">
        <h4>Marca De Productos</h4>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body text-uppercase">
            <h4><strong>Detalle</strong></h4>
            <div class="callout callout-info text-uppercase">
                <h5>Nombre de Familia</h5>
                <p>{{ $familiaproductos->name }}</p>
                <h5>Descripción</h5>
                <h6>{{ $familiaproductos->description }}</h6>
                <h5>Estado</h5>
                @if ($familiaproductos->statu == 1)
                    <h6 class="text-muted f-w-400">Habilitado</h6>
                @else
                    <h6 class="text-muted f-w-400">Desabilitado</h6>
                @endif
            </div>
        </div>
        <div class="card-footer text-muted text-uppercase">
           <a href="{{ route('productfamily.index')}}" class="btn btn-danger">Volver</a>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
