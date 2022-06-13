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
    	$mahasiswa = Mahasiswa::all();
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
