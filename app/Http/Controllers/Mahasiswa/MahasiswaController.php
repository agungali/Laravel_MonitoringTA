<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Gambar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class MahasiswaController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        //$mahasiswa = Mahasiswa::all();
        $mahasiswa = DB::select("SELECT tb_t_mahasiswa.nim, users.name as nama, tb_t_mahasiswa.title, tb_t_mahasiswa.year, users.name as mahasiswa, dospem1.name as dosen1, dospem2.name as dosen2, tb_t_mahasiswa.start,tb_t_mahasiswa.finish,tb_t_mahasiswa.status  FROM tb_t_mahasiswa
        JOIN users ON tb_t_mahasiswa.user_id=users.id
        JOIN users AS dospem1 ON dospem1.id = tb_t_mahasiswa.dosen_id1
        JOIN users AS dospem2 ON dospem2.id = tb_t_mahasiswa.dosen_id2 where tb_t_mahasiswa.user_id = '$id'");

        // $id = Auth::id();
        $gambar = DB::table('tb_t_gambar')
            ->where('user_id', '=', $id)
            ->get();
        return view('Mahasiswa/mahasiswa', ['gambar' => $gambar], ['mahasiswa' => $mahasiswa]);
    }

    public function create()
    {
        return view('Mahasiswa/create-mahasiswa');
    }
    public function createdata(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'nim' => 'required',
            'title' => 'required',
            'dosen_id1' => 'required',
            'dosen_id2' => 'required',
            'year' => 'required',
            'start' => 'required',
            'finish' => 'required'

        ]);

        Mahasiswa::create([
            'user_id' => $request->user_id,
            'nim' => $request->nim,
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
            'nim' => 'required',
            'title' => 'required',
            'dosen_id1' => 'required',
            'dosen_id2' => 'required',
            'year' => 'required',
            'start' => 'required',
            'finish' => 'required'
        ]);

        $pegawai = Mahasiswa::find($id);
        $pegawai->user_id = $request->user_id;
        $pegawai->nim = $request->nim;
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
        //$mahasiswaD = Mahasiswa::find($id);

        $mahasiswa = DB::select("SELECT tb_t_mahasiswa.nim as nim, users.name as nama, tb_t_mahasiswa.title, tb_t_mahasiswa.year, users.name as mahasiswa, dospem1.name as dosen1, dospem2.name as dosen2, tb_t_mahasiswa.start,tb_t_mahasiswa.finish,tb_t_mahasiswa.status  FROM tb_t_mahasiswa
        JOIN users ON tb_t_mahasiswa.user_id=users.id
        JOIN users AS dospem1 ON dospem1.id = tb_t_mahasiswa.dosen_id1
        JOIN users AS dospem2 ON dospem2.id = tb_t_mahasiswa.dosen_id2 where tb_t_mahasiswa.id = $id");

        return view('Mahasiswa/detail-mahasiswa', ['mahasiswa' => $mahasiswa]);
    }
    public function proses_uploadbukti(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');

        $nama_file = time() . "_" . $file->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'ttdfolder';
        $file->move($tujuan_upload, $nama_file);
        $id = Auth::id();
        Gambar::create([
            'user_id' => $id,
            'gbr' => $nama_file,
        ]);

        // return redirect("{{ route('mahasiswa') }}");

        return redirect()->back();
    }

    public function deletebukti($id){
		// hapus file
		$gambar = Gambar::where('id',$id)->first();
		File::delete('ttdfolder/'.$gambar->gbr);
 
		// hapus data
		Gambar::where('id',$id)->delete();
 
		return redirect()->back();
	}
}
