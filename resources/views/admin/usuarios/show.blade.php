@extends('adminlte::page')

@section('title', 'Usuario')

@section('content_header')
<div class="callout callout-info text-info text-uppercase">
    <h4>Usuario</h4>
</div>
@stop

@section('content')
    <div>
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <p class="h5">Nombre:</p>
                <p class="form-control">{{ $user->name }}</p>
                <p class="h5">Correo:</p>
                <p class="form-control">{{ $user->email }}</p>
                <h2 class="h5">Listado de Roles</h2>
                @foreach ($user->roles as $role)
                    <label class="col-form-label text-uppercase" for="inputSuccess"><i class="fas fa-check"></i> {{ $role->name }} </label>
                @endforeach
                <br>
                <a href="{{ route('usuario.index') }}" class="btn btn-primary text-uppercase">Volver</a>
            </div>
            <div class="card-footer text-muted">

            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
