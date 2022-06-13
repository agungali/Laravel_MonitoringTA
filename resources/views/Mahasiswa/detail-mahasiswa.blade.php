@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card mt-5">
        <div class="card-header text-center">
            CRUD Data Pegawai - <strong>Detail DATA</strong>
        </div>
        <div class="card-body">
            <a href="/mahasiswa" class="btn btn-primary">Kembali</a>
            <br />
            <br />
            <label>Nama: {{ Auth::user()->name }}</label><br>
            <label>Judul : {{ $mahasiswa->title }}</label>
            <label>Dosen 1 : {{ $mahasiswa->dosen_id1 }}</label>
            <label>Dosen 2 : {{ $mahasiswa->dosen_id2 }}</label>
            <label>Start : {{ $mahasiswa->start}}</label>
            <label>Finish : {{ $mahasiswa->finish}}</label>
            <label>Status : {{ $mahasiswa->status}}</label>
        </div>
    </div>
</div>

@endsection