<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;

    // TANGGAPAN
    protected $fillable = [
        'pengaduan_id', 'tanggapan_status_id', 'user_id', 'description', 'image', 'slug'
    ];
}
