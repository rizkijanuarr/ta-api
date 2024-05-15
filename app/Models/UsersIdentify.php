<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersIdentify extends Model
{
    use HasFactory;

    // USER IDENTIFY
    protected $fillable = [
        'name', 'slug'
    ];

    // RELASI
    // Tujuan : satu data user_identify bisa memiliki banyak data users
    public function usersIdentifies()
    {
        return $this->hasMany(User::class);
    }

}
