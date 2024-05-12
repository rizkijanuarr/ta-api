<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Resource;
use App\Models\PengaduanCategory;
use Illuminate\Support\Facades\Validator;

class PengaduanCategoryController extends Controller
{
    // INDEX
    public function index()
    {

        $category = PengaduanCategory::when(request()->search, function($category) {
            $category = $category->where('name', 'like', '%'. request()->search . '%');
        })->latest()->paginate(5);


        $category->appends(['search' => request()->search]);


        return new Resource(true, 'List Pengaduan Categories', $category);
    }

    // STORE
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image'    => 'required|mimes:jpeg,jpg,png|max:2000',
            'name'     => 'required|unique:pengaduan_categories',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $image = $request->file('image');
        $image->storeAs('public/pengaduan_categories', $image->hashName());


        $category = PengaduanCategory::create([
            'image'=> $image->hashName(),
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
        ]);

        if($category) {

            return new Resource(true, 'Pengaduan Category Berhasil Disimpan!', $category);
        }


        return new Resource(false, 'Pengaduan Category Gagal Disimpan!', null);
    }

    // SHOW
    public function show($id)
    {
        $category = PengaduanCategory::whereId($id)->first();

        if($category) {

            return new Resource(true, 'Detail Pengaduan Category!', $category);
        }


        return new Resource(false, 'Detail Pengaduan Category Tidak DItemukan!', null);
    }

    // UPDATE
    public function update(Request $request, PengaduanCategory $category)
    {
        // dd($category);

        $validator = Validator::make($request->all(), [
            'name'     => 'required|unique:pengaduan_categories,name,'.$category->id,
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        if ($request->hasFile('image')) {

            Storage::disk('local')->delete('public/pengaduan_categories/' . basename($category->image));


            $image = $request->file('image');
            $image->storeAs('public/pengaduan_categories', $image->hashName());


            $category->update([
                'image' => $image->hashName(),
            ]);
        }


        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
        ]);

        if ($category->wasChanged()) {

            return new Resource(true, 'Pengaduan Category Berhasil Diupdate!', $category);
        }


        return new Resource(false, 'Pengaduan Category Gagal Diupdate!', null);
    }


    // DESTROY
    public function destroy(PengaduanCategory $category)
    {

        Storage::disk('local')->delete('public/pengaduan_categories/'.basename($category->image));

        if($category->delete()) {

            return new Resource(true, 'Pengaduan Category Berhasil Dihapus!', null);
        }


        return new Resource(false, 'Pengaduan Category Gagal Dihapus!', null);
    }

    // ALL
    public function all()
    {

        $pengaduanCategory = PengaduanCategory::latest()->get();


        return new Resource(true, 'List Data Categories', $pengaduanCategory);
    }

}
