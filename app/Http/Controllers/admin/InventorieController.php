<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Product;
use App\Models\admin\Inventories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class InventorieController extends Controller
{
    public function index()
    {
        $inventarios = Inventories::paginate(10);
        return view('admin.inventario.index', compact('inventarios'));
    }

    public function inventario()
    {
        $inventarios = Inventories::paginate(10);
        return view('admin.inventario.inventario', compact('inventarios'));
    }

    public function create()
    {
        $purchased_products = 0;
        $purchase_count= 0;
        $grand_total = 0;

        $productos = Product::paginate(6);
        return view('admin.inventario.create', compact('productos','grand_total','purchase_count','purchased_products'));
    }

    public function list_product($id)
    {
        $producto = Product::find($id);
        $date1 = Carbon::now();
        $date = $date1->format('Y-m-d');

        $data[] = [
            'id' => $producto->id,
            'code' => $producto->code,
            'name' => $producto->name,
            'date' => $date,
        ];
        return $data;
    }

    public function store(Request $request)
    {
        $rules = [
            'proveedor_id' => 'required',
            'numero' => 'required',
            'date' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('admin/inventario')
                ->withInput()
                ->withErrors($validator);
        } else {
            $data = $request->input();
         /*    dd($request->input()); */
            try {
                $id_user = Auth::user()->id;
                $invetario = new Inventories();
                $invetario->user_id = $id_user;
                $invetario->provider_id = $data['proveedor_id'];
                $invetario->nit = $data['numero'];
                $invetario->fecha = $data['date'];
                $invetario->total = $data['total'];

                foreach ($request->product_id as $key => $product) {
                    $results[] = array(
                        "product_id" => $request->product_id[$key],
                        "price" => $request->total_amount[$key],
                        "quantity" => $request->quantity[$key],
                        "total_amount" => $request->purchase_price[$key]
                    );

                    $stock = Product::find($request->product_id[$key]);
                    $stock->stock = $stock->stock + $request->quantity[$key];
                    $stock->update();
                }

                $invetario->save();
                $invetario->producto()->attach($results);

                $notification =  'Se registro corectamente';
                return  redirect('admin/inventario')->with(compact('notification'));
            } catch (Exception $e) {
                $notification =  'Operacion Fallada';
                return redirect('admin/inventario')->with(compact('notification'));
            }
        }
    }

    public function buscar(Request $request)
    {
       /*  dd($request); */
        $estados = $request->status;
        $buscar = $request->buscar;
        $parametros = $request->parametros;

        if ($estados ==  'habilitado') {
            if($parametros == 'serial_number')
            {
                $inventarios =  Inventories::query()
                ->where('status', 'LIKE', "%{$estados}%")
                ->where($parametros, 'LIKE', "%{$buscar}%")
                ->paginate(10);
            /*     $inventarios->appends(['search' => $buscar]); */
                return view('admin.inventario.index', compact('inventarios', 'buscar'));
            }
            else
            {
                $inventarios = Inventories::join('products', 'products.id', '=', 'inventories.product_id')
                                            ->where('products.name', 'LIKE', "%{$buscar}%")
                                            ->where('inventories.status', 'LIKE', "%{$estados}%")
                                            ->paginate(10);

                  /*   dd($inventarios); */
               return view('admin.inventario.index', compact('inventarios', 'buscar'));
            }

        } else if ($estados == 'delivered') {
            if($parametros == 'serial_number')
            {
            $inventarios =  Inventories::query()
                ->where('status', 'LIKE', "%{$estados}%")
                ->where($parametros, 'LIKE', "%{$buscar}%")
                ->paginate(10);

                $inventarios->appends(['search' => $buscar]);
                return view('admin.inventario.index', compact('inventarios', 'buscar'));
            }
            else
            {
                $inventarios = Inventories::join('products', 'products.id', '=', 'inventories.product_id')
                                            ->where('products.name', 'LIKE', "%{$buscar}%")
                                            ->paginate(10);

                  /*   dd($inventarios); */
               return view('admin.inventario.index', compact('inventarios', 'buscar'));
            }

        }

        $inventarios = Inventories::orderBy('id', 'desc')->paginate(10);
        return view('admin.inventario.index', compact('inventarios'));

    }

    public function edit($id)
    {
        $inventario = Inventories::find($id);
        foreach ($inventario->producto as $key => $value) {
            $total = ['id' => $value->pivot->product_id];
            $cant =  $value->pivot->sum('quantity');
        }
        $purchase_count =  $total;
        $purchased_products = $cant;
        $grand_total =  $inventario->total;
        $purchase_date = $inventario->fecha;

        $productos = Product::paginate(4);
        return view('admin.inventario.edit', compact('inventario','productos', 'purchased_products', 'purchase_count','grand_total'));
    }

    /* public function show($id)
    {
        $inventario = Inventories::find($id);
        $productos = Product::paginate(4);
        return view('admin.inventario.show', compact('inventario','productos'));
    } */

    public function UpdateStatusInventario(Request $request)
    {
        $estadoUpdate = Inventories::findOrFail($request->id);
        $estadoUpdate->status = $request->statu;
        $estadoUpdate->update();
        if ($request->statu == 'desabilitado') {
            $newStatus = '<p class="text-danger">Desabilitado</p>';
        } else {
            $newStatus = ' <p class="text-success">Habilitado</p> ';
        }

        return response()->json(['var' => '' . $newStatus . '']);
    }
    public function destroy($id)
    {
            $inventario = Inventories::findOrFail($id);
            if($inventario->status == 'habilitado')
            {
                $inventario->delete();
                $notification = 'El Producto fue Eliminado';
                return redirect('admin/inventario')->with(compact('notification'));
            }

            $notification = 'El Producto no puede ser Eliminado';
            return redirect('admin/inventario')->with(compact('notification'));

    }
}
