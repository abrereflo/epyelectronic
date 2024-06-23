@extends('adminlte::page')

@section('title', 'Usuario')

@section('content_header')
<div class="callout callout-info text-info text-uppercase">
    <h4>Listar Usuarios</h4>
</div>
@stop

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <a href="{{ route('usuario.create') }}" class="btn btn-info text-uppercase">Nuevo Usuario</a>
            </div>
            <div class="card-body">
                {{$users->links()}}
                <table class="table">
                    <thead class="table-info text-uppercase">
                        <tr>
                            <th>N°</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="text-uppercase">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('usuario.show', $user)}}" class="btn btn-outline-primary"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('usuario.edit', $user) }}" class="btn btn-outline-info"><i class="fas fa-edit "></i></a>


                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-outline-danger text-danger" data-toggle="modal"
                                                data-target="#eliminarModal{{$user->id}}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="eliminarModal{{$user->id}}" tabindex="-1" role="dialog"
                                                aria-labelledby="eliminarModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="eliminarModalLabel">El numero de orden de trabajo:
                                                                {{ $user->name }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Esta seguro de eliminar</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('usuario.delete', $user->id) }}"
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



                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-muted">
                Footer
            </div>
        </div>
    </div>

@stop

@section('css')

@stop

@section('js')

@stop
