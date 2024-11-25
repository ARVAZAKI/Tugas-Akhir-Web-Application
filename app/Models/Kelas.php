<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $fillable = [
        'nama_kelas',
        'kode_kelas'
    ];

  
    // public function users()
    // {
    //     return $this->hasMany(User::class, 'kode_kelas', 'kode_kelas');
    // }
    
    public function mapel()
    {
        return $this->belongsToMany(MataPelajaran::class, 'kelas_mapel', 'kelas_id', 'mapel_id');
    }
    public function users()
{
    return $this->hasMany(User::class, 'kelas_id');
}


}
