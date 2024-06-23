<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Client;
use App\Models\admin\Jobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $clientes = Client::where('statu', 1)->paginate(10);
        $ciudades = ['LA PAZ', 'EL ALTO', 'COCHABAMBA', 'SANTA CRUZ DE LA SIERRA', 'SUCRE', 'ORURO', 'TARIJA', 'TRINIDAD', 'POTOSÍ', 'PANDO'];
        $code = Client::latest('id')->first();
        if (empty($code)) {
            $code_cli = 'CLI-1';
            return view('admin.clientes.index', compact('clientes', 'ciudades', 'code_cli'));
        }
        else
        {
            $sum = $code->id + 1;
            $code_cli = 'CLI-' . $sum;
            return view('admin.clientes.index', compact('clientes', 'ciudades', 'code_cli'));
        }
    }

    public function list($id)
    {
        $cliente = Client::find($id);

        $data[] = [ 'name' => $cliente->name.' '.$cliente->lastname,
                    'ci' => $cliente->ci,
                    'address' => $cliente->address,
                    'city' => $cliente->city,
                    'job' => $cliente->job->business_name,
                    'nit' => $cliente->job->nit ];
        return $data;
    }
    public function save_cliente(Request $request)
    {
        $rules = [
            'code' => 'required|unique:clients',
            'name' => 'required',
            'lastname' => 'required',
            'ci' => 'required|unique:clients',
            'phone' => 'required|numeric',
            'address' => 'required',
            'email' => 'required|unique:clients',
            'city' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('admin/cotizacion')
                ->withInput()
                ->withErrors($validator);
        } else {
            $data = $request->input();
            try {
                $cliente = new Client();
                $cliente->code = $data['code'];
                $cliente->name = $data['name'];
                $cliente->lastname = $data['lastname'];
                $cliente->phone = $data['phone'];
                $cliente->city = $data['city'];
                $cliente->address = $data['address'];
                $cliente->ci = $data['ci'];
                $cliente->email = $data['email'];
                $cliente->save();

                $jobs = new Jobs();
                $jobs->business_name = $data['business_name'];
                $jobs->nit = $data['nit'];

                $cliente->job()->save($jobs);

                $clientes = Client::find($cliente->id);

                $datos[] = [
                    'id' => $clientes->id,
                    'code' => $clientes->code,
                    'name' => $clientes->name,
                    'lastname' => $clientes->lastname,
                    'phone' => $clientes->phone,
                    'city' => $clientes->city,
                    'address' => $clientes->address,
                    'business_name' => $clientes->job->business_name,
                    'nit' => $clientes->job->nit,
                    'ci' => $clientes->ci,
                    'email' => $clientes->email
                ];

                return response($datos);
            } catch (Exception $e) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->errors(),
                ]);
            }
        }
    }

    public function store(Request $request)
    {
        /*
        "code" => "CLI-1"
        "name" => "abrareflo"
        "lastname" => "flores"
        "ci" => "12345678"
        "phone" => "82583886"
        "city" => "COCHABAMBA"
        "address" => "km41"
        "email" => "abrareflo@gmail.com"
        "business_name" => null
        "nit" => null
        */
       /*  dd($request->all()); */
        $rules = [
            'code' => 'required|unique:clients',
            'name' => 'required',
            'lastname' => 'required',
            'ci' => 'required|unique:clients',
            'phone' => 'required|numeric',
            'address' => 'required',
            'email' => 'required|unique:clients',
            'city' => 'required',
        ];


        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('admin/cliente')
                ->withInput()
                ->withErrors($validator);
        } else {
            $data = $request->input();
            $id_user = Auth::user()->id;
            try {
                $cliente = new Client();
                $cliente->user_id = $id_user;
                $cliente->code = $data['code'];
                $cliente->name = $data['name'];
                $cliente->lastname = $data['lastname'];
                $cliente->nit = $data['ci'];
                $cliente->ci = $data['ci'];
                $cliente->city = $data['city'];
                $cliente->phone = $data['phone'];
                $cliente->address = $data['address'];
                $cliente->email = $data['email'];
                $cliente->save();

                $jobs = new Jobs();
                $jobs->business_name = $data['business_name'];
                $jobs->nit = $data['nit'];

                $cliente->job()->save($jobs);

                return $this->show($cliente->id)->with('success', 'Se registro corectamente');
            } catch (Exception $e) {
                return redirect('admin/cliente')->with('failed', 'Operacion Fallada');
            }
        }
    }
    public function show($id)
    {
        $clientes = Client::find($id);
        return view('admin.clientes.show', compact('clientes'));
    }

    public function edit($id)
    {
        $clientes = Client::find($id);
        $ciudades = ['LA PAZ', 'EL ALTO', 'COCHABAMBA', 'SANTA CRUZ DE LA SIERRA', 'SUCRE', 'ORURO', 'TARIJA', 'TRINIDAD', 'POTOSÍ', 'PANDO'];
        return view('admin.clientes.edit', compact('clientes', 'ciudades'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'ci' => 'required',
            'phone' => 'required|numeric',
            'city' => 'required',
            'address' => 'required',
            'email' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('admin/cliente')
                ->withInput()
                ->withErrors($validator);
        } else {
            $data = $request->input();
            try {
                $cliente = Client::find($id);
                $cliente->name = $data['name'];
                $cliente->lastname = $data['lastname'];
                $cliente->ci = $data['ci'];
                $cliente->phone = $data['phone'];
                $cliente->city = $data['city'];
                $cliente->address = $data['address'];
                $cliente->email = $data['email'];
                $cliente->save();
                $job = Jobs::where('jobable_id', $id)->get();
                foreach ($job as $key => $jobs) {
                    $jobs->business_name = $data['business_name'];
                    $jobs->nit = $data['nit'];
                    $cliente->job()->save($jobs);
                }
                return  redirect('admin/cliente')->with('success', 'Se registro corectamente');
            } catch (Exception $e) {
                return redirect('admin/cliente')->with('failed', 'Operacion Fallada');
            }
        }
    }

    public function UpdateStatusClientes(Request $request)
    {
        $estadoUpdate = Client::findOrFail($request->id);
        $estadoUpdate->statu = $request->statu;
        $estadoUpdate->update();
        if ($request->statu == 0) {
            $newStatus = '<p class="text-danger">Desabilitado</p>';
        } else {
            $newStatus = ' <p class="text-success">Habilitado</p> ';
        }

        return response()->json(['var' => '' . $newStatus . '']);
    }

    public function destroy($id)
    {
        $clientes = Client::find($id);
        if ($clientes->statu == 1) {
            $clientes->delete();
            return redirect('admin/cliente')->with('success', 'Tipo de Producto fue Eliminado');
        } else {
            return redirect('admin/cliente')->with('success', 'Tipo de Producto no fue Eliminado');
        }
    }

    public function buscar(Request $request)
    {
        $estados = $request->statu;
        $buscar = $request->buscar;
        $columnasClientes = $request->columnasClientes;
        $code = Client::latest('code')->first();
        $ciudades = ['LA PAZ', 'EL ALTO', 'COCHABAMBA', 'SANTA CRUZ DE LA SIERRA', 'SUCRE', 'ORURO', 'TARIJA', 'TRINIDAD', 'POTOSÍ', 'PANDO'];
        $sum = $code->id + 1;
        $code_cli = 'CLI-' . $sum;

        if ($estados ==  1) {
            $clientes =  Client::query()
                ->where('statu', 'LIKE', "%{$estados}%")
                ->where($columnasClientes, 'LIKE', "%{$buscar}%")
                ->paginate(10);
            return view('admin.clientes.index', compact('clientes', 'code_cli', 'ciudades'));
        } else if ($estados == 0) {
            $clientes =  Client::query()
                ->where('statu', 'LIKE', "%{$estados}%")
                ->where($columnasClientes, 'LIKE', "%{$buscar}%")
                ->paginate(10);
            return view('admin.clientes.index', compact('clientes', 'code_cli', 'ciudades'));
        }

        $clientes = Client::orderBy('id', 'desc')->paginate(10);
        return view('admin.clientes.index', compact('clientes', 'code_cli', 'ciudades'));
    }

    public function search(Request $request)
    {
        $client = $request->input('name');
        $resp = Client::where(DB::raw("CONCAT(clients.name, clients.lastname)"), 'LIKE', "%{$client}%")->orWhere('ci','LIKE', $client)->orWhere('code','LIKE', $client)->get();
        $data = [];
        foreach ($resp as $value) {
            $fullname = $value->name.' '.$value->lastname;
            $data[] = [ 'id' => $value->id,
                      'fullname' => $fullname,
                      'email' => $value->email
                    ];
        }
        return $data;
    }

    public function reporte()
    {
        return view('admin.reportes.clientes');
    }
}
