@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard Mahasiswa') }}</div>
                <div class="card-body">
                    <a href="/mahasiswa/create" class="btn btn-primary">Input Pegawai Baru</a><br><br>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <strong> Tugas Akhir</strong>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                @foreach($mahasiswa as $p)
                                <div class="accordion-body">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>NIM</td>
                                                <td>: {{ $p->nim }}</td>
                                            </tr>
                                            <tr>
                                                <td>Dosen Pembimbing 1</td>
                                                <td>: {{ $p->dosen1 }}</td>
                                            </tr>
                                            <tr>
                                                <td>Dosen Pembimbing 2</td>
                                                <td>: {{ $p->dosen2 }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tahun</td>
                                                <td>: {{ $p->year }}</td>
                                            </tr>
                                            <tr>
                                                <td>Judul</td>
                                                <td>: {{ $p->title }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Mulai</td>
                                                <td>: {{ $p->start }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Berakhir</td>
                                                <td>: {{ $p->finish }}</td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>: {{ $p->status }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} -->

                    <div class="card-body">
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
                                        <td>{{ $p->dosen1 }}</td>
                                        <td>{{ $p->dosen2 }}</td>
                                        <td>{{ $p->start }}</td>
                                        <td>{{ $p->finish }}</td>
                                        <td>{{ $p->status }}</td>
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
@endsection