<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
    	$mahasiswa = Mahasiswa::all();
    	return view('mahasiswa/mahasiswa', ['mahasiswa' => $mahasiswa]);
    }
}
