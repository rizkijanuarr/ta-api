<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaduanCategory extends Model
{
    use HasFactory;

    // PENGADUAN CATEGORIES
    protected $fillable = [
        'name', 'slug', 'image'
    ];
}
