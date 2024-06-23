@extends('adminlte::page')

@section('title', 'Usuario')

@section('content_header')
<div class="callout callout-info text-info text-uppercase">
    <h4>Nuevo Usuario</h4>
</div>
@stop

@section('content')
    <div class="card card-info text-uppercase">
        <div class="card-header">
            <h3 class="card-title">Usuario</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <div class="card-body text-uppercase">
            <form action="{{ route('usuario.store') }}" method="POST">
                @csrf
                    <div class="form-group">
                        <label for="mane">Nombre</label>
                        <input type="text" class="form-control" name="name" id="mane" placeholder="Nombre Completo...">
                    </div>
                    <div class="form-group">
                        <label for="email">Correo</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Correo">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="text" class="form-control" name="password" id="password" placeholder="Contraseña">
                    </div>
                    <div class="form-group">
                        <label for="" class="h5">Lista de Roles</label> <br>
                        @foreach ($roles as $role)
                            @if ($role->name != 'super_admin')
                            <label><input type="checkbox" value="{{ $role->id }}" name="roles[]"
                                class="mr-1">{{ $role->name }}</label> <br>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{route('usuario.index')}}" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-info text-uppercase">Enviar</button>
                </div>
            </form>
    @stop

    @section('css')

    @stop

    @section('js')

    @stop
