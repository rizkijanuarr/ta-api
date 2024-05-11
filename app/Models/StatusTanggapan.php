<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusTanggapan extends Model
{
    use HasFactory;

    // TANGGAPAN STATUS
    protected $fillable = [
        'name', 'slug'
    ];

    // RELASI
    // Tujuan : satu data status bisa memiliki banyak data tanggapan
    public function statusTanggapan()
    {
        return $this->hasMany(Tanggapan::class);
    }
}
