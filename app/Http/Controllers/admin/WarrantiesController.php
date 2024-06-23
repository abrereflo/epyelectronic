<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Inventories;
use App\Models\admin\Product;
use App\Models\admin\Warranties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class WarrantiesController extends Controller
{
    public function index()
    {
        $garantias = Warranties::paginate(10);
        return view('admin.garantias.index', compact('garantias'));
    }
    public function create()
    {
        $productos = Product::paginate(5);
        return view('admin.garantias.create', compact('productos'));
    }

    public function buscar_producto($id)
    {
        $producto = Product::find($id);
        $data[] = [     'product_id' => $producto->id,
                        'code' => $producto->code,
                        'product' => $producto->name,];
        return($data);
       dd ($producto);
    }
    public function store(Request $request)
    {
        $rules = [
            'date_start' => 'required',
            'warranties' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('admin/garantias/create')
                ->withInput()
                ->withErrors($validator);
        }
        try {

            $resp[] = [ 'product_id' => $request->product_id,
                        'description' => $request->description];

            $garantia = new Warranties();
            $garantia->date = $request->date_start;
            $garantia->warranties = $request->warranties;
            $garantia->save();
            $garantia->product()->attach($resp);

            return redirect('admin/garantias')->with('statu', 'Se registro corectamente');
        } catch (Exception $e) {
            return redirect('admin/garantias/create')->with('failed', 'Operacion Fallada');
        }
    }

    public function edit($id)
    {
        $garantia = Warranties::find($id);
        return view('admin.garantias.edit', compact('garantia'));
    }
}
