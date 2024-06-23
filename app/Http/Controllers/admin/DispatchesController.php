<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Dispatches;
use App\Models\admin\Order;
use Illuminate\Support\Facades\Validator;
use App\Models\admin\Inventories;
use Exception;
use Carbon\Carbon;

class DispatchesController extends Controller
{
   public function index()
   {
        $despachos = Dispatches::paginate(10);
        return view('admin.despachos.index', compact('despachos'));
   }

   public function create()
   {
        $pedidos =  Order::all();
        $despacho  =  Dispatches::latest('id')->first();
        $nowday  = Carbon::now()->format('Y-m-d');
        $transportes = ['Bus', 'Camion', 'Avion', 'Tren'];
        if (empty($envio)) {
            $number_de = 1;
            return view('admin.despachos.create' , compact('number_de','nowday', 'pedidos','transportes'));
        }
        $number_de = $despacho->number + 1;
        return view('admin.despachos.create' , compact('number_de','nowday', 'pedidos', 'transportes'));

    }

    public function show($id)
    {
        $despacho = Dispatches::find($id);
        return view('admin.despachos.show', compact('despacho'));
    }

    public function store(Request $request)
    {
       /*  "pedido_id" => "2"
        "number" => "1"
        "boucher" => "1541"
        "type_shipping" => "Bus"
        "company" => "1 men"
        "reference" => "rojo" */

      /*   dd( $request); */
        $envio  = Dispatches::latest('id')->first();
        $nowday = Carbon::now()->format('Y-m-d');

        $rules = [

        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {

            return redirect('admin/despachos')
                ->withInput()
                ->withErrors($validator);
        }
        try {

            $orders_id = $request->pedido_id;

            $despachos = new Dispatches();
            $despachos->orders_id = $request->pedido_id;
            $despachos->number = $request->number;
            $despachos->boucher = $request->boucher;
            $despachos->company = $request->company;
            $despachos->type_shipping  = $request->type_shipping;
            $despachos->date = $nowday;
            $despachos->reference =  $request->reference;
            $despachos->save();

            $pedido = Order::find($orders_id);
            $pedido->statu = 'despachado';
            $pedido->save();

            return $this->show($despachos->id)->with('statu', 'Se registro corectamente');
        } catch (Exception $e) {
            return redirect('admin/despachos')->with('failed', 'Operacion Fallada');
        }
    }

    public function reporte()
    {
        return view('admin.reportes.entregadespachos');
    }
}
