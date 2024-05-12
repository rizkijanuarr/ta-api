<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\Resource;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    // INDEX
    public function index()
    {

        $roles = Role::when(request()->search, function($roles) {
            $roles = $roles->where('name', 'like', '%'. request()->search . '%');
        })->with('permissions')->latest()->paginate(5);


        $roles->appends(['search' => request()->search]);


        return new Resource(true, 'List Data Roles', $roles);

    }

    // STORE
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'permissions'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $role = Role::create(['name' => $request->name]);

        //assign permissions to role
        $role->givePermissionTo($request->permissions);

        if($role) {

            return new Resource(true, 'Data Role Berhasil Disimpan!', $role);
        }


        return new Resource(false, 'Data Role Gagal Disimpan!', null);
    }

    // SHOW
    public function show($id)
    {

        $role = Role::with('permissions')->findOrFail($id);

        if($role) {

            return new Resource(true, 'Detail Data Role!', $role);
        }


        return new Resource(false, 'Detail Data Role Tidak Ditemukan!', null);
    }

    // UPDATE
    public function update(Request $request, Role $role)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'permissions'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //update role
        $role->update(['name' => $request->name]);

        //sync permissions
        $role->syncPermissions($request->permissions);

        if($role) {

            return new Resource(true, 'Data Role Berhasil Diupdate!', $role);
        }


        return new Resource(false, 'Data Role Gagal Diupdate!', null);
    }

    // DESTROY
    public function destroy($id)
    {

        $role = Role::findOrFail($id);


        if($role->delete()) {

            return new Resource(true, 'Data Role Berhasil Dihapus!', null);
        }


        return new Resource(false, 'Data Role Gagal Dihapus!', null);
    }

    // ALL
    public function all()
    {

        $roles = Role::latest()->get();


        return new Resource(true, 'List Data Roles', $roles);
    }
}
