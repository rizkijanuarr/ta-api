<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengaduanCategory extends Model
{
    use HasFactory;

    // PENGADUAN CATEGORIES
    protected $fillable = [
        'name', 'slug', 'image'
    ];

    // RELASI
    // Tujuan : satu data pengaduan_category bisa memiliki banyak data pengaduan
    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class);
    }

    // PENGATURAN UNTUK PENGADUAN CATEGORY (IMAGE)
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => asset('/storage/pengaduan_categories/' . $image),
        );
    }

}
