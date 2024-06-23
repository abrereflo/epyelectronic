@extends('adminlte::page')

@section('title', 'Familia Productos')

@section('content_header')
    <div class="callout callout-info text-info text-uppercase">
        <h4> Marca de Productos</h4>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row text-uppercase">
                <div class="col">
                    <a class="btn btn-info" data-toggle="modal" data-target="#ModalCreate">Regsitrar Nuevo</a>
                </div>
                <form action={{ route('productfamily.buscar')}} method="post">
                    @csrf
                    <div class="col">
                        <div class="input-group input-group-sm">

                            <input name="buscar" type="text" class="form-control text-uppercase" placeholder="Buscar">
                            <select id="parametros" name="parametros"  class="custom-select">
                                <option value="name">NOMBRE</option>
                                <option value="product_types_id">TIPO PRODUCTO</option>
                            </select>
                            <select id="statu" name="statu" class="custom-select text-uppercase">
                                    <option value="1" >HABILITADO</option>
                                    <option value="0" >DESAVILITADO</option>
                            </select>
                            <span class="input-group-append ">
                                <button type="submit" class="fas fa-search btn-info"></button>
                                <a href="{{ route('productfamily.index')}}" class="btn btn-info"><i class="fas fa-sync"></i></a>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body text-uppercase">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('notification'))
                <div class="alert alert-success" role="alert">
                    {{ session('notification')}}
                </div>
             @endif
             <div class="row">
                <div class="col-sm-12 col-md-7">
                    {{ $familiaproductos->links() }}
                </div>
                <div class="col-sm-12 col-md-5 text-info">
                  Pagina {{$familiaproductos->currentPage()}}  Tiene  {{$familiaproductos->count()}} entradas, con un total de {{$familiaproductos->total()}}
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr class="bg-info">
                      <th scope="col">#</th>
                      <th scope="col">Marca</th>
                      <th scope="col">Descripción</th>
                      <th scope="col">Estado</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($familiaproductos as $familiaproducto )
                    <tr>
                      <th scope="row">{{$familiaproducto->id}}</th>
                        <td>{{$familiaproducto->name}}</td>
                        <td>{{$familiaproducto->description}}</td>
                        <td id="resp{{ $familiaproducto->id }}">
                            @if ($familiaproducto->statu == true)
                            <p class="text-success">Habilitado</p>
                            @else
                            <p class="text-danger">Desabilitado</p>
                            @endif
                        </td>
                      <td>
                          <a href="{{ route('productfamily.show', $familiaproducto)}}" class="btn btn-outline-primary"><i class="fas fa-eye"></i></a>
                          <a href="{{ route('productfamily.edit', $familiaproducto)}}" class="btn btn-outline-secondary"><i class="fas fa-edit"></i></a>

                              <div class="btn-group">
                                  <div class="col">
                                      <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                          <input id="{{ $familiaproducto->id }}" data-id="{{ $familiaproducto->id }}" class="custom-control-input" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $familiaproducto->statu ? 'checked' : '' }}>
                                          <label class="custom-control-label" for="{{ $familiaproducto->id }}"></label>
                                      </div>
                                  </div>


                              <form action="{{ route('productfamily.delete', $familiaproducto->id)}}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button id="Eliminar" type="submit" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                              </form>

                          </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
        </div>
        <div class="card-footer">

        </div>
    </div>


    @include('admin.familiaproducto.create')
@stop

@section('css')
@stop

@section('js')
<script>
    //para estados
    $('.custom-control-input').change(function() {
    //Verifico el estado del checkbox, si esta seleccionado sera igual a 1 de lo contrario sera igual a 0
        var statu = $(this).prop('checked') == true ? 1 : 0;
        var id = $(this).data('id');
            console.log(statu);
        $.ajax({
            type: "GET",
            dataType: "json",
            //url: '/StatusNoticia',
            url: '{{ route('UpdateStatusFamiliaProducto') }}',
            data: {'statu': statu, 'id': id },
            success: function(data){
                $('#resp' + id).html(data.var);
                console.log(data.var)
            }
        });
      })
</script>
@stop
