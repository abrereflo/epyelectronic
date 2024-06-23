@extends('adminlte::page')

@section('title', 'Funciones')

@section('content_header')
    <h1>Muestras la función</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @if (session('statu'))
                <div class="alert alert-success" role="alert">
                    {{ session('statu') }}
                </div>
            @endif
        </div>
        <div class="card-body">
            <h1 class="card-title">Función</h1>
            <br>
            <div class="row">
                <div class="col-6">
                    <h3>
                        <i class="fa-solid fa-car-rear"></i> {{ $role->name }}
                    </h3>
                    <h3>
                      <strong>Los Permisos</strong>
                    </h3>
                </div>
                    @foreach ($role->permissions as $permiso )
                        {{$permiso->name}}<br>
                    @endforeach
            </div>
        </div>
        <div class="card-footer text-muted">
            <a href="{{ route('funcion.index')}}" class="btn btn-outline-secondary"> Volver</a>
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
