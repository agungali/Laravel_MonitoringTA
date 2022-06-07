@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-5">
        <div class="card-header text-center">
            Data Mahasiswa - <strong>TAMBAH DATA</strong>
        </div>
        <div class="card-body">
            <a href="/mahasiswa" class="btn btn-primary">Kembali</a>
            <br />
            <br />

            <form action="{{ route('createdata') }}" method="post" >

                {{ csrf_field() }}

                <!-- <div class="form-group">
                    <label>Nama</label>
                    <label name="nama" class="form-control">{{ Auth::user()->name }}</label>

                    @if($errors->has('nama'))
                    <div class="text-danger">
                        {{ $errors->first('nama')}}
                    </div>
                    @endif

                </div> -->
                <div class="form-group">
                    <label>Id</label>
                    <input type="text" name="user_id" class="form-control" placeholder="Judul Tugas Akhir .."></input>
                    @if($errors->has('user_id'))
                    <div class="text-danger">
                        {{ $errors->first('user_id')}}
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Judul Tugas Akhir</label>
                    <textarea type="text" name="title" class="form-control" placeholder="Judul Tugas Akhir .."></textarea>
                    @if($errors->has('title'))
                    <div class="text-danger">
                        {{ $errors->first('title')}}
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Dosen Pertama</label>
                    <input type="text" name="dosen_id1" class="form-control" placeholder="Dosen Pertama..">
                    @if($errors->has('dosen_id1'))
                    <div class="text-danger">
                        {{ $errors->first('dosen_id1')}}
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Dosen Kedua</label>
                    <input type="text" name="dosen_id2" class="form-control" placeholder="Dosen Kedua ..">
                    @if($errors->has('dosen_id2'))
                    <div class="text-danger">
                        {{ $errors->first('dosen_id2')}}
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Angkatan</label>
                    <input type="number" name="year" class="form-control" placeholder="Angkatan ..">
                    @if($errors->has('year'))
                    <div class="text-danger">
                        {{ $errors->first('year')}}
                    </div>
                    @endif
                </div>
               <div class="form-group">
                    <label>Tanggal Mulai Tugas Akhir</label>
                    <input type="date" name="start" class="form-control" placeholder="Tanggal Mulai Tugas Akhir ..">
                    @if($errors->has('year'))
                    <div class="text-danger">
                        {{ $errors->first('year')}}
                    </div>
                    @endif
                </div>
                 <div class="form-group">
                    <label>Tanggal Berakhir Tugas AKhir</label>
                    <input type="date" name="finish" class="form-control" placeholder="Tanggal Mulai Tugas Akhir ..">
                    @if($errors->has('year'))
                    <div class="text-danger">
                        {{ $errors->first('year')}}
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