<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Claims;
use App\Models\admin\Client;
use App\Models\admin\Deliveries;
use App\Models\admin\Product;
use App\Models\admin\Quotation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $clientes = Client::where('statu', 1)->get();
        $productos = Product::where('statu', 1)->get();
        $cotizaciones = Quotation::where('statu', 0)->get();
        $pedidos = Deliveries::where('statu', 0)->get();
        $reclamos = Claims::all();
        return view('admin.index', compact('clientes','pedidos','productos', 'cotizaciones','reclamos'));
    }
}
