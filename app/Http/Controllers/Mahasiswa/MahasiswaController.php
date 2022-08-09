<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Gambar;
use App\Models\Bimbingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class MahasiswaController extends Controller
{
    public function index()
    {
        //DataMahasiswa
        $id = Auth::id();
        //$mahasiswa = Mahasiswa::all();
        $mahasiswa = DB::select("SELECT tb_t_mahasiswa.nim, users.name as nama, tb_t_mahasiswa.title, tb_t_mahasiswa.year, users.name as mahasiswa, dospem1.name as dosen1, dospem2.name as dosen2, tb_t_mahasiswa.start,tb_t_mahasiswa.finish,tb_t_mahasiswa.status,tb_t_mahasiswa.dosen_id1,tb_t_mahasiswa.dosen_id2  FROM tb_t_mahasiswa
        JOIN users ON tb_t_mahasiswa.user_id=users.id
        JOIN users AS dospem1 ON dospem1.id = tb_t_mahasiswa.dosen_id1
        JOIN users AS dospem2 ON dospem2.id = tb_t_mahasiswa.dosen_id2 where tb_t_mahasiswa.user_id = '$id'");

        // Data TTD
        $gambar = DB::table('tb_t_gambar')
            ->where('user_id', '=', $id)
            ->get();


        //Data Bimbingan
        $bimbingan  = DB::select("SELECT tb_t_bimbingan.id, tb_t_bimbingan.user_id, tb_t_bimbingan.dospem, tb_t_bimbingan.tanggal, 
        tb_t_bimbingan.data, tb_t_bimbingan.status_bimbingan, users.name FROM tb_t_bimbingan JOIN users on tb_t_bimbingan.dospem = users.id 
        where tb_t_bimbingan.user_id = '$id'");
        // $bimbingan = DB::table('tb_t_bimbingan')
        // ->where('user_id', '=', $id)
        // ->get();

        //Get Dosen

        $dosen = DB::table('users')
        ->where('role', '=', 'dosen')
        ->get();

        return view('Mahasiswa/mahasiswa', ['gambar' => $gambar,'mahasiswa' => $mahasiswa, 'bimbingan' => $bimbingan, 'dosen' => $dosen]);
    }

    public function create()
    {
        //Get Dosen

        $dosen = DB::table('users')
        ->where('role', '=', 'dosen')
        ->get();

        return view('Mahasiswa/create-mahasiswa', ['dosen' => $dosen]);
    }
    public function createdata(Request $request)
    {
        $id = Auth::id();
        $this->validate($request, [
            'nim' => 'required',
            'title' => 'required',
            'dosen_id1' => 'required',
            'dosen_id2' => 'required',
            'year' => 'required',
            'start' => 'required',
            'finish' => 'required'

        ]);

        Mahasiswa::create([
            'user_id' => $id,
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
        $bimbingan = Bimbingan::find($id);
        return view('Mahasiswa/edit-mahasiswa', ['mahasiswa' => $bimbingan]);
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



    //Data Bimbingan
    public function create_data_bimbingan(Request $request)
    {
        $id = Auth::id();
        $this->validate($request, [
            'dospem' => 'required',
            'tanggal' => 'required',
            'data' => 'required'

        ]);

        Bimbingan::create([
            'user_id' => $id,
            'dospem' => $request->dospem,
            'tanggal' => $request->tanggal,
            'data' => $request->data,
            'status_bimbingan' => 'Invalid'
        ]);
        return redirect('/mahasiswa');
    }
    //Update Bimbingan
    public function update_bimbingan($id, Request $request)
    {
        $this->validate($request, [
            'tanggal' => 'required',
            'dospem' => 'required',
            'data' => 'required'
        ]);

        $bimbingan = Bimbingan::find($id);
        $bimbingan->tanggal = $request->tanggal;
        $bimbingan->dospem = $request->dospem;
        $bimbingan->data = $request->data;
        $bimbingan->status_bimbingan = $request->status_bimbingan;
        $bimbingan->save();
        return redirect('/mahasiswa');
    }

    //delete data mahasiswa
    public function delete_bimbingan($id)
    {
        $bimbingan = Bimbingan::find($id);
        $bimbingan->delete();
        return redirect('/mahasiswa');
    }
    //

    //End Data Bimbingan
}
