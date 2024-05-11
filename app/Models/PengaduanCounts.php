<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaduanCounts extends Model
{
    use HasFactory;

    // PENGADUAN COUNTS
    protected $fillable = [
        'pengaduan_id', 'counts'
    ];
}
