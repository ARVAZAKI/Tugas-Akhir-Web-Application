<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenSekolah extends Model
{
    use HasFactory;
    protected $table = 'absen_sekolah';
    protected $fillable = [
        'user_id',
        'status',
        'deskripsi',
        'surat_izin',
        'lokasi'
    ];
}
