<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Resource;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    // INDEX
    public function index()
    {
        $pengaduan = Pengaduan::with('user', 'pengaduanCategory')->withCount('pengaduanCounts')->when(request()->search, function($pengaduan) {
            $pengaduan = $pengaduan->where('title', 'like', '%'. request()->search . '%');
        })->latest()->paginate(5);


        $pengaduan->appends(['search' => request()->search]);


        return new Resource(true, 'List Data Pengaduan', $pengaduan);
    }

    // POST
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pengaduan_status_id'     => 'required',
            'pengaduan_category_id'   => 'required',
            'title'         => 'required|unique:pengaduans',
            'description'   => 'required',
            'location'      => 'required',
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2000',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = $request->file('image');
        $image->storeAs('public/pengaduan', $image->hashName());

        $pengaduan = Pengaduan::create([
            'pengaduan_status_id'   => $request->pengaduan_status_id,
            'pengaduan_category_id' => $request->pengaduan_category_id,
            'title'       => $request->title,
            'description' => $request->description,
            'location'    => $request->location,
            'image'       => $image->hashName(),
            'slug'        => Str::slug($request->title, '-'),
            'user_id'     => auth()->guard('api')->user()->id
        ]);

        if($pengaduan) {

            return new Resource(true, 'Data Pengaduan Berhasil Disimpan!', $pengaduan);
        }

        return new Resource(false, 'Data Pengaduan Gagal Disimpan!', null);
    }


    // SHOW
    public function show($id)
    {
        $pengaduan = Pengaduan::with('pengaduanCategory')->whereId($id)->first();

        if($pengaduan) {

            return new Resource(true, 'Detail Data Pengaduan!', $pengaduan);
        }

        return new Resource(false, 'Detail Data Pengaduan Tidak Ditemukan!', null);
    }

    // UPDATE
    public function update(Request $request, Pengaduan $pengaduan)
    {
        $validator = Validator::make($request->all(), [
            'title'                     => 'required|unique:pengaduans,title,'.$pengaduan->id,
            'pengaduan_status_id'       => 'required',
            'pengaduan_category_id'     => 'required',
            'description'               => 'required',
            'location'                  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        if ($request->file('image')) {

            Storage::disk('local')->delete('public/pengaduan/'.basename($pengaduan->image));

            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            $pengaduan->update([
                'pengaduan_status_id'   => $request->pengaduan_status_id,
                'pengaduan_category_id' => $request->pengaduan_category_id,
                'title'       => $request->title,
                'description' => $request->description,
                'location'    => $request->location,
                'image'       => $image->hashName(),
                'slug'        => Str::slug($request->title, '-'),
                'user_id'     => auth()->guard('api')->user()->id
            ]);
        }

        $pengaduan->update([
                'pengaduan_status_id'   => $request->pengaduan_status_id,
                'pengaduan_category_id' => $request->pengaduan_category_id,
                'title'       => $request->title,
                'description' => $request->description,
                'location'    => $request->location,
                'slug'        => Str::slug($request->title, '-'),
                'user_id'     => auth()->guard('api')->user()->id
        ]);

        if($pengaduan) {

            return new Resource(true, 'Data Pengaduan Berhasil Diupdate!', $pengaduan);
        }

        return new Resource(false, 'Data Pengaduan Gagal Disupdate!', null);
    }

    // DELETE
    public function destroy(Pengaduan $pengaduan)
    {

        Storage::disk('local')->delete('public/pengaduan/'.basename($pengaduan->image));

        if($pengaduan->delete()) {

            return new Resource(true, 'Data Pengaduan Berhasil Dihapus!', null);
        }

        return new Resource(false, 'Data Pengaduan Gagal Dihapus!', null);
    }

}
