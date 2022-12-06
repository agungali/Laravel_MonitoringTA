@extends('layouts.app')

@section('content')
<div class="container">
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
                        <td>{{ $p->mahasiswa }}</td>
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
        <!-- ModalUpload -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Daftar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <form action="{{ route('proses_uploadbuktittd') }}" id="uploadgbr-form" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="col-md-6">
                                    <input type="file" name="file" />
                                    @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- <input type="submit" value="Upload" class="btn btn-primary"> -->
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" href="{{ route('proses_uploadbuktittd') }}" onclick="event.preventDefault(); document.getElementById('uploadgbr-form').submit();">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- EndModalUpload -->
        <!-- ModalView -->
        <div class="modal fade" id="exampleModalview" tabindex="-1" aria-labelledby="exampleModalLabelview" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelview"> Tanda Tangan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    @foreach($gambar as $g)
                    <div class="modal-body">
                        <div class="row mb-3">
                            <tbody>

                                <tr>
                                    <td><img width="100%" src="{{ url('/ttdfolder/'.$g->gbr) }}"></td>
                                </tr>

                            </tbody>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-danger" href="/mahasiswa/hapus/{{ $g->id }}"><i class="dw dw-delete-3"></i> Delete</a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- EndModalView -->
    </div>
</div>
@endsection