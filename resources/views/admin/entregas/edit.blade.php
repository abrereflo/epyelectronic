@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="callout callout-info text-info text-uppercase">
    <h4>Editar Entrega</h4>
</div>
@stop

@section('content')
    <form action="{{ route('entregas.update', $entrega->id ) }}" method="post">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                <div class="row invoice-info">
                    <div id="client" class="col invoice-col text-uppercase">
                        <div>
                            Cliente
                            <address>
                                <strong>Nombre: </strong>{{ $entrega->pedidos->cotizacion->clientee->name }} <br>
                                <strong>Celular: </strong> (+591) {{ $entrega->pedidos->cotizacion->clientee->phone }} <br>
                                <strong>Correo: </strong> {{ $entrega->pedidos->cotizacion->clientee->email }}
                            </address>
                        </div>
                        <!-- /.col -->
                        <div>
                            Empresa
                            <address>
                                <strong>Razon Social: </strong> {{ $entrega->pedidos->cotizacion->clientee->job->business_name }} <br>
                                <strong>NIT: </strong> {{ $entrega->pedidos->cotizacion->clientee->job->nit }}<br>
                            </address>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col text-uppercase">
                        <b>Entraga # {{ $entrega->number }}
                        <input type="hidden" name="number" value="{{ $entrega->number }}">
                        <input type="hidden" name="orders_id" value="{{ $entrega->orders_id }}">
                        </b><br>
                        <br>
                        <b>Fecha:</b> {{ $entrega->date }}
                        <input type="hidden" name="date" value="{{ $entrega->date }}"><br>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row text-uppercase">
                    <div class="col-8 form-group">
                        <label>dirección de entrega: </label>
                        <input type="text" class="form-control" name="direction" value="{{ $entrega->direction  }}" placeholder="Dirección...">
                    </div>

                    <div class="col-4 form-group">
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <label>Hora:</label>
                                <div class="input-group date" id="timepicker" data-target-input="nearest">
                                    <input type="text" name="hour" class="form-control datetimepicker-input"
                                        data-target="#timepicker" value="{{ $hours  }}"/>
                                    <div class="input-group-append" data-target="#timepicker"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->
                        </div>
                    </div>

                </div>
                <div class="text-uppercase">
                    <div class="form-group">
                        <label>Referencia o observacion: </label>
                        <textarea class="form-control" rows="3" name="reference" placeholder="Enter ...">{{ $entrega->reference }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0 text-uppercase">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Nombre Producto</th>
                            <th>Numero de serial</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($entrega->pedidos->products as $detalle)
                        <tr>
                            <td>{{ $detalle->name }}
                                <input type="hidden" name="products_id[]" value="{{ $detalle->pivot->products_id }}">
                            </td>

                            <td>
                                @foreach ($entrega->product as $detail )
                                    @if ($detalle->pivot->products_id == $detail->pivot->product_id )
                                        <input type="text" name="sn[]" id="sn" value="{{ $detail->pivot->serial_number }}" >
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-muted">
                <div class="btn-group">
                    <div class="col">
                        <a href="{{ route('entregas.index') }}" class="btn btn-primary bg-danger"
                            style="margin-top: 2em; border: 0;">Cancelar</a>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary bg-success"
                            style="margin-top: 2em; border: 0;">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

@section('css')

@stop

@section('js')
<script>
    $('#timepicker').datetimepicker({
        format: 'HH:mm',
    })
</script>
@stop
