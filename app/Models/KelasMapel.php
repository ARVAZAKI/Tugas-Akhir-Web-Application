<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasMapel extends Model
{
    use HasFactory;
    protected $table = 'kelas_mapel';
    protected $fillable = [
        'kelas_id',
        'mapel_id',
        'status_absen',
    ];
    
}
