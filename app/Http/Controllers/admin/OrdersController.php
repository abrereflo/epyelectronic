<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Order;
use App\Models\admin\Client;
use App\Models\admin\ProductFamily;
use App\Models\admin\ProductType;
use App\Models\admin\Product;
use App\Models\admin\Quotation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    public function index()
    {
        $pedidos = Order::paginate(10);
        return view('admin.pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $purchased_products = 0;
        $purchase_count = 0;
        $grand_total = 0;

        $code = Client::latest('code')->first();
        $ciudades = ['LA PAZ', 'EL ALTO', 'COCHABAMBA', 'SANTA CRUZ DE LA SIERRA', 'SUCRE', 'ORURO', 'TARIJA', 'TRINIDAD', 'POTOSÍ', 'PANDO'];
        $sum = $code->id + 1;
        $code_cli = 'CLI-' . $sum;
        $cotizaciones = Quotation::where('statu', 0)->get();
        $pedido  = Order::latest('id')->first();
        $productos   = Product::all();
        $nowday      = Carbon::now()->format('Y-m-d');

        if (empty($pedido)) {
            $number_order = 1;
            return view('admin.pedidos.create', compact('cotizaciones', 'code_cli', 'ciudades', "nowday", "productos", "number_order", 'purchased_products', 'purchase_count', 'grand_total'));
        }
        $number_order = $pedido->number + 1;
        return view('admin.pedidos.create', compact('cotizaciones', 'code_cli', 'ciudades', "nowday", "productos", "number_order", 'purchased_products', 'purchase_count', 'grand_total'));
    }
    public function store(Request $request)
    {

        $user_id = Auth::user()->name;
        $rules = [
            'cotizacion_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            dd($validator);
            return redirect('admin/pedido')
                ->withInput()
                ->withErrors($validator);
        }
        try {
            if ($request->get('fechapedido') >= now()->toDateString())

                $Order = new Order();
            foreach ($request->product_id as $key => $product) {
                $total[] =  $request->total_amount[$key];
                $product_id = $request->product_id[$key];
                $product = Product::find($product_id);
                if (($product->stock>0) && ($product->stock>=$request->quantity[$key])) {
                    $results[] = array(
                        "products_id" => $request->product_id[$key],
                        "amount" => $request->quantity[$key],
                        "UnitPrice" => $request->purchase_price[$key]
                    );
                    $stock = $product->stock - $request->quantity[$key];
                    $product->stock = $stock;
                    $product->save();
                }
            }

            $cotizacion_id = $request->get('cotizacion_id');
            $cotizacione = Quotation::find($cotizacion_id);

            $total_sum = array_sum($total);
            $Order->quotations_id  = $cotizacion_id;
            $Order->date = $request->get('fechapedido');
            $Order->number = $request->get('numero_pedido');
            $Order->totalprice = $total_sum;
            $Order->save();
            $Order->products()->attach($results);
            $cotizacione->statu = true;
            $cotizacione->save();

            return $this->show($Order->id)->with('statu', 'Se registro corectamente');
        } catch (Exception $e) {

            return redirect('admin/pedido')->with('failed', 'Operacion Fallada');
        }
    }
    public function show($id)
    {
        $fechaHoy =  Carbon::now()->format('Y-m-d');
        $pedidos = Order::find($id);
        $pedidoDetalle =  Order::with('products')->find($id);

        return  view('admin.pedidos.show', compact('pedidos', 'pedidoDetalle', 'fechaHoy'));
    }
    public function destroy($id)
    {
        $pedidos = Order::find($id);
        if ($pedidos->statu == 'pendiente') {
            $cotizacion_id = $pedidos->quotations_id;
            $pedidos->products()->detach();
            $pedidos->delete();
            $cotizacione = Quotation::find($cotizacion_id);
            $cotizacione->statu = false;
            $cotizacione->save();
            return redirect('admin/cotizacion')->with('success', 'Tipo de Producto fue Eliminado');
        }

        return redirect('admin/cotizacion')->with('success', 'Tipo de Producto no fue Eliminado');
    }

    public function UpdateStatusCotizacion(Request $request)
    {
        $estadoUpdate = Order::findOrFail($request->id);
        $estadoUpdate->statu = $request->statu;
        $estadoUpdate->update();
        if ($request->statu == 0) {
            $newStatus = '<p class="text-danger">Anulado</p>';
        } else {
            $newStatus = ' <p class="text-success">Habilitado</p> ';
        }

        return response()->json(['var' => '' . $newStatus . '']);
    }

    public function buscar(Request $request)
    {
        dd($request);

        $estados = $request->statu;
        $buscar = $request->buscar;
        $parametros = $request->parametros;
        $cotizacion = Order::all();

        if ($estados ==  1) {

            $cotizacion = Order::query()->where($parametros, 'LIKE', "%{$buscar}%")->get();
            return view('admin.productos.index', compact('cotizacion'))->with('familiaproductos', $cotizacion)
                ->with('estado', $estados);
        }
    }

    public function bclient(Request $request)
    {

        $client = $request->get('client');
        $querys = Client::where('name', 'like', '%' . $client . '%')->orWhere('lastname', 'like', '%' . $client . '%')->get();
        $data = [];
        foreach ($querys as $query) {
            $data[] = [
                'label' => $query->name,
                'lastname' => $query->lastname,
                'ci' => $query->ci,
                'ci' => $query->id,
            ];
        }
        return $data;
    }

    public function detalle(Request $request)
    {

        $id = $request->get("id");
        $cotizacion = Quotation::find($id);

    /*  0 => "clients_id"
        1 => "date"
        2 => "number"
        3 => "totalprice"
        4 => "statu " */
        $data[] =   [
            'id' => $cotizacion->id,
            'number' => $cotizacion->number,
            'totalprice' => $cotizacion->totalprice,
            'code' => $cotizacion->clientee->code,
            'name' => $cotizacion->clientee->name,
            'lastname' => $cotizacion->clientee->lastname,
            'ci' => $cotizacion->clientee->ci,
            'nit' => $cotizacion->clientee->job->nit,
            'business_name' => $cotizacion->clientee->job->business_name,
            'phone' => $cotizacion->clientee->phone,
            'city' => $cotizacion->clientee->city,
            'address' => $cotizacion->clientee->address,
            'email' => $cotizacion->clientee->email,
        ];

        foreach ($cotizacion->producto as $key => $value) {
            $id = $value->pivot->product_id;
            $product = product::find($id);
            $dato[] = [
                'product_id' => $value->pivot->product_id,
                'name' => $value->name,
                'stock' => $product->stock,
                'amount' => $value->pivot->amount,
                'UnitPrice' => $value->pivot->UnitPrice,
            ];
        }

        return response()->json([
            'data' => $data,
            'dato' => $dato
        ]);
    }

    public function reporte()
    {
        return view('admin.reportes.cotizacionespedido');
    }
}
