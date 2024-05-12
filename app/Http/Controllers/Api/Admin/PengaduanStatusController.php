<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PengaduanStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PengaduanStatusResource;

class PengaduanStatusController extends Controller
{
    // INDEX
    public function index()
    {

        $status = PengaduanStatus::when(request()->search, function($status) {
            $status = $status->where('name', 'like', '%'. request()->search . '%');
        })->latest()->paginate(5);


        $status->appends(['search' => request()->search]);


        return new PengaduanStatusResource(true, 'List Pengaduan Status', $status);
    }

    // STORE
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|unique:pengaduan_statuses',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $status = PengaduanStatus::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
        ]);

        if($status) {

            return new PengaduanStatusResource(true, 'Pengaduan Status Berhasil Disimpan!', $status);
        }

        return new PengaduanStatusResource(false, 'Pengaduan Status Gagal Disimpan!', null);
    }

    // SHOW
    public function show($id)
    {
        $status = PengaduanStatus::whereId($id)->first();

        if($status) {

            return new PengaduanStatusResource(true, 'Detail Pengaduan Status!', $status);
        }

        return new PengaduanStatusResource(false, 'Detail Pengaduan Status Tidak DItemukan!', null);
    }

    // UPDATE
    public function update(Request $request, PengaduanStatus $status)
    {

        $validator = Validator::make($request->all(), [
            'name'     => 'required|unique:pengaduan_statuses,name,'.$status->id,
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Perbarui atribut 'name' dan 'slug'
        $status->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
        ]);

        if ($status->wasChanged()) {

            return new PengaduanStatusResource(true, 'Pengaduan Status Berhasil Diupdate!', $status);
        }


        return new PengaduanStatusResource(false, 'Pengaduan Status Gagal Diupdate!', null);
    }


    // DESTROY
    public function destroy(PengaduanStatus $status)
    {

        if($status->delete()) {

            return new PengaduanStatusResource(true, 'Pengaduan Status Berhasil Dihapus!', null);
        }


        return new PengaduanStatusResource(false, 'Pengaduan Status Gagal Dihapus!', null);
    }

    // ALL
    public function all()
    {

        $status = PengaduanStatus::latest()->get();


        return new PengaduanStatusResource(true, 'List Data Status', $status);
    }
}
