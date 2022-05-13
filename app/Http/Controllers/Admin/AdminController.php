<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class AdminController extends Controller
{
    public function index()
    {
    	$mahasiswa = Mahasiswa::all();
    	return view('admin/admin', ['mahasiswa' => $mahasiswa]);
    }
}
