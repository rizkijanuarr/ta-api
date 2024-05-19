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
    // INDEX PUBLIC
    public function index()
    {
        $pengaduan = Pengaduan::with('user', 'pengaduanCategory', 'pengaduanStatus', 'usersIdentifies')->withCount('pengaduanCounts')->when(request()->search, function($pengaduan) {
            $pengaduan = $pengaduan->where('title', 'like', '%'. request()->search . '%');
        })->latest()->paginate(5);


        $pengaduan->appends(['search' => request()->search]);


        return new Resource(true, 'List Data Pengaduan', $pengaduan);
    }

    // POST
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
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
            'title'                     => 'sometimes|required|unique:pengaduans,title,'.$pengaduan->id,
            'users_identifies_id'       => 'sometimes|required',
            'pengaduan_status_id'       => 'sometimes|required',
            'pengaduan_category_id'     => 'sometimes|required',
            'description'               => 'sometimes|required',
            'location'                  => 'sometimes|required',
            'tanggapan_description'     => 'sometimes|required|string',
            'tanggapan_image'           => 'sometimes|required|image|mimes:jpeg,jpg,png|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $updateData = [];

        if ($request->has('title')) {
            $updateData['title'] = $request->title;
            $updateData['slug'] = Str::slug($request->title, '-');
        }
        if ($request->has('users_identifies_id')) {
            $updateData['users_identifies_id'] = $request->users_identifies_id;
        }
        if ($request->has('pengaduan_status_id')) {
            $updateData['pengaduan_status_id'] = $request->pengaduan_status_id;
        }
        if ($request->has('pengaduan_category_id')) {
            $updateData['pengaduan_category_id'] = $request->pengaduan_category_id;
        }
        if ($request->has('description')) {
            $updateData['description'] = $request->description;
        }
        if ($request->has('location')) {
            $updateData['location'] = $request->location;
        }

        if ($request->file('image')) {
            Storage::disk('local')->delete('public/pengaduan' . basename($pengaduan->image));

            $image = $request->file('image');
            $image->storeAs('public/pengaduan', $image->hashName());

            $updateData['image'] = $image->hashName();
        }

        // Update tanggapan
        if ($request->has('tanggapan_description')) {
            $updateData['tanggapan_description'] = $request->tanggapan_description;
        }

        if ($request->file('tanggapan_image')) {

            $tanggapanImage = $request->file('tanggapan_image');
            $tanggapanImage->storeAs('public/tanggapan', $tanggapanImage->hashName());

            $updateData['tanggapan_image'] = $tanggapanImage->hashName();
        }

        $pengaduan->update($updateData);

        if ($pengaduan) {
            return new Resource(true, 'Data Pengaduan Berhasil Diupdate!', $pengaduan);
        }

        return new Resource(false, 'Data Pengaduan Gagal Diupdate!', null);
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
