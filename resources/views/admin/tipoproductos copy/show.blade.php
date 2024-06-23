@extends('adminlte::page')

@section('title', 'EPY Electronica')

@section('content_header')
    <div class="callout callout-info text-uppercase">
        <h5 class="">Tipo de Producto</h5>
    </div>
@stop
{{ $tipoproductos->name }}
@section('content')

    <div class="card">
        <div class="card-body">
            <div class="callout callout-info text-uppercase">
                <h5><strong>Detalle</strong></h5>
                <h4 class="card-title">Nombre Tipo de producto</h4>
                <p class="card-text">{{ $tipoproductos->name }}</p>
                <h4 class="card-title">Descripción Tipo de producto</h4>
                <p class="card-text">{{ $tipoproductos->description }}</p>
            </div>
        </div>
        <div class="card-footer text-muted text-uppercase">
            <a href="{{ route('producttype.index') }}" class="btn btn-danger ">Volver</a>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
