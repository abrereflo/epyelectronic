@extends('adminlte::page')

@section('title', 'EPY Electronica')

@section('content_header')
    <div class="callout callout-info">
        <h4 class="text-info text-uppercase">Editar Proveedor</h4>
    </div>
@stop

@section('content')
    <form action="{{ route('proveedor.update', $proveedor->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                <h4 class="text-info text-uppercase">Proveedor</h4>
            </div>
            <div class="card-body">
                <div class="contend">
                    <div class="row">
                        <div class="col">
                            <div class="form-group text-uppercase">
                                <label for="name">Nombre <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control text-uppercase" name="name" id="name" placeholder="Nombres" value="{{ $proveedor->name }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group text-uppercase">
                                <label for="last_name">Apellido <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control text-uppercase" name="last_name" id="last_name"  placeholder="Apellidos" value="{{ $proveedor->last_name }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col">
                            <div class="form-group text-uppercase">
                                <label for="phone">Celular <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control text-uppercase" name="phone" id="phone"  placeholder="Celular" value="{{ $proveedor->phone }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group text-uppercase">
                                <label for="phone_company">Celular Corporativo<strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control text-uppercase" name="phone_company" id="phone_company"  placeholder="Celular Corporativo" value="{{ $proveedor->phone_company }}">
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col">
                            <div class="form-group text-uppercase">
                                <label for="direction">Dirección <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control text-uppercase" id="direction" name="direction"  placeholder="B/ Calle/ #..." value="{{ $proveedor->direction }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group text-uppercase">
                                <label for="email">Correo <strong class="text-danger">*</strong></label>
                                <input type="email" class="form-control text-uppercase" id="email" name="email"  placeholder="Correo Electronico" value="{{ $proveedor->email }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col">
                            <div class="form-group text-uppercase">
                                <label for="business_name">Razon Social</label>
                                <input type="text" class="form-control text-uppercase" name="business_name" id="business_name" placeholder="Nombre de la empresa" value="{{ $proveedor->business_name }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group text-uppercase">
                                <label for="nit">N° Documento o NIT <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control text-uppercase" name="nit" id="nit"  placeholder="Carnet de identidad" value="{{ $proveedor->nit }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group text-uppercase">
                                <label for="type_supplier">Tipo de proveedor</label>
                                <input type="text" class="form-control text-uppercase" name="type_supplier" id="type_supplier"  placeholder="Tipo de proveedor" value="{{ $proveedor->type_supplier }}">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">

                <a class="btn btn-danger text-uppercase" href="{{ route('proveedor.index') }}">Cancelar</a>
                <button type="submit" class="btn btn-info text-uppercase">Editar</button>
            </div>
        </div>

    </form>
@stop

@section('css')

@stop

@section('js')


@stop
