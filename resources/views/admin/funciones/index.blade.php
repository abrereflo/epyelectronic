@extends('adminlte::page')

@section('title', 'Funciones')

@section('content_header')
<div class="callout callout-info text-info text-uppercase">
    <h4>Lista Roles</h4>
</div>
@stop

@section('content')
<div>
    <div class="card">
        <div class="card-header">
            <a href="{{ route('funcion.create') }}" class="btn btn-info text-uppercase">Nuevo Función</a>
        </div>
        <div class="card-body">
            {{$roles->links()}}
            <table class="table text-uppercase">
                <thead class="table-info">
                    <tr>
                        <th>N°</th>
                        <th>Funciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $rol)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $rol->name }}</td>
                            <td>
                                <a href="{{ route('funcion.show', $rol)}}" class="btn btn-outline-primary"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('funcion.edit', $rol) }}" class="btn btn-outline-info"><i class="fas fa-edit "></i></a>
                                 <div class="btn-group">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-outline-danger text-danger" data-toggle="modal"
                                            data-target="#eliminarModal{{$rol->id}}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="eliminarModal{{$rol->id}}" tabindex="-1" role="dialog"
                                            aria-labelledby="eliminarModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="eliminarModalLabel">El numero de orden de trabajo:
                                                            {{ $rol->name }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Esta seguro de eliminar</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('funcion.delete', $rol->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">

        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop
