<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Client;
use App\Models\admin\Deliveries;
use App\Models\admin\Dispatches;
use App\Models\admin\Order;
use App\Models\admin\Quotation;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function cotizaandpedido()
    {
        $cotizaciones = Quotation::paginate(10);
        $pedidos = Order::paginate(10);
        return view('admin.reportes.cotizacionespedido', compact('cotizaciones', 'pedidos'));
    }

    public function entreanddesp()
    {
        $entregas = Deliveries::paginate(10);
        $despachos = Dispatches::paginate(10);
        return view('admin.reportes.entregadespachos', compact('entregas', 'despachos'));
    }

    public function clients()
    {
        $clientes = Client::where('statu',1)->paginate(10);
        return view('admin.reportes.clientes', compact('clientes'));
    }

}
