<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;
    protected $table = 'mata_pelajaran';
    protected $fillable = ['nama_mapel'];

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_mapel', 'mapel_id', 'kelas_id');
    }
    public function guru()
    {
        return $this->belongsToMany(User::class, 'guru_mapel', 'mapel_id', 'user_id');
    }

}
