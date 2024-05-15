<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\UsersIdentify;
use App\Http\Resources\Resource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserIdentifiesController extends Controller
{

    // INDEX
    public function index()
    {

        $identifies = UsersIdentify::when(request()->search, function($identifies) {
            $identity = $identifies->where('name', 'like', '%'. request()->search . '%');
        })->latest()->paginate(5);


        $identifies->appends(['search' => request()->search]);


        return new Resource(true, 'List Identitas User', $identifies);
    }

    // STORE
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|unique:users_identifies',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $identifies = UsersIdentify::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
        ]);

        if($identifies) {

            return new Resource(true, 'Identitas User Berhasil Disimpan!', $identifies);
        }

        return new Resource(false, 'Identitas User Gagal Disimpan!', null);
    }

    // SHOW
    public function show($id)
    {
        $identifies = UsersIdentify::whereId($id)->first();

        if($identifies) {

            return new Resource(true, 'Detail Identitas User!', $identifies);
        }

        return new Resource(false, 'Detail Identitas User Tidak DItemukan!', null);
    }

    // UPDATE
    public function update(Request $request, UsersIdentify $identify)
    {

        // dd($identify);

        $validator = Validator::make($request->all(), [
            'name'     => 'required|unique:users_identifies,name,'.$identify->id,
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Perbarui atribut 'name' dan 'slug'
        $identify->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
        ]);

        if ($identify->wasChanged()) {

            return new Resource(true, 'Identitas User Berhasil Diupdate!', $identify);
        }


        return new Resource(false, 'Identitas User Gagal Diupdate!', null);
    }


    // DESTROY
    public function destroy(UsersIdentify $identify)
    {

        if($identify->delete()) {

            return new Resource(true, 'Identitas User Berhasil Dihapus!', null);
        }


        return new Resource(false, 'Identitas User Gagal Dihapus!', null);
    }

    // ALL
    public function all()
    {

        $identify = UsersIdentify::latest()->get();


        return new Resource(true, 'List Data Identitas User', $identify);
    }
}
