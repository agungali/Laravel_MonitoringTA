<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    use HasFactory;

    protected $table = "tb_t_gambar";
 
    protected $fillable = ['user_id','gbr'];
}
