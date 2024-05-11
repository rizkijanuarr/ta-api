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

    // RELASI
    // Tujuan : agar kita bisa memanggil data induknya
    // (user) => (pengaduan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // RELASI
    // Tujuan : agar kita bisa memanggil data induknya
    // (pengaduan_category) => (pengaduan)
    public function pengaduanCategory()
    {
        return $this->belongsTo(PengaduanCategory::class);
    }

    // RELASI
    // Tujuan : agar kita bisa memanggil data induknya
    // (pengaduan_statuss) => (pengaduan)
    public function pengaduanStatus()
    {
        return $this->belongsTo(PengaduanStatus::class);
    }


}
