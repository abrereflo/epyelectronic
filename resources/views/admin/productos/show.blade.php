@extends('adminlte::page')

@section('title', 'EPY Electronica')

@section('content_header')
    <div class="callout callout-info text-uppercase">
        <h5 class="text-info"><strong>Producto</strong></h5>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="text-uppercase"><strong>Detalle</strong> </h4>
            <div class="callout callout-info text-uppercase">
                <h5><strong>Codigo De Producto</strong></h5>
                <p>{{ $producto->code }}</p>
                <h5><strong>Tipo De Producto</strong></h5>
                <p>{{ $producto->productfamily->productstype->name }}</p>
                <h5><strong>Familia De Producto</strong></h5>
                <p>{{ $producto->productfamily->name }}</p>
                <h5><strong>Nombre De Producto</strong></h5>
                <p>{{ $producto->name }}</p>
                <img src="{{ Storage::url($producto->image) }}" height="150" width="150"
                alt="" />

                <h5><strong>Descripción</strong></h5>
                <p>{{ $producto->description }}</p>
            </div>

            <div class="callout callout-warning text-uppercase">
                <h5><strong>Precio Venta</strong></h5>
                <p>{{ $producto->salePrice }}</p>
                <h5><strong>Precio Facturado</strong></h5>
                <p>{{ $producto->invoicePrice }}</p>
                <h5><strong>Cantidad Total</strong></h5>
                <p>{{ $producto->stock }}</p>
            </div>
            <div class="callout callout-success text-uppercase">
                <h5><strong>Estado</strong></h5>
                @if ($producto->statu == 1)
                    <p class="text-muted f-w-400">Habilitado</p>
                @else
                    <p class="text-muted f-w-400">Desabilitado</p>
                @endif
            </div>

        </div>
        <div class="card-footer text-muted">
            <a href="{{ route('product.index') }}" class="btn btn-danger text-uppercase">Volver</a>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
