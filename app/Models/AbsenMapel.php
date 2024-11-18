<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenMapel extends Model
{
    use HasFactory;
    protected $table = 'absen_mapel';
    protected $fillable = [
        'id',
        'user_id',
        'mapel_id',
        'kelas_id',
        'status',
    ];
}
