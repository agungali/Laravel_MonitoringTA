<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gambar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TtdController extends Controller
{
    
	public function uploadttd(){
		$id = Auth::id();
		$gambar = DB::table('tb_t_gambar')
		->where('id', '=', $id)
		->get();
		return view('Mahasiswa/mahasiswa',['gambar' => $gambar]);
	}
	public function proses_uploadttd(Request $request){
		$this->validate($request, [
            'user_id' => 'required',
			'file' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
			
		]);
 
		// menyimpan data file yang diupload ke variabel $file
		$file = $request->file('file');
 
		$nama_file = time()."_".$file->getClientOriginalName();
 
      	        // isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'ttdfolder';
		$file->move($tujuan_upload,$nama_file);
		$id = Auth::id();
		Gambar::create([
			'user_id'=>$id,
			'file' => $nama_file,
		]);

		return redirect('Auth/profile');
 
		//return redirect()->back();
	}
}
