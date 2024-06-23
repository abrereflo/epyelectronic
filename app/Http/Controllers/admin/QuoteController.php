<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Quotation;
use Illuminate\Http\Request;
use App\Models\admin\Client;
use App\Models\admin\Jobs;
use App\Models\admin\ProductFamily;
use App\Models\admin\ProductType;
use App\Models\admin\Product;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\Validator;

class QuoteController extends Controller
{
    public function index()
    {
        $cotizaciones = Quotation::orderBy('id','desc')->paginate(10);
        return view('admin.cotizaciones.index', compact('cotizaciones'));
    }


    public function create()
    {
        $purchased_products = 0;
        $purchase_count= 0;
        $grand_total = 0;

        $code = Client::latest('id')->first();

        $ciudades = ['LA PAZ', 'EL ALTO', 'COCHABAMBA', 'SANTA CRUZ DE LA SIERRA', 'SUCRE', 'ORURO', 'TARIJA', 'TRINIDAD', 'POTOSÍ', 'PANDO'];
        if(empty($code->id))
        {
            $code_cli = 'CLI-1';
        }
        else
        {
            $sum = $code->id + 1;
            $code_cli = 'CLI-' . $sum;
        }

        $cotizacion  = Quotation::latest('id')->first();
        $nowday      = Carbon::now()->format('Y-m-d');
        $productos = Product::where('statu', 1)->get();

        if (empty($cotizacion)) {
            $number_quote = 1;
            return view('admin.cotizaciones.create', compact("nowday", "number_quote", "productos",'purchased_products','purchase_count','grand_total', 'code_cli','ciudades'));
        }
        $number_quote = $cotizacion->number + 1;
        return view('admin.cotizaciones.create', compact("nowday", "number_quote", "productos",'purchased_products','purchase_count','grand_total', 'code_cli','ciudades'));
    }
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $rules = [
            'client_id' => 'required',
            'total_amount' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            dd($validator);
            return redirect('admin/cotizacion')
                ->withInput()
                ->withErrors($validator);
        }
        try {
            $data = $request->input();
            $quotation = new Quotation();

            foreach ($request->product_id as $key => $product) {
                $total[] =  $request->total_amount[$key];
                $results[] = array(
                    "product_id" => $request->product_id[$key],
                    "amount" => $request->quantity[$key],
                    "UnitPrice" => $request->purchase_price[$key]
                );
            }

            $total_sum = array_sum($total);
            $quotation->users_id = $user_id;
            $quotation->clients_id = $data['client_id'];
            $quotation->date = $data['fechaCotizacion'];
            $quotation->number =$data['numeroCotizacion'];
            $quotation->totalprice = $total_sum;
            $quotation->save();
            /* dd($results); */
            $quotation->producto()->attach($results);

            return $this->show($quotation->id)->with('statu', 'Se registro corectamente');
        } catch (Exception $e) {
            return redirect('admin/cotizacion')->with('failed', 'Operacion Fallada');
        }
    }
    public function show($id)
    {
        $fechaHoy =  Carbon::now()->format('Y-m-d');
        $cotizaciones = Quotation::find($id);
        $cotizacioneDetalle =  Quotation::with('producto')->find($id);

        return  view('admin.cotizaciones.show', compact('cotizaciones', 'cotizacioneDetalle', 'fechaHoy'));
    }
    public function print($id)
    {
        $fechaHoy =  Carbon::now()->format('Y-m-d');
        $cotizaciones = Quotation::find($id);
        $cotizacioneDetalle =  Quotation::with('producto')->find($id);

        return  view('admin.cotizaciones.imprimir', compact('cotizaciones', 'cotizacioneDetalle', 'fechaHoy'));
    }

    public function destroy($id)
    {
        $cotizaciones = Quotation::find($id);

        if ($cotizaciones->statu == 1) {
            $cotizaciones->delete();
            return redirect('admin/cotizacion')->with('success', 'Tipo de Producto fue Eliminado');
        }

        return redirect('admin/cotizacion')->with('success', 'Tipo de Producto no fue Eliminado');
    }

    public function UpdateStatusCotizacion(Request $request)
    {
        $estadoUpdate = Quotation::findOrFail($request->id);
        $estadoUpdate->statu = $request->statu;
        $estadoUpdate->update();
        if ($request->statu == 0) {
            $newStatus = '<p class="text-danger">Pendiente</p>';
        } else {
            $newStatus = ' <p class="text-success">Realizado</p> ';
        }

        return response()->json(['var' => '' . $newStatus . '']);
    }

    public function buscar(Request $request)
    {
        dd($request);

        $estados = $request->statu;
        $buscar = $request->buscar;
        $parametros = $request->parametros;
        $cotizacion = Quotation::all();
        if ($estados ==  1) {
            $cotizacion = Quotation::query()->where($parametros, 'LIKE', "%{$buscar}%")->get();
            return view('admin.productos.index', compact('cotizacion'))->with('familiaproductos', $cotizacion)
                ->with('estado', $estados);
        }
    }

    public function buscar_client(Request $request)
    {
        $search = $request->search;

        $clientes = Client::where('ci', $search)->orWhere('code', $search)->get();
       /*  if(empty($clientes))
            $clientes = Jobs::join("clients","jobs.jobable_id","=","clients.id ")->where('nit', $search)->get();
        */
        $datos = [];
        if (!empty($clientes)) {
            foreach ($clientes as $cliente) {
                $datos[] = [
                    'id' => $cliente->id,
                    'code' => $cliente->code,
                    'name' => $cliente->name,
                    'lastname' => $cliente->lastname,
                    'phone' => $cliente->phone,
                    'city' => $cliente->city,
                    'address' => $cliente->address,
                    'business_name' =>$cliente->job->business_name,
                    'nit' => $cliente->job->nit,
                    'ci' => $cliente->ci,
                    'email' => $cliente->email
                ];
            }

            /* dd($datos); */
            return $datos;
        }
        return $datos;
    }

    public function buscar_product(Request $request)
    {
        $buscar = $request->search_prod;
        $parametro = $request->parametro;
        if ($parametro == 'code') {
            $productos = Product::where('code', 'like', '%' . $buscar . '%')->get();
            foreach ($productos as $product) {
                $productss[] = [
                    'id'   =>  $product->id,
                    'code' =>  $product->code,
                    'name' =>  $product->name,
                    'stock' => $product->stock,
                    'price' => $product->salePrice
                ];
            }
            return $productss;
        }
        if ($parametro == 'name') {
            $productos = Product::where('name', 'like', '%' . $buscar . '%')->get();
            foreach ($productos as $product) {
                $productss[] = [
                    'id'   =>  $product->id,
                    'code' =>  $product->code,
                    'name' =>  $product->name,
                    'stock' => $product->stock,
                    'price' => $product->salePrice
                ];
            }
            return $productss;
        }
        if ($parametro == 'family') {
            $productos = Product::join('product_families', 'product_families.id', '=', 'products.product_families_id')
                ->where('product_families.name', 'like', '%' . $buscar . '%')
                ->get(['products.*']);
            foreach ($productos as $product) {
                $productss[] = [
                    'id'   =>  $product->id,
                    'code' =>  $product->code,
                    'name' =>  $product->name,
                    'stock' => $product->stock,
                    'price' => $product->salePrice
                ];
            }
            return $productss;
        }
        if ($parametro == 'type') {

            $productos = Product::join('product_families', 'product_families.id', '=', 'products.product_families_id')
                ->join('product_types', 'product_types.id', '=', 'product_families.product_types_id')
                ->where('product_types.name', 'like', '%'. $buscar.'%')
                ->get(['products.*']);
            foreach ($productos as $product) {
                $productss[] = [
                    'id'   =>  $product->id,
                    'code' =>  $product->code,
                    'name' =>  $product->name,
                    'stock' => $product->stock,
                    'price' => $product->salePrice
                ];
            }
            return $productss;
        }

    }

    public function gettable(Request $request)
    {
        $id = $request->get("id");
        $Purchase = Product::where('id', $id)
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get();
        return $Purchase;
    }
    public function familia()
    {
    }
}
