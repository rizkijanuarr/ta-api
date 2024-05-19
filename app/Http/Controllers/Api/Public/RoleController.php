<?php

namespace App\Http\Controllers\Api\Public;

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
}
