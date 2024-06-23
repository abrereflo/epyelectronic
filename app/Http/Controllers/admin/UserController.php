<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;


class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('admin.usuarios.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.usuarios.create', compact("roles"));
    }
    public function store(Request $request)
    {
        $rules = [
            'roles' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('admin/usuarios')
                ->withInput()
                ->withErrors($validator);
        } else {
          $data = $request->input();
            try
            {
                $user = new  User();
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->save();
                $user->roles()->sync($request->roles);

                return redirect('admin/usuarios')->with('Status', 'Se registro corectamente');
            }
            catch (Exception $e) {
                return redirect('admin/usuarios')->with('failed', 'Operacion Fallada');
            }
        }

    }
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $role_id = [];

        foreach ($user->roles as $role)
        {
            $role_id[] = $role->id;
        }
        return view('admin.usuarios.edit', compact('user', 'roles', 'role_id'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'roles' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('admin/usuarios')
                ->withInput()
                ->withErrors($validator);
        } else {
          $data = $request->input();
            dd( $request->roles);
            try {
                $user = User::find($id);

                 foreach ($user->roles as $role)
                 {
                    $role_id[] = $role->id;
                 }
                $user->roles()->sync($data['roles']);
                 return redirect('admin/usuarios')->with('statu', 'Se registro corectamente');
            } catch (Exception $e) {
                return redirect('admin/usuarios')->with('failed', 'Operacion Fallada');
            }
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->roles()->detach();
        $user->delete();
        return redirect('admin/usuarios')->with('Status', 'Se registro corectamente');
    }

    public function show($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $role_id = [];

        foreach ($user->roles as $role)
        {
            $role_id[] = $role->id;
        }
        return view('admin.usuarios.show', compact('user', 'roles', 'role_id'));
    }
}
