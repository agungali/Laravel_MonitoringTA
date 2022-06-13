@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard Mahasiswa') }}</div>

                <div class="card-body">
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
                                        <th>Title</th>
                                        <th>Year</th>
                                        <th>Dosen Pembimbing 1</th>
                                        <th>Dosen Pembimbing 2</th>
                                        <th>Start</th>
                                        <th>Finish</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mahasiswa as $p)
                                    <tr>
                                        <td>{{ $p->title }}</td>
                                        <td>{{ $p->year }}</td>
                                        <td>{{ $p->dospem1 }}</td>
                                        <td>{{ $p->dospem2 }}</td>
                                        <td>{{ $p->start }}</td>
                                        <td>{{ $p->finish }}</td>
                                        <td>{{ $p->status }}</td>
                                        <td>
                                            <a href="/mahasiswa/edit/{{ $p->id }}" class="btn btn-warning">Edit</a>
                                            <a href="/mahasiswa/hapus/{{ $p->id }}" class="btn btn-danger">Hapus</a>
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
</div>


<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection