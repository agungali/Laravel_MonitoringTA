<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    
    public function index()
    {
    	//$mahasiswa = Mahasiswa::all();
        $mahasiswa = DB::select("SELECT tb_t_mahasiswa.id, users.name as nama, tb_t_mahasiswa.nim, tb_t_mahasiswa.title, tb_t_mahasiswa.year, users.name as mahasiswa, dospem1.name as dosen1, dospem2.name as dosen2, tb_t_mahasiswa.start,tb_t_mahasiswa.finish,tb_t_mahasiswa.status  FROM tb_t_mahasiswa
        JOIN users ON tb_t_mahasiswa.user_id=users.id
        JOIN users AS dospem1 ON dospem1.id = tb_t_mahasiswa.dosen_id1
        JOIN users AS dospem2 ON dospem2.id = tb_t_mahasiswa.dosen_id2");
    	return view('admin/admin', ['mahasiswa' => $mahasiswa]);
        
    }

    public function getdosen(){
        $getdosen = DB::Table('users')
                    ->where('role', 'dosen')
                    ->get();
        //$getdosen = DB::select('select * from users where role =?', ['dosen']);
                    return view('admin/daftardosen', ['getdosen' => $getdosen]);
    }
}
