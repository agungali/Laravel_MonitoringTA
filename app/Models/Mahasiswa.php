<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    // use HasFactory;
    protected $table = "tb_t_mahasiswa";

    protected $fillable = [
        'user_id',
        'nim',
        'title',
        'dosen_id1',
        'dosen_id2',
        'year',
        'start',
        'finish',
        'status'
    ];


    //relation start
    public function users(){
    	return $this->belongsTo('App\User');
    }
    //relation end
}
