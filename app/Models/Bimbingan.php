<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    //use HasFactory;
    protected $table = "tb_t_bimbingan";

    protected $fillable = [
        'user_id',
        'dospem',
        'tanggal',
        'data',
        'status_bimbingan'
    ];
}
