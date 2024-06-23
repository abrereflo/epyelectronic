@extends('adminlte::page')

@section('title', 'Usuario')

@section('content_header')
<div class="callout callout-info text-info text-uppercase">
    <h4>Editar Usuario</h4>
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

                <h2 class="h5">Listado de Roles</h2>

                <form action="{{ route('usuario.update', $user) }}" method="post">
                    @csrf
                    @method('PUT')
                        @foreach ($roles as $role)
                            <label><input type="checkbox" value="{{ $role->id }}" name="roles[]" class="mr-1"
                                    @if (in_array($role->id, $role_id )) checked @endif>{{ $role->name }}</label>
                        @endforeach
                    <br>
                    <a href="{{route('usuario.index')}}" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-primary">enviar</button>
                </form>
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
