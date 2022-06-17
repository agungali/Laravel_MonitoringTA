@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card mt-5">
        <div class="accordion-body">
            <div class="pd-20">
                <h4 class="text-blue h4">Detail Mahasiswa</h4>
            </div>
            <table class="table">
                <tbody>
                @foreach($mahasiswa as $m)
                    <tr>
                        <td>NIM</td>
                        <td>: {{ $m->nim }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $m->nama }}</td>
                    </tr>
                    <tr>
                        <td>Dosen Pembimbing 1</td>
                        <td>: {{ $m->dosen1 }}</td>

                    </tr>
                    <tr>
                        <td>Dosen Pembimbing 2</td>
                        <td>: {{ $m->dosen2 }}</td>
                    </tr>

                    <tr>
                        <td>Tahun</td>
                        <td>: {{ $m->year }}</td>
                    </tr>
                    <tr>
                        <td>Judul</td>
                        <td>: {{ $m->title }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Mulai</td>
                        <td>: {{ date('d-m-Y', strtotime($m->start)) }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Berakhir</td>
                        <td>: {{ date('d-m-Y', strtotime($m->finish)) }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>: {{ $m->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection