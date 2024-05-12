<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Resource;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    // INDEX
    public function index()
    {

        $permissions = Permission::when(request()->search, function($permissions) {
            $permissions = $permissions->where('name', 'like', '%'. request()->search . '%');
        })->latest()->paginate(5);


        $permissions->appends(['search' => request()->search]);


        return new Resource(true, 'List Data Permissions', $permissions);
    }

    // ALL
    public function all()
    {

        $permissions = Permission::latest()->get();


        return new Resource(true, 'List Data Permissions', $permissions);
    }
}
