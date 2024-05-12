<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengaduan extends Model
{
    use HasFactory;

    // PENGADUAN
    protected $fillable = [
        'user_id', 'pengaduan_category_id', 'pengaduan_status_id', 'title', 'description', 'location', 'image', 'slug'
    ];

    protected static function boot()
    {
        parent::boot();

        // Nilai bawaan
        static::creating(function ($model) {
            $model->pengaduan_status_id = 1; // 1 bisa merupakan ID dari status default seperti "Pending"
        });
    }



    // RELASI
    // Tujuan : agar kita bisa memanggil data induknya
    // (user) => (pengaduan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedTo()
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

    // RELASI
    // Tujuan : agar kita bisa memanggil data induknya
    // (pengaduan_counts) => (pengaduan)
    public function pengaduanCounts()
    {
        return $this->hasMany(PengaduanCounts::class);
    }

    // PENGATURAN UNTUK PENGADUAN (IMAGE)
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => asset('/storage/pengaduans/' . $image),
        );
    }


}
