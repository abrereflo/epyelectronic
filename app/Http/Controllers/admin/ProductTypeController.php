<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\ProductType as AdminProductType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductTypeController extends Controller
{

    public function index()
    {
        $tipoproductos = AdminProductType::paginate(10);
        return view('admin.tipoproductos.index', compact('tipoproductos'));
    }

    public function create()
    {
        return view('admin.tipoproductos.create');
    }
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:2|unique:product_types',
            'description' => 'nullable',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('admin/tipo_producto')
                ->withInput()
                ->withErrors($validator);
        }
        $data = $request->input();
        $user_id = Auth::user()->id;
        try {

            $tipoproducto = new AdminProductType();
            $tipoproducto->user_id = $user_id;
            $tipoproducto->name = $data['name'];
            $tipoproducto->description = $data['description'];
            $tipoproducto->save();

            $notification = 'Se registro corectamente';
            return  redirect('admin/tipo_producto')->with(compact('notification'));

        } catch (Exception $e) {

            $notification = 'Operacion Fallada';
            return redirect('admin/tipo_producto')->with(compact('notification'));
        }
    }
    public function edit($id)
    {
        $tipoproductos = AdminProductType::find($id);
        return view('admin.tipoproductos.edit', compact('tipoproductos'));
    }
    public function update(Request $request, $id)
    {

        $rules = [
            'name' => 'required',
            'description' => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            /* dd($validator); */
            return redirect('admin/tipo_producto')
                ->withInput()
                ->withErrors($validator);
        } else {
            $data = $request->input();
            try {
                $tipoproducto = AdminProductType::find($id);
                $tipoproducto->name = $data['name'];
                $tipoproducto->description = $data['description'];
                $tipoproducto->save();

                $notification = 'Se Actualizo correctamente';
                return  redirect('admin/tipo_producto')->with(compact('notification'));
            } catch (Exception $e) {
                $notification = 'Operacion Fallada';
                return redirect('admin/tipo_producto')->with(compact('notification'));
            }
        }
    }

    public function destroy($id)
    {
        $tipoproducto = AdminProductType::find($id);
        if ($tipoproducto->statu == 1) {
            $tipoproducto->delete();
            $notification = 'Tipo de Producto fue Eliminado';
            return redirect('admin/tipo_producto')->with(compact('notification'));
        } else {
            $notification = 'Tipo de Producto no fue Eliminado';
            return redirect('admin/tipo_producto')->with(compact('notification'));
        }
    }

    public function show($id)
    {
        $tipoproductos = AdminProductType::find($id);
        return view('admin.tipoproductos.show', compact('tipoproductos'));
    }

    public function UpdateStatusTipoProducto(Request $request)
    {
        $estadoUpdate = AdminProductType::findOrFail($request->id);
        $estadoUpdate->statu = $request->statu;
        $estadoUpdate->update();

        if ($request->statu == 0) {
            $newStatus = '<p class="text-danger">Desabilitado</p>';
        } else {
            $newStatus = ' <p class="text-success">Habilitado</p> ';
        }

        return response()->json(['var' => '' . $newStatus . '']);
    }


    public function buscar(Request $request)
    {
        $estados = $request->statu;
        $buscar = $request->buscar;
        $parametros = $request->parametros;

        if ($estados ==  1) {
            $tipoproductos =  AdminProductType::query()
                ->where('statu', 'LIKE', "%{$estados}%")
                ->where($parametros, 'LIKE', "%{$buscar}%")
                ->paginate(10);
            return view('admin/tipoproductos.index')->with('tipoproductos', $tipoproductos)
                ->with('estado', $estados);
        } else {
            $tipoproductos =  AdminProductType::query()
                ->where('statu', 'LIKE', "%{$estados}%")
                ->where($parametros, 'LIKE', "%{$buscar}%")
                ->paginate(10);
            return view('admin/tipoproductos.index')->with('tipoproductos', $tipoproductos)
                ->with('estado', $estados);
        }
        $tipoproductos = AdminProductType::orderBy('id', 'desc')->paginate(10);
        return view('admin/tipoproductos.index', compact('tipoproductos'))
            ->with('estado', $estados);
    }
}
