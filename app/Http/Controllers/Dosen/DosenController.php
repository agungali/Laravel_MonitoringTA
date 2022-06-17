<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;

class DosenController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $mahasiswa = Mahasiswa::all();
        $mahasiswa = DB::select("SELECT tb_t_mahasiswa.title, tb_t_mahasiswa.year, users.name as mahasiswa, dospem1.name as dosen1, dospem2.name as dosen2, tb_t_mahasiswa.start,tb_t_mahasiswa.finish,tb_t_mahasiswa.status  FROM tb_t_mahasiswa
        JOIN users ON tb_t_mahasiswa.user_id=users.id
        JOIN users AS dospem1 ON dospem1.id = tb_t_mahasiswa.dosen_id1
        JOIN users AS dospem2 ON dospem2.id = tb_t_mahasiswa.dosen_id2 where tb_t_mahasiswa.dosen_id1 ='$id' or tb_t_mahasiswa.dosen_id2 = '$id'");
         
         
        return view('Mahasiswa/mahasiswa', ['mahasiswa' => $mahasiswa]);
    }
}
