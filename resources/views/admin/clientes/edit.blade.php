@extends('adminlte::page')

@section('title', 'EPY Electronica')

@section('content_header')
    <div class="callout callout-info">
        <h4 class="text-info text-uppercase">Editar Cliente</h4>
    </div>
@stop

@section('content')
    <form action="{{ route('client.update', $clientes->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                <h4 class="text-info text-uppercase">Cliente</h4>
            </div>
            <div class="card-body">
                <div class="contend">
                    <div class="row">
                        <div class="col">
                            <div class="form-group text-uppercase">
                                <label for="code">Codigo <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control text-uppercase" name="code" id="code"
                                    value="{{ $clientes->code }}" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group text-uppercase">
                                <label for="name">Nombre <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control text-uppercase" name="name" id="name"
                                    placeholder="Nombres" value="{{ $clientes->name }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group text-uppercase">
                                <label for="lastname">Apellido <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control text-uppercase" name="lastname" id="lastname"
                                    placeholder="Apellidos"  value="{{ $clientes->lastname }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group text-uppercase">
                                <label for="ci">N° Documento <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control text-uppercase" name="ci" id="ci"
                                    placeholder="Carnet de identidad"  value="{{ $clientes->ci }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group text-uppercase">
                                <label for="phone">Celular <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control text-uppercase" name="phone" id="phone"
                                    placeholder="Celular"  value="{{ $clientes->phone }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group text-uppercase">
                                <label for="city">Ciudad <strong class="text-danger">*</strong></label>
                                <select class="custom-select form-control-border border-width-2 text-uppercase"
                                    id="city" name="city">
                                    @foreach ($ciudades as $ciudade)
                                        <option value="{{ $ciudade }}" {{ ($clientes->city) == $ciudade ? 'selected' : '' }} >{{ $ciudade }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group text-uppercase">
                                <label for="address">Dirección <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control text-uppercase" id="address" name="address"
                                    placeholder="B/ Calle/ #..." value="{{ $clientes->address }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group text-uppercase">
                                <label for="email">Correo</label>
                                <input type="email" class="form-control text-uppercase" id="email" name="email"
                                    placeholder="Correo Electronico" value="{{ $clientes->email }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group text-uppercase">
                                <label for="business_name">Razon Social</label>
                                <input type="text" class="form-control text-uppercase" name="business_name"
                                    id="business_name" placeholder="Nombre de la empresa" value="{{ $clientes->job->business_name }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group text-uppercase">
                                <label for="nit">NIT</label>
                                <input type="text" class="form-control text-uppercase" name="nit" id="nit"
                                    placeholder="NIT/# documento" value="{{ $clientes->job->nit }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">

                <a class="btn btn-danger text-uppercase" href="{{ route('client.index') }}">Cancelar</a>
                <button type="submit" class="btn btn-info text-uppercase">Editar</button>
            </div>
        </div>

    </form>
@stop

@section('css')

@stop

@section('js')


@stop
