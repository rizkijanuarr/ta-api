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

    // RELASI
    // Tujuan : agar kita bisa memanggil data induknya
    // (pengaduans) => (tanggapan)
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }

    // RELASI
    // Tujuan : agar kita bisa memanggil data induknya
    // (tanggapan_statuses) => (tanggapan)
    public function statusTanggapan()
    {
        return $this->belongsTo(StatusTanggapan::class);
    }

    // RELASI
    // Tujuan : agar kita bisa memanggil data induknya
    // (user) => (tanggapan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
