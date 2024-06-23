<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\ProductFamily;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\admin\ProductType;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class ProducFamiliesController extends Controller
{
    public function index()
    {
        $familiaproductos = ProductFamily::paginate(10);
        $tipoproductos = ProductType::all();

        return view('admin.familiaproducto.index', compact('familiaproductos'))->with('tipoproductos', $tipoproductos);
    }

    public function create()
    {
        return view('admin.familiaproducto.create');
    }
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:product_families',
            'description' => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('admin/familia_producto')
                ->withInput()
                ->withErrors($validator);
        }

        $data = $request->input();
        $user_id = Auth::user()->id;
        try {

            $familiaProducto = new ProductFamily();
            $familiaProducto->user_id = $user_id;
            $familiaProducto->name = $data['name'];
            $familiaProducto->description = $data['description'];
            $familiaProducto->save();

            $notification = 'Se registro corectamente';
            return redirect('admin/familia_producto')->with(compact('notification'));
        } catch (Exception $e) {
            $notification = 'Operacion Fallada.';
            return redirect('admin/familia_producto')->with(compact('notification'));
        }
    }

    public function edit($id)
    {
        $familiaproductos = ProductFamily::find($id);
        $tipoproductos = ProductType::all();
        return view('admin.familiaproducto.edit', compact('familiaproductos'))->with('tipoproductos', $tipoproductos);
    }
    public function update(Request $request, $id)
    {

        $rules = [
            'name' => 'required|unique:product_families',
            'description' => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            dd($validator);
            return redirect('admin/familia_producto')
                ->withInput()
                ->withErrors($validator);
        } else {
            $data = $request->input();
            $user_id = Auth::user()->id;
            try {
                $familiaproducto = ProductFamily::find($id);
                $familiaproducto->user_id = $user_id;
                $familiaproducto->name = $data['name'];
                $familiaproducto->description = $data['description'];
                $familiaproducto->save();
                $notification = 'Se actualizo corectamente';
                return  redirect('admin/familia_producto')->with(compact('notification'));
            } catch (Exception $e) {
                $notification = 'Operacion Fallada';
                return redirect('admin/familia_producto')->with(compact('notification'));
            }
        }
    }
    public function show($id)
    {
        $familiaproductos = ProductFamily::find($id);
        return view('admin.familiaproducto.show', compact('familiaproductos'));
    }

    public function destroy($id)
    {
        $familiaproductos = ProductFamily::find($id);
        if ($familiaproductos->statu == 1) {
            $familiaproductos->delete();
            $notification = 'La familia de Producto fue Eliminado';
            return redirect('admin/familia_producto')->with(compact('notification'));
        } else {
            $notification = 'Tipo de Producto no fue Eliminado';
            return redirect('admin/familia_producto')->with(compact('notification'));
        }
    }

    public function UpdateStatusFamiliaProducto(Request $request)
    {
        $estadoUpdate = ProductFamily::findOrFail($request->id);
        $estadoUpdate->statu = $request->statu;
        $estadoUpdate->update();
        if ($request->statu == 0) {
            $newStatus = '<p class="text-danger">Desabilitado</p>';
        } else {
            $newStatus = ' <p class="text-success">Habilitado</p> ';
        }

        return response()->json(['var' => '' . $newStatus . '']);
    }

    public function search($buscar, $estados, $parametros)
    {
        $tipoproductos = ProductType::all();
        if ($parametros == 'product_types_id') {
            $tipoproductos = ProductType::query()
                ->where('name', 'LIKE', "%{$buscar}%")->get();
            $familiaproductos =  ProductFamily::query()
                ->where('statu', 'LIKE', "%{$estados}%")
                ->where('product_types_id', 'LIKE', "%{$tipoproductos[0]->id}%")
                ->paginate(10);
            return view('admin.familiaproducto.index', compact('familiaproductos', 'tipoproductos'))->with('estado', $estados);
        }
        $familiaproductos =  ProductFamily::query()
            ->where('statu', 'LIKE', "%{$estados}%")
            ->where($parametros, 'LIKE', "%{$buscar}%")
            ->paginate(10);
        return view('admin.familiaproducto.index', compact('familiaproductos', 'tipoproductos'))->with('estado', $estados);
    }

    public function buscar(Request $request)
    {
        $estados = $request->statu;
        $buscar = $request->buscar;
        $parametros = $request->parametros;
        $tipoproductos = ProductType::all();
        if ($estados ==  1) {
            return $this->search($buscar, $estados, $parametros);
        } else {
            return $this->search($buscar, $estados, $parametros);
        }
        $familiaproductos = ProductFamily::orderBy('id', 'desc')->paginate(10);
        return view('admin.familiaproducto.index', compact('familiaproductos', 'tipoproductos'))->with('estado', $estados);
    }
}
