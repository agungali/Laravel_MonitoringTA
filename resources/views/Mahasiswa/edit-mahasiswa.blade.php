@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card mt-5">
        <div class="card-header text-center">
            CRUD Data Pegawai - <strong>EDIT DATA</strong>
        </div>
        <div class="card-body">
            <a href="/mahasiswa" class="btn btn-primary">Kembali</a>
            <br />
            <br />
            <form method="post" action="/mahasiswa/update/{{ $mahasiswa->id }}">

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label>Id</label>
                    <input type="text" name="user_id" class="form-control" placeholder="Judul Tugas Akhir .." value=" {{ $mahasiswa->user_id }}"></input>
                    @if($errors->has('user_id'))
                    <div class="text-danger">
                        {{ $errors->first('user_id')}}
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>NIM</label>
                    <input type="text" name="nim" class="form-control" placeholder="Nomor Induk Mahasiswa .." value=" {{ $mahasiswa->user_id }}"></input>
                    @if($errors->has('nim'))
                    <div class="text-danger">
                        {{ $errors->first('nim')}}
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Judul Tugas Akhir</label>
                    <textarea type="text" name="title" class="form-control" placeholder="Judul Tugas Akhir ..">{{ $mahasiswa->title }}</textarea>
                    @if($errors->has('title'))
                    <div class="text-danger">
                        {{ $errors->first('title')}}
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Dosen Pertama</label>
                    <input type="text" name="dosen_id1" class="form-control" placeholder="Dosen Pertama.." value=" {{ $mahasiswa->dosen_id1 }}">
                    @if($errors->has('dosen_id1'))
                    <div class="text-danger">
                        {{ $errors->first('dosen_id1')}}
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Dosen Kedua</label>
                    <input type="text" name="dosen_id2" class="form-control" placeholder="Dosen Kedua .." value=" {{ $mahasiswa->dosen_id2 }}">
                    @if($errors->has('dosen_id2'))
                    <div class="text-danger">
                        {{ $errors->first('dosen_id2')}}
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Angkatan</label>
                    <input type="" name="year" class="form-control" placeholder="Angkatan .." value=" {{ $mahasiswa->year }}">
                    @if($errors->has('year'))
                    <div class="text-danger">
                        {{ $errors->first('year')}}
                    </div>
                    @endif
                </div>
               <div class="form-group">
                    <label>Tanggal Mulai Tugas Akhir</label>
                    <input type="" name="start" class="form-control" placeholder="Tanggal Mulai Tugas Akhir .." value=" {{ $mahasiswa->start }}">
                    @if($errors->has('start'))
                    <div class="text-danger">
                        {{ $errors->first('start')}}
                    </div>
                    @endif
                </div>
                 <div class="form-group">
                    <label>Tanggal Berakhir Tugas AKhir</label>
                    <input type="" name="finish" class="form-control" placeholder="Tanggal Mulai Tugas Akhir .." value=" {{ $mahasiswa->finish }}">
                    @if($errors->has('finish'))
                    <div class="text-danger">
                        {{ $errors->first('finish')}}
                    </div>
                    @endif
                </div><br>

                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>

            </form>

        </div>
    </div>
</div>

@endsection