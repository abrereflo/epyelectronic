<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Exception;


class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(10);
        return view('admin.funciones.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.funciones.create', compact('permissions'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        foreach ($role->permissions as $permission)
        {
            $permission_id[] = $permission->id;
        }
        return view('admin.funciones.edit', compact('role','permissions', 'permission_id'));
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('admin/funciones')
                ->withInput()
                ->withErrors($validator);
        } else {
            $data = $request->input();

            try {
                $role = Role::find($id);
                $role->name = $data['name'];
                $role->guard_name = 'web';
                $role->save();
                $role->syncPermissions($request->permission);

                return $this->show($role->id)->with('statu', 'Se registro corectamente');
                //return redirect('admin/marca_de_motorisado')->with('statu', 'Se registro corectamente');
            } catch (Exception $e) {
                return redirect('admin/funciones')->with('failed', 'Operacion Fallada');
            }
        }
    }
    public function show($id)
    {
        $role = Role::find($id);
        return view('admin.funciones.show', compact('role'));
    }

    public function store(Request $request)
    {
        /* dd($request); */
        $rules = [
            'name' => 'required|string',
            /*    'description' => 'required' */
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('admin/funciones')
                ->withInput()
                ->withErrors($validator);
        } else {
            $data = $request->input();
            try {
                $role = new Role();
                $role->name = $data['name'];
                $role->guard_name = 'web';
                $role->save();

                $role->syncPermissions($request->permission);
                return $this->show($role->id)->with('statu', 'Se registro corectamente');
                //return redirect('admin/marca_de_motorisado')->with('statu', 'Se registro corectamente');
            } catch (Exception $e) {
                return redirect('admin/funciones')->with('failed', 'Operacion Fallada');
            }
        }
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->removeRole($role);
        return view('admin.funciones.index');
    }
}
