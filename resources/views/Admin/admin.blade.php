@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-body">
        @if (Auth::user()->role == 'mahasiswa')
        <a href="/mahasiswa/tambah" class="btn btn-primary">Input Pegawai Baru</a>
        <br />
        @else
        @endif
    </div>
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">Home</h4>
            <p class="mb-0">Data Mahasiswa</p>
        </div>
        <div class="pb-20 table-responsive">
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Bukti Daftar</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($mahasiswa as $p)
                    <tr>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->status }}</td>
                        <td></td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item" href="/mahasiswa/detail/{{ $p->id }}"><i class="dw dw-eye"></i> View</a>
                                    <a class="dropdown-item" href="/mahasiswa/edit/{{ $p->id }}"><i class="dw dw-edit2"></i> Edit</a>
                                    <a class="dropdown-item" href="/mahasiswa/delete/{{ $p->id }}"><i class="dw dw-delete-3"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Home Admin') }}</div>

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
    </div> -->
@endsection