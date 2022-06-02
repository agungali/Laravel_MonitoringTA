<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    // use HasFactory;
    protected $table = "tb_t_mahasiswa";

    protected $fillable = ['user_id','title', 'dosen_id1','dosen_id2','year','start','finish','status'];
}
