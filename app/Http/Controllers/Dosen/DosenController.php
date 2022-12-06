<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gambar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\File;

class DosenController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $mahasiswa = Mahasiswa::all();
        $mahasiswa = DB::select("SELECT tb_t_mahasiswa.id, tb_t_mahasiswa.title, tb_t_mahasiswa.year, users.name as mahasiswa, dospem1.name as dosen1, dospem2.name as dosen2, tb_t_mahasiswa.start,tb_t_mahasiswa.finish,tb_t_mahasiswa.status  FROM tb_t_mahasiswa
        JOIN users ON tb_t_mahasiswa.user_id=users.id
        JOIN users AS dospem1 ON dospem1.id = tb_t_mahasiswa.dosen_id1
        JOIN users AS dospem2 ON dospem2.id = tb_t_mahasiswa.dosen_id2 where tb_t_mahasiswa.dosen_id1 ='$id' or tb_t_mahasiswa.dosen_id2 = '$id'");
         
         // Data TTD
        $gambar = DB::table('tb_t_gambar')
        ->where('user_id', '=', $id)
        ->get();

         
        return view('Dosen/dosen', ['gambar' => $gambar,'mahasiswa' => $mahasiswa]);
    }


    public function proses_uploadbuktittd(Request $request)
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

    public function deletebuktittd($id){
		// hapus file
		$gambar = Gambar::where('id',$id)->first();
		File::delete('ttdfolder/'.$gambar->gbr);
 
		// hapus data
		Gambar::where('id',$id)->delete();
 
		return redirect()->back();
	}
}
