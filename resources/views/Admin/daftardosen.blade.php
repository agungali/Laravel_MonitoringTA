@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Home Admin') }}</div>

                <div class="card-body">
                    <!-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} -->

                    <div class="card-body">
                        @if (Auth::user()->role == 'mahasiswa')
                        <a href="/mahasiswa/tambah" class="btn btn-primary">Input Pegawai Baru</a>
                        <br />
                        @else
                        @endif
                        <br />
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped ">
                                <thead>
                                    <tr>
                                        <th>NIM/NIP</th>
                                        <th>Nama</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getdosen as $d)
                                    <tr>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->email }}</td>
                                        <td></td>
                                        <td></td>
                                        
                                        <td>
                                            <a href="/mahasiswa/detail/{{ $d->id }}" class="btn btn-secondary">Details</a>
                                            <a href="/mahasiswa/edit/{{ $d->id }}" class="btn btn-warning">Edit</a>
                                            <a href="/mahasiswa/delete/{{ $d->id }}" class="btn btn-danger">Hapus</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endsection