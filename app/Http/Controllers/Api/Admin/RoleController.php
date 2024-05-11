<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    // INDEX
    public function index()
    {
        //get roles
        $roles = Role::when(request()->search, function($roles) {
            $roles = $roles->where('name', 'like', '%'. request()->search . '%');
        })->with('permissions')->latest()->paginate(5);

        //append query string to pagination links
        $roles->appends(['search' => request()->search]);

        //return with Api Resource
        return new RoleResource(true, 'List Data Roles', $roles);

    }

    // STORE
    public function store(Request $request)
    {
        /**
         * Validate request
         */
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'permissions'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create role
        $role = Role::create(['name' => $request->name]);

        //assign permissions to role
        $role->givePermissionTo($request->permissions);

        if($role) {
            //return success with Api Resource
            return new RoleResource(true, 'Data Role Berhasil Disimpan!', $role);
        }

        //return failed with Api Resource
        return new RoleResource(false, 'Data Role Gagal Disimpan!', null);
    }

    // SHOW
    public function show($id)
    {
        //get role
        $role = Role::with('permissions')->findOrFail($id);

        if($role) {
            //return success with Api Resource
            return new RoleResource(true, 'Detail Data Role!', $role);
        }

        //return failed with Api Resource
        return new RoleResource(false, 'Detail Data Role Tidak Ditemukan!', null);
    }

    // UPDATE
    public function update(Request $request, Role $role)
    {
        /**
         * validate request
         */
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
            //return success with Api Resource
            return new RoleResource(true, 'Data Role Berhasil Diupdate!', $role);
        }

        //return failed with Api Resource
        return new RoleResource(false, 'Data Role Gagal Diupdate!', null);
    }

    // DESTROY
    public function destroy($id)
    {
        //find role by ID
        $role = Role::findOrFail($id);

        //delete role
        if($role->delete()) {
            //return success with Api Resource
            return new RoleResource(true, 'Data Role Berhasil Dihapus!', null);
        }

        //return failed with Api Resource
        return new RoleResource(false, 'Data Role Gagal Dihapus!', null);
    }

    // ALL
    public function all()
    {
        //get roles
        $roles = Role::latest()->get();

        //return with Api Resource
        return new RoleResource(true, 'List Data Roles', $roles);
    }
}
