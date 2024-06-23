<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\ProductFamily;
use App\Models\admin\Product;
use App\Models\admin\ProductType;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Validator;
use Exception;
use PhpParser\Node\Expr\FuncCall;
class ProductController extends Controller
{
    public function index()
    {
       $productos = Product::paginate(10);
       $marcas = ProductFamily::all();
       $typeproductos  = ProductType::all();
       return view('admin.productos.index', compact('productos', 'typeproductos', 'marcas'));
    }

    public function list($id){
        $producto = Product::find($id, ['id', 'name']);
        return $producto;
    }

    public function store(Request $request)
    {

        /*  "product_types_id" => "1"
            "product_families_id" => "2"
            "code" => "amd-r33"
            "name" => "PROCESADORES"
            "price" => "850"
            "alert_quantity" => "5"
            "stock" => "0"
            "description" => "fdasedf" */
       $rules = [
            'product_types_id' => 'required',
            'product_families_id' => 'required',
            'code' => 'required|unique:products',
            'name' => 'required|unique:products',
            'image' => 'image|mimes:jpg,png,jpeg',
            'alert_quantity' => 'numeric',
            'Price' => 'numeric',
            'stock' => 'numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $notification =  'Operacion Fallada t';
			return redirect('admin/producto')->with(compact('notification'))
			->withInput()
			->withErrors($validator);
		}
        else
        {
        $data = $request->input();

          /*   "product_types_id" => "3"
            "product_families_id" => "2"
            "code" => "ryzen-75"
            "name" => "ryzen 7 5700g"
            "price" => "234"
            "alert_quantity" => "4"
            "stock" => "0"
            "description" => "erqwer" */
            try
            {
                $producto = new Product();
                $producto->product_types_id = $data['product_types_id'];
                $producto->product_families_id = $data['product_families_id'];
                $producto->code = $data['code'];
                $producto->price = $data['price'];
                $producto->alert_quantity = $data['alert_quantity'];
                $producto->name = $data['name'];
                $path = $request->file('image')->store('public/images');
                $producto->image = $path;
                $producto->description = $data['description'];
                $producto->date = Carbon::now();
                $producto->save();

                $notification =  'Se registro corectamente';
                return  redirect('admin/producto')->with(compact('notification'));
            }
            catch(Exception $e)
            {
                $notification =  'Operacion Fallada';
                return redirect('admin/producto')->with(compact('notification'));
            }
      }
    }

    public function show($id)
    {
        $producto = Product::find($id);
        return view('admin.productos.show', compact( 'producto'));
    }

    public function edit($id)
    {
        $typeproductos = ProductType::all();
        $producto = Product::find($id);
        return view('admin.productos.edit', compact('producto','typeproductos'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'product_families_id' => 'required',
            'code' => 'required',
            'name' => 'required',
            'description' => 'nullable',
            'salePrice' => 'required|numeric',
            'invoicePrice' => 'required|numeric',
            'stock' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
			return redirect('admin/producto')
			->withInput()
			->withErrors($validator);
		}
        else
        {
        $data = $request->input();

            try
            {
                $producto = Product::find($id);
                $producto->product_families_id = $data['product_families_id'];
                $producto->code = $data['code'];
                $producto->name = $data['name'];

                if($request->hasFile('image'))
                {
                    $request->validate([
                        'image' => 'required|image|mimes:jpg,png,jpeg'
                    ]);
                    $path = $request->file('image')->store('public/images');
                    $producto->image = $path;
                }

                $producto->description = $data['description'];
                $producto->cost = 0;
                $producto->salePrice = $data['salePrice'];
                $producto->invoicePrice = $data['invoicePrice'];
                $producto->stock = $data['stock'];
                $producto->statu = 1;
                $producto->save();

                $notification = 'Se actualizado los registros correctamente';
                return  redirect('admin/producto')->with(compact('notification'));
            }
            catch(Exception $e)
            {
                $notification = 'Su actualizado de los registros presenta errores';
                return  redirect('admin/producto')->with(compact('notification'));
            }
      }
    }
    public function UpdateStatusProducto(Request $request)
    {
        $estadoUpdate = Product::findOrFail($request->id);
        $estadoUpdate->statu = $request->statu;
        $estadoUpdate -> update();

        if($request->statu == 0)
        {
            $newStatus = '<p class="text-danger">Desabilitado</p>';
        }else{
            $newStatus =' <p class="text-success">Habilitado</p> ';
        }

        return response()->json(['var'=>''.$newStatus.'']);
    }

    public function destroy($id)
    {
            $producto = Product::findOrFail($id);
            $borrar = public_path('/image'.$producto->image);
            if (file_exists($borrar))
            {
                unlink(realpath($borrar));
            }
            $producto->delete();
            $notification = 'El Producto fue Eliminado';
            return redirect('admin/producto')->with(compact('notification'));
    }

    public function familia($id)
    {
        $familyProduct =  ProductFamily::where('product_types_id', $id)->get();
        return response()->json($familyProduct);
    }

    public function buscar(Request $request)
    {
        $estados = $request->statu;
        $buscar = $request->buscar;
        $columnasProducto = $request->columnasProducto;
        $typeproductos = ProductType::all();

        if ($estados ==  1)
        {
            if($columnasProducto == 'productfamily' )
            {
                $familiaproducto = ProductFamily::query()->where('name','LIKE', "%{$buscar}%")->get();
                $familiaproductos = ProductFamily::all();
                $productos =  Product::query()
                        ->where('product_families_id', $familiaproducto['0']->id)
                        ->where('statu', 'LIKE', "%{$estados}%")
                        ->paginate(10);

                return view('admin.productos.index', compact('productos', 'typeproductos'))->with('familiaproductos', $familiaproductos)
                        ->with('estado', $estados);

            }
            else
            {
                $familiaproductos = ProductFamily::all();
                $productos =  Product::query()
                ->where('statu', 'LIKE', "%{$estados}%")
                ->where($columnasProducto, 'LIKE', "%{$buscar}%")
                ->paginate(10);
                return view('admin.productos.index', compact('productos','typeproductos'))
                            ->with('familiaproductos', $familiaproductos)
                            ->with('estado', $estados);
            }
        }
        else if($estados == 0)
        {
            if($columnasProducto == 'productfamily' )
            {
                $familiaproducto = ProductFamily::query()->where('name','LIKE', "%{$buscar}%")->get();
                $familiaproductos = ProductFamily::all();
                $productos =  Product::query()
                        ->where('product_families_id', $familiaproducto['0']->id)
                        ->where('statu', 'LIKE', "%{$estados}%")
                        ->paginate(10);

                return view('admin.productos.index', compact('productos', 'typeproductos'))->with('familiaproductos', $familiaproductos)
                        ->with('estado', $estados);

            }
            else
            {
                $familiaproductos = ProductFamily::all();
                $productos =  Product::query()
                ->where('statu', 'LIKE', "%{$estados}%")
                ->where($columnasProducto, 'LIKE', "%{$buscar}%")
                ->paginate(10);
                return view('admin.productos.index', compact('productos', 'typeproductos'))
                            ->with('familiaproductos', $familiaproductos)
                            ->with('estado', $estados);
            }
        }
        else
        {
            $productos = Product::orderBy('id', 'desc')->paginate(10);
            return view('admin.productos.index', compact('productos', 'typeproductos'))
                        ->with('estado', $estados);
        }
    }

    public function search(Request $request)
    {
        $procuto = $request->input('name');
        $resp = Product::where('name', 'LIKE', "%{$procuto}%")->get();
        $data = [];

        foreach ($resp as $value) {
            $data[] = [
                    'id' => $value->id,
                    'name' => $value->name,
                    ];
        }
        return $data;
    }
}
