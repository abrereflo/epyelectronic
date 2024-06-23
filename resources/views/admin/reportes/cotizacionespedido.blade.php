@extends('adminlte::page')

@section('title', 'Reportes')

@section('content_header')
<div class="callout callout-info text-info text-uppercase">
    <h4>Reporte Cotizaciones y Pedidos</h4>
</div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Header
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <table class="table table-striped table-inverse table-responsive">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Cantidades</th>
                                <th>Total Bs</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td scope="row"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                    </table>

                </div>
                <div class="col"></div>
            </div>
        </div>
        <div class="card-footer text-muted">
            Footer
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
