<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Claims;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class ClaimsController extends Controller
{
    public function index()
    {
        $reclamos = Claims::paginate(10);
        return view('admin.reclamos.index', compact('reclamos'));
    }

    public function create()
    {
        $date  = Carbon::now()->format('Y-m-d');
        $reclamo = Claims::latest('id')->first();
        if(empty($reclamo->id))
        {
            $number = 1;
            return view('admin.reclamos.create', compact('date', 'number'));
        }
        else
        {
            $number = $reclamo->number + 1;
            return view('admin.reclamos.create', compact('date', 'number'));
        }

    }

    public function store(Request $request)
    {


        $date = Carbon::now()->format('Y-m-d');

        $rules = [
            'client_id' => 'required',
            'number' => 'required|numeric'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('admin/reclamos/create')
                ->withInput()
                ->withErrors($validator);
        }
        try {
            $reclamo = new Claims();
            $reclamo->clients_id = $request->client_id;
            $reclamo->date = $date;
            $reclamo->number = $request->number;

            foreach ($request->product_id as $key => $value) {
                    $data[] = [ 'product_id' => $request->product_id[$key],
                                'serial' => $request->serial[$key],
                                'description'  => $request->description[$key]];
            }

            $reclamo->save();
            $reclamo->product()->attach($data);

            return redirect('admin/reclamos')->with('statu', 'Se registro corectamente');
        } catch (Exception $e) {
            return redirect('admin/reclamos/create')->with('failed', 'Operacion Fallada');
        }

    }
}
