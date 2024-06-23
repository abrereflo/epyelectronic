@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="callout callout-info  text-uppercase">
        <h5 class="text-info">Inventario</h5>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col">
            <form action="{{ route('garantias.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header text-uppercase">
                        <h4 class="text-info">Iditar Registro</h4>
                    </div>
                    <div class="card-body">
                        <div class="callout callout-info">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Inicia Garantia:</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" name="date_start" value="{{$garantia->date_start}}"
                                                class="form-control datetimepicker-input" data-target="#reservationdate">
                                            <div class="input-group-append" data-target="#reservationdate"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Termina Garantia :</label>
                                        <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                            <input type="text" name="date_end" value="{{$garantia->date_end}}"
                                            class="form-control datetimepicker-input"  data-target="#reservationdate1">
                                            <div class="input-group-append" data-target="#reservationdate1"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover" id="tab_logic">
                                    <thead>
                                        <tr>
                                            <th class="text-center"> Codigo </th>
                                            <th class="text-center"> Producto </th>
                                            <th class="text-center"> N° Serie </th>
                                        </tr>
                                    </thead>
                                    <tbody id="list">
                                        @foreach ($garantia->inventory as $details )
                                        <tr>
                                            <td>{{$details->producto->code}}</td>
                                            <td>{{$details->producto->name}}</td>
                                            <td>{{$details->serial_number}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-uppercase">
                        <a class="btn btn-danger" href="{{ route('inventories.index') }}">Cancelar</a>
                        <button type="submit" class="btn btn-info">Registrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop

@section('css')

@stop

@section('js')

@stop
