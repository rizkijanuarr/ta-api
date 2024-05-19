<?php

namespace App\Http\Controllers\Api\Public;

use Illuminate\Http\Request;
use App\Models\PengaduanStatus;
use App\Http\Resources\Resource;
use App\Http\Controllers\Controller;

class PengaduanStatusController extends Controller
{
    // INDEX
    public function index()
    {

        $status = PengaduanStatus::when(request()->search, function($status) {
            $status = $status->where('name', 'like', '%'. request()->search . '%');
        })->latest()->paginate(5);


        $status->appends(['search' => request()->search]);


        return new Resource(true, 'List Pengaduan Status', $status);
    }
}
