<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiodataUser extends Model
{
    use HasFactory;
    protected $table = 'biodata_users';
    protected $fillable = [
        'no_telp',
        'foto',
        'alamat',
        'agama',
        'jenis_kelamin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
