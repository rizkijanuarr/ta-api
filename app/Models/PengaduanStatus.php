<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaduanStatus extends Model
{
    use HasFactory;

    // PENGADUAN STATUS
    protected $fillable = [
        'name', 'slug'
    ];
}
