<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Deliveries;
use App\Models\admin\Order;
use Illuminate\Support\Facades\Validator;
use App\Models\admin\Inventories;
use App\Models\admin\Warranties;
use Exception;
use Carbon\Carbon;


class DeliverieController extends Controller
{
    public function index()
    {
        $entregas =  Deliveries::paginate(10);
        return view('admin.entregas.index', compact('entregas'));
    }

    public function create()
    {
        $pedidos =  Order::where('statu', 'pendiente')->get();
        $envio  =  Deliveries::latest('id')->first();
        $nowday  = Carbon::now()->format('Y-m-d');
        if (empty($envio)) {
            $number_de = 1;
            return view('admin.entregas.create', compact('pedidos', 'number_de', 'nowday'));
        }
        $number_de = $envio->number + 1;
        return view('admin.entregas.create', compact('pedidos', 'number_de', 'nowday'));
    }

    public function pedido(Request $request)
    {
        $pedido = Order::find($request->id);
        $data[] = [
            'pedido_id' => $pedido->id,
            'number' => $pedido->number,
            'date' => $pedido->date,
            'cliente_name' => $pedido->cotizacion->clientee->name,
            'cliente_lastname' => $pedido->cotizacion->clientee->lastname,
            'cliente_phone' => $pedido->cotizacion->clientee->phone,
            'cliente_email' => $pedido->cotizacion->clientee->email,
            'city' => $pedido->cotizacion->clientee->city,
            'business_name' => $pedido->cotizacion->clientee->job->business_name,
            'nit' => $pedido->cotizacion->clientee->job->nit,
        ];

        foreach ($pedido->products as $key => $value) {
            $datos[] = [
                'product' => $value->name,
                'product_id' => $value->id,
                'amount' => $value->pivot->amount
            ];
        }
        return response()->json([
            'data' => $data,
            'dato' => $datos
        ]);
    }

    public function show($id)
    {
        $entrega = Deliveries::find($id);
        return view('admin.entregas.show', compact('entrega'));
    }

    public function store(Request $request)
    {
        $nowday = Carbon::now()->format('Y-m-d');
        $rules = [
            'pedido_id' => 'required',
            'hour' => 'required',
            'direction' => 'required',
            'nowday' => 'required',
            'reference' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('admin/entregas/create')
                ->withInput()
                ->withErrors($validator);
        }

        try {
            $entregas = new Deliveries();
            $entregas->orders_id = $request->pedido_id;
            $entregas->number = $request->number;
            $entregas->date = $request->nowday;
            $entregas->hour = $request->hour;
            $entregas->direction = $request->direction;
            $entregas->reference = $request->reference;

            foreach ($request->product_id as $key => $value) {
                $res[] = [
                        "product_id" => $request->product_id[$key],
                        "serial_number" => $request->sn[$key],
                    ];
            }

            $entregas->save();
            $entregas->product()->attach($res);

            $pedido = Order::find($request->pedido_id);
            $pedido->statu = 'delivered';
            $pedido->save();

            return $this->show($entregas->id)->with('statu', 'Se registro corectamente');
        } catch (Exception $e) {
            return redirect('admin/entregas/create')->with('failed', 'Operacion Fallada');
        }
    }

    public function edit($id)
    {
        $entrega =  Deliveries::find($id);
        $hours = Carbon::createFromFormat('H:i:s', $entrega->hour)->format('H:i');
        return view('admin.entregas.edit', compact('entrega','hours'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            dd($validator);
            return redirect('admin/entregas')
                ->withInput()
                ->withErrors($validator);
        }
        try {
            $data = $request->input();

            $entregas = Deliveries::find($id);
            $entregas->orders_id = $data['orders_id'];
            $entregas->number = $data['number'];
            $entregas->date =  $data['date'];
            $entregas->direction = $data['direction'];
            $entregas->hour = $data['hour'];
            $entregas->reference = $data['reference'];

            foreach ($request->sn as $key => $value) {
                $res[] = [
                    "product_id" => $request->products_id[$key],
                    "serial_number" => $request->sn[$key],
                ];
            }
            $entregas->save();
            $entregas->product()->sync($res);

           /*  $pedido = Order::find($request->pedido_id);
            $pedido->statu = 'delivered';
            $pedido->save();
            */
            return redirect('admin/entregas')->with('statu', 'Se registro corectamente');
        } catch (Exception $e) {
            return redirect('admin/entregas')->with('failed', 'Operacion Fallada');
        }
    }

    public function destroy($id)
    {
        dd($id);
    }
}
