
@extends('adminlte::page')

@section('title', 'Funciones')

@section('content_header')
    <h1>Editar Registro</h1>
@stop

@section('content')
    <div class="card">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Función</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('funcion.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="card-body">
                        <div class="form-group col-3">
                            <label for="name">Nombre de Función <span class="">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $role->name }}">
                        </div>

                        @foreach ($permissions as $permission)
                        <label>
                            <input type="checkbox" value="{{ $permission->id }}" name="permission[]" class="mr-1" @if (in_array($permission->id, $permission_id )) checked @endif>
                                {{ $permission->name }}
                        </label> <br>
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
