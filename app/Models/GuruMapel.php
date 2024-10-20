<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruMapel extends Model
{
    use HasFactory;
    protected $table = 'guru_mapel';
    protected $fillable = [
        'mapel_id',
        'user_id'
    ];
    public $timestamps = false;

  
}
