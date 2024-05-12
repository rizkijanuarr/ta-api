<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\PengaduanCategoryResource;
use App\Models\PengaduanCategory;
use Illuminate\Support\Facades\Validator;

class PengaduanCategoryController extends Controller
{
    // INDEX
    public function index()
    {
        //get pengaduan_categories
        $category = PengaduanCategory::when(request()->search, function($category) {
            $category = $category->where('name', 'like', '%'. request()->search . '%');
        })->latest()->paginate(5);

        //append query string to pagination links
        $category->appends(['search' => request()->search]);

        //return with Api Resource
        return new PengaduanCategoryResource(true, 'List Pengaduan Categories', $category);
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

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/pengaduan_categories', $image->hashName());

        //create category
        $category = PengaduanCategory::create([
            'image'=> $image->hashName(),
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
        ]);

        if($category) {
            //return success with Api Resource
            return new PengaduanCategoryResource(true, 'Pengaduan Category Berhasil Disimpan!', $category);
        }

        //return failed with Api Resource
        return new PengaduanCategoryResource(false, 'Pengaduan Category Gagal Disimpan!', null);
    }

    // SHOW
    public function show($id)
    {
        $category = PengaduanCategory::whereId($id)->first();

        if($category) {
            //return success with Api Resource
            return new PengaduanCategoryResource(true, 'Detail Pengaduan Category!', $category);
        }

        //return failed with Api Resource
        return new PengaduanCategoryResource(false, 'Detail Pengaduan Category Tidak DItemukan!', null);
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

        // Periksa apakah file gambar diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            Storage::disk('local')->delete('public/pengaduan_categories/' . basename($category->image));

            // Unggah gambar baru
            $image = $request->file('image');
            $image->storeAs('public/pengaduan_categories', $image->hashName());

            // Perbarui atribut 'image'
            $category->update([
                'image' => $image->hashName(),
            ]);
        }

        // Perbarui atribut 'name' dan 'slug'
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
        ]);

        if ($category->wasChanged()) {
            // Kembalikan berhasil dengan sumber daya API
            return new PengaduanCategoryResource(true, 'Pengaduan Category Berhasil Diupdate!', $category);
        }

        // Kembalikan gagal dengan sumber daya API
        return new PengaduanCategoryResource(false, 'Pengaduan Category Gagal Diupdate!', null);
    }


    // DESTROY
    public function destroy(PengaduanCategory $category)
    {
        //remove image
        Storage::disk('local')->delete('public/pengaduan_categories/'.basename($category->image));

        if($category->delete()) {
            //return success with Api Resource
            return new PengaduanCategoryResource(true, 'Pengaduan Category Berhasil Dihapus!', null);
        }

        //return failed with Api Resource
        return new PengaduanCategoryResource(false, 'Pengaduan Category Gagal Dihapus!', null);
    }

    // ALL
    public function all()
    {
        //get categories
        $pengaduanCategory = PengaduanCategory::latest()->get();

        //return with Api Resource
        return new PengaduanCategoryResource(true, 'List Data Categories', $pengaduanCategory);
    }

}
