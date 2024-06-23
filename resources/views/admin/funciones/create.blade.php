@extends('adminlte::page')

@section('title', 'Funciones')

@section('content_header')
    <h1>Nuevo Registro</h1>
@stop

@section('content')
    <div class="card">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Funciones</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('funcion.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="card-body">
                        <div class="form-group col-3">
                            <label for="name">Nombre de función <span class="">*</span></label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        @foreach ($permissions as $permission)
                        <div class="form-check">
                            <input class="form-check-input" name="permission[]" type="checkbox" value="{{ $permission->id}}">
                            <label class="form-check-label">{{ $permission->name}}</label>
                          </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-secondary">Enviar</button>
                    <a href="{{ route('funcion.index')}}" class="btn btn-outline-secondary">Volver</a>
                </div>
            </form>
        </div>
    </div>
@stop
@section('css')
@stop

@section('js')
@stop
