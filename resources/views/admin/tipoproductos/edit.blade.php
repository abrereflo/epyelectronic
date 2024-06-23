@extends('adminlte::page')

@section('title', 'EPY Electronica')

@section('content_header')
<div class="callout callout-info text-uppercase">
    <h5>Editar Tipo</h5>
  </div>
@stop

@section('content')

    <form action="{{ route('producttype.update', $tipoproductos->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card text-uppercase">
            <div class="card-header">
                <h4 class="text-info">Editar Tipo de Producto</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Tipo Producto <strong class="text-danger">*</strong> </label>
                    <input type="text" name="name" id="" value="{{ $tipoproductos->name }}"
                        class="form-control text-uppercase" placeholder="Tipo de producto">
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <textarea class="form-control text-uppercase" name="description" rows="3"> {{ old('description', $tipoproductos->description) }}</textarea>
                </div>
            </div>
            <div class="card-footer text-muted text-uppercase">
                <a class="btn btn-danger" href="{{ route('producttype.index') }}">Cancelar</a>
                <button type="submit" class="btn btn-info text-uppercase">Registrar</button>
            </div>
        </div>

    </form>
@stop

@section('css')

@stop

@section('js')


@stop
