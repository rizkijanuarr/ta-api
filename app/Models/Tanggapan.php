<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tanggapan extends Model
{
    use HasFactory;

    // TANGGAPAN
    protected $fillable = [
        'pengaduan_id', 'pengaduan_status_id', 'user_id', 'description', 'image', 'slug'
    ];

    // RELASI
    // Tujuan : agar kita bisa memanggil data induknya
    // (pengaduans) => (tanggapan)
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }

    // RELASI
    // Tujuan : agar kita bisa memanggil data induknya
    // (pengaduan_statuses) => (tanggapan)
    public function pengaduanStatus()
    {
        return $this->belongsTo(PengaduanStatus::class);
    }

    // RELASI
    // Tujuan : agar kita bisa memanggil data induknya
    // (user) => (tanggapan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // PENGATURAN UNTUK TANGGAPAN PENGADUAN (IMAGE)
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => asset('/storage/tanggapan_pengaduans/' . $image),
        );
    }
}
