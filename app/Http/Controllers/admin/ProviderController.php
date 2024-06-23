<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Providers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{
    public function index()
    {
        $proveedores = Providers::paginate(10);
        return view('admin.proveedor.index', compact('proveedores'));
    }


    public function store(Request $request)
    {

        $rules = [
           'name' => 'required',
            'last_name' => 'required',
            'nit' => 'nullable|unique:providers',
            'phone' => 'required|numeric',
            'phone_company' => 'nullable|numeric',
            'direction' => 'nullable',
            'email' => 'nullable|unique:providers',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('admin/proveedor')
                ->withInput()
                ->withErrors($validator);
        } else {
            $data = $request->input();
            $id_user = Auth::user()->id;
            $full_name = $data['name'].' '.$data['last_name'];

            try {
                $proveedor = new Providers();
                $proveedor->user_id = $id_user;
                $proveedor->name = $data['name'];
                $proveedor->last_name = $data['last_name'];
                $proveedor->full_name = $full_name;
                $proveedor->phone = $data['phone'];
                $proveedor->direction = $data['direction'];
                $proveedor->email = $data['email'];
                $proveedor->phone_company = $data['phone_company'];
                $proveedor->business_name = $data['business_name'];
                $proveedor->nit = $data['nit'];
                $proveedor->type_supplier = $data['type_supplier'];
                $proveedor->save();
                if ('inventario' == $data['titulo']) {
                    $dato[] = [
                        'id' => $proveedor->id,
                        'full_name' => $proveedor->full_name,
                        'phone' => $proveedor->phone,
                        'direction' => $proveedor->direction,
                        'email' => $proveedor->email,
                        'phone_company' => $proveedor->phone_company,
                        'business_name' => $proveedor->business_name,
                        'nit' => $proveedor->nit,
                        'type_supplier' => $proveedor->type_supplier,
                    ];
                    return $dato;
                }
                else
                {
                    return $this->show($proveedor->id)->with('success', 'Se registro corectamente');
                }

            } catch (Exception $e) {
                return redirect('admin/proveedor')->with('failed', 'Operacion Fallada');
            }
        }
    }

    public function show($id)
    {
        $proveedor = Providers::find($id);
        return view('admin.proveedor.show', compact('proveedor'));
    }
    public function edit($id)
    {
        $proveedor = Providers::find($id);
        return view('admin.proveedor.edit', compact('proveedor'));
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'last_name' => 'required',
            /* 'nit' => 'unique:providers', */
            'phone' => 'required|numeric',
            'phone_company' => 'numeric',
            /* 'email' => 'unique:providers', */
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('admin/proveedor')
                ->withInput()
                ->withErrors($validator);
        } else {
            $data = $request->input();
            $id_user = Auth::user()->id;
            $full_name = $data['name'].' '.$data['last_name'];

            try {
                $proveedor = Providers::find($id);
                $proveedor->user_id = $id_user;
                $proveedor->name = $data['name'];
                $proveedor->last_name = $data['last_name'];
                $proveedor->full_name = $full_name;
                $proveedor->phone = $data['phone'];
                $proveedor->direction = $data['direction'];
                $proveedor->email = $data['email'];
                $proveedor->phone_company = $data['phone_company'];
                $proveedor->business_name = $data['business_name'];
                $proveedor->nit = $data['nit'];
                $proveedor->type_supplier = $data['type_supplier'];
                $proveedor->save();

                return $this->show($proveedor->id)->with('success', 'Se registro corectamente');
            } catch (Exception $e) {
                return redirect('admin/proveedor')->with('failed', 'Operacion Fallada');
            }
        }
    }

    public function UpdateStatusproveedores(Request $request)
    {
        $estadoUpdate = Providers::findOrFail($request->id);
        $estadoUpdate->status = $request->status;
        $estadoUpdate->update();
        if ($request->status == 2) {
            $newStatus = '<p class="text-danger">Desabilitado</p>';
        } else {
            $newStatus = ' <p class="text-success">Habilitado</p> ';
        }

        return response()->json(['var' => '' . $newStatus . '']);
    }

    public function destroy($id)
    {
        $proveedor = Providers::find($id);
        if ($proveedor->status == 2) {
            $proveedor->delete();
            return redirect('admin/proveedor')->with('success', 'Tipo de Producto fue Eliminado');
        } else {
            return redirect('admin/proveedor')->with('success', 'Tipo de Producto no fue Eliminado');
        }
    }

    public function buscar(Request $request)
    {
        $estados = $request->status;
        $buscar = $request->buscar;
        $parametros = $request->parametros;

        if ($estados ==  1) {
            $proveedores =  Providers::query()
                ->where('status', 'LIKE', "%{$estados}%")
                ->where($parametros, 'LIKE', "%{$buscar}%")
                ->paginate(10);
            return view('admin.proveedor.index', compact('proveedores'));
        } else if ($estados == 0) {
            $proveedores =  Providers::query()
                ->where('status', 'LIKE', "%{$estados}%")
                ->where($parametros, 'LIKE', "%{$buscar}%")
                ->paginate(10);
            return view('admin.proveedor.index', compact('proveedores'));
        }

        $proveedores = Providers::orderBy('id', 'desc')->paginate(10);
        return view('admin.proveedor.index', compact('proveedores'));
    }

    public function search(Request $request)
    {
        $buscar = $request->input('name');
        $resp = Providers::where('full_name', 'LIKE', "%{$buscar}%")->orWhere('nit', 'LIKE', "%{$buscar}%")->get();
        $data = [];

        foreach ($resp as $value) {
            $data[] = [
                    'id' => $value->id,
                    'full_name' => $value->full_name,
                    ];
        }
        return $data;
    }

    public function list($id){
        $producto = Providers::find($id);
        return $producto;
    }
}
