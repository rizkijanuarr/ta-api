<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    // PENGADUAN
    protected $fillable = [
        'user_id', 'pengaduan_category_id', 'pengaduan_status_id', 'title', 'description', 'location', 'image', 'slug'
    ];
}
