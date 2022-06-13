<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class MahasiswaController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        //$mahasiswa = Mahasiswa::all();
        $mahasiswa = DB::select("SELECT tb_t_mahasiswa.title, tb_t_mahasiswa.year, users.name as mahasiswa, dospem1.name as dosen1, dospem2.name as dosen2, tb_t_mahasiswa.start,tb_t_mahasiswa.finish,tb_t_mahasiswa.status  FROM tb_t_mahasiswa
        JOIN users ON tb_t_mahasiswa.user_id=users.id
        JOIN users AS dospem1 ON dospem1.id = tb_t_mahasiswa.dosen_id1
        JOIN users AS dospem2 ON dospem2.id = tb_t_mahasiswa.dosen_id2 where tb_t_mahasiswa.user_id = '$id'");
        // ->join('users.id', '=', 'tb_t_mahasiswa.user_id')
        // ->join('users AS dospem1 ON dospem1.id','=','tb_t_mahasiswa.dosen_id1')
        // ->join('users AS dospem2 ON dospem2.id','=','tb_t_mahasiswa.dosen_id2')
        // ->select('tb_t_mahasiswa.*', 'user.name','tb_t_mahasiswa.title', 'dospem1.name',
        // 'dospem2.name', 'tb_t_mahasiswa.year', 'tb_t_mahasiswa.start', 'tb_t_mahasiswa.finish', 'tb_t_mahasiswa.status')
        // ->get(); 
        return view('Mahasiswa/mahasiswa', ['mahasiswa' => $mahasiswa]);
        
        // SELECT users.name, dospem1.name, dospem2.name FROM tb_t_mahasiswa
        // JOIN users ON tb_t_mahasiswa.user_id=users.id
        // JOIN users AS dospem1 ON dospem1.id = tb_t_mahasiswa.dosen_id1
        // JOIN users AS dospem2 ON dospem2.id = tb_t_mahasiswa.dosen_id2;
    }

    public function create()
    {
        return view('Mahasiswa/create-mahasiswa');
    }
    public function createdata(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'title' => 'required',
            'dosen_id1' => 'required',
            'dosen_id2' => 'required',
            'year' => 'required',
            'start' => 'required',
            'finish' => 'required'

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

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        return view('Mahasiswa/edit-mahasiswa', ['mahasiswa' => $mahasiswa]);
    }


    public function update($id, Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'title' => 'required',
            'dosen_id1' => 'required',
            'dosen_id2' => 'required',
            'year' => 'required',
            'start' => 'required',
            'finish' => 'required'
        ]);

        $pegawai = Mahasiswa::find($id);
        $pegawai->user_id = $request->user_id;
        $pegawai->title = $request->title;
        $pegawai->dosen_id1 = $request->dosen_id1;
        $pegawai->dosen_id2 = $request->dosen_id2;
        $pegawai->year = $request->year;
        $pegawai->start = $request->start;
        $pegawai->finish = $request->finish;
        $pegawai->save();
        return redirect('/admin');
    }
    //delete data mahasiswa
    public function delete($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->delete();
        return redirect('/admin');
    }
    //

    public function Detail($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        return view('Mahasiswa/detail-mahasiswa', ['mahasiswa' => $mahasiswa]);
    }
    

}
