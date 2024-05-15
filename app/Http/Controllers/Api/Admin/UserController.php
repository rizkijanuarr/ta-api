<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\Resource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // USER

    // INDEX
    public function index()
    {

        $users = User::when(request()->search, function($users) {
            $users = $users->where('name', 'like', '%'. request()->search . '%');
        })->with('roles')->latest()->paginate(5);


        $users->appends(['search' => request()->search]);


        return new Resource(true, 'List Data Users', $users);
    }

    // STORE
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'users_identifies_id' => 'required',
            'name'     => 'required',
            'no_hp'    => 'required',
            'no_induk' => 'required',
            'email'    => 'required|unique:users',
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $user = User::create([
            'users_identifies_id' => $request->users_identifies_id,
            'name'      => $request->name,
            'no_hp'     => $request->no_hp,
            'no_induk'  => $request->no_induk,
            'email'     => $request->email,
            'password'  => bcrypt($request->password)
        ]);

        //assign roles to user
        $user->assignRole($request->roles);

        if($user) {

            return new Resource(true, 'Data User Berhasil Disimpan!', $user);
        }


        return new Resource(false, 'Data User Gagal Disimpan!', null);
    }

    // SHOW
    public function show($id)
    {
        $user = User::with('roles')->whereId($id)->first();

        if($user) {

            return new Resource(true, 'Detail Data User!', $user);
        }


        return new Resource(false, 'Detail Data User Tidak DItemukan!', null);
    }

    // UPDATE
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'users_identifies_id' => 'required',
            'name'     => 'required',
            'no_hp'    => 'required',
            'no_induk' => 'required',
            'email'    => 'required|unique:users,email,'.$user->id,
            'password' => 'confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if($request->password == "") {


            $user->update([
                'users_identifies_id' => $request->users_identifies_id,
                'name'      => $request->name,
                'no_hp'     => $request->no_hp,
                'no_induk'  => $request->no_induk,
                'email'     => $request->email,
            ]);

        } else {


            $user->update([
                'users_identifies_id' => $request->users_identifies_id,
                'name'      => $request->name,
                'no_hp'     => $request->no_hp,
                'no_induk'  => $request->no_induk,
                'email'     => $request->email,
                'password'  => bcrypt($request->password)
            ]);

        }

        //assign roles to user
        $user->syncRoles($request->roles);

        if($user) {

            return new Resource(true, 'Data User Berhasil Diupdate!', $user);
        }


        return new Resource(false, 'Data User Gagal Diupdate!', null);
    }

    // DESTROY
    public function destroy(User $user)
    {
        if($user->delete()) {

            return new Resource(true, 'Data User Berhasil Dihapus!', null);
        }

        return new Resource(false, 'Data User Gagal Dihapus!', null);
    }


    // LAST
}
