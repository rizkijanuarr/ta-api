<?php

namespace App\Http\Controllers\Api\Public;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Http\Resources\Resource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PengaduanController extends Controller
{
    // INDEX PRIVATE
    public function index()
    {
        $pengaduan = Pengaduan::with('user', 'pengaduanCategory', 'pengaduanStatus', 'usersIdentifies')->withCount('pengaduanCounts')->when(request()->search, function($pengaduan) {
            $pengaduan = $pengaduan->where('title', 'like', '%'. request()->search . '%');
        })->where('user_id', auth()->user()->id)->latest()->paginate(5);

        //append query string to pagination links
        $pengaduan->appends(['search' => request()->search]);

        //return with Api Resource
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
}
