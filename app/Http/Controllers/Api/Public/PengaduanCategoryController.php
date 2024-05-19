<?php

namespace App\Http\Controllers\Api\Public;

use Illuminate\Http\Request;
use App\Http\Resources\Resource;
use App\Models\PengaduanCategory;
use App\Http\Controllers\Controller;

class PengaduanCategoryController extends Controller
{
    public function index()
    {

        $category = PengaduanCategory::when(request()->search, function($category) {
            $category = $category->where('name', 'like', '%'. request()->search . '%');
        })->latest()->paginate(5);


        $category->appends(['search' => request()->search]);


        return new Resource(true, 'List Pengaduan Categories', $category);
    }
}
