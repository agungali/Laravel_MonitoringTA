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
    	return view('Mahasiswa/mahasiswa', ['mahasiswa' => $mahasiswa]);
    }

    public function create(){
        return view('Mahasiswa/create-mahasiswa');
    }
    public function createdata(Request $request)
    {
    	$this->validate($request,[
    		'user_id' => 'required',
    		'title' => 'required',
            'dosen_id1' => 'required',
            'dosen_id2' => 'required',
            'year' => 'required',
            'start' => 'required',
            'finish'=> 'required'
            
    	]);
 
        Mahasiswa::create([
    		'user_id' => $request->user_id,
    		'title' => $request->title,
            'dosen_id1' => $request->dosen_id1,
            'dosen_id2' => $request->dosen_id2,
            'year' => $request->year,
            'start' => $request->start,
            'finish' => $request->finish,
            'status' => 'Invalid'
    	]);
           	return redirect('/mahasiswa');
    }
}
