@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard Mahasiswa') }}</div>
                <div class="card-body">
                    @if (empty($mahasiswa))
                    <a href="/mahasiswa/create" class="btn btn-primary">Input Pegawai Baru</a><br><br>
                    @endif
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
                                                <td>: {{date('d-m-Y', strtotime($p->start))}}</td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Berakhir</td>
                                                <td>: {{date('d-m-Y', strtotime($p->finish))}}</td>
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

                    {{ __('You are logged in!') }} --><br>
                    <div class="card">
                        <div class="card-body">
                            @if (!empty($mahasiswa))
                            <a data-bs-toggle="modal" data-bs-target="#DataBimbinganModal" href="" class="btn btn-primary">Input Data Bimbingan</a><br><br>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped ">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Dospem</th>
                                            <th>Tema Bimbingan</th>
                                            <th>Status Bimbingan</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bimbingan as $b)
                                        <tr>
                                            <td>{{date('d-m-Y', strtotime($b->tanggal))}}</td>
                                            <td>{{ $b->name }}</td>
                                            <td>{{ $b->data }}</td>
                                            <td>{{ $b->status_bimbingan }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                        <i class="dw dw-more"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                        <a data-bs-toggle="modal" class="dropdown-item" data-bs-target="#UpdateDataBimbinganModal{{$b->id}}"><i class="dw dw-edit2"></i> Edit</a>
                                                        <a class="dropdown-item" href="/mahasiswa/delete_bimbingan/{{ $b->id }}"><i class="dw dw-delete-3"></i> Delete</a>
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
                                        <form action="{{ route('proses_uploadbukti') }}" id="uploadgbr-form" method="POST" enctype="multipart/form-data">
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
                                    <button type="button" class="btn btn-primary" href="{{ route('proses_uploadbukti') }}" onclick="event.preventDefault(); document.getElementById('uploadgbr-form').submit();">Save changes</button>
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
                                    <h5 class="modal-title" id="exampleModalLabelview"> Bukti Daftar</h5>
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
                    <!-- Modal Data Bimbingan -->
                    <!-- ModalCreateDataBimbingan -->
                    <div class="modal fade" id="DataBimbinganModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Bimbingan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <form action="{{ route('create_data_bimbingan') }}" id="submit_data_bimbingan" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label>Tanggal Bimbingan</label>
                                                <input type="date" name="tanggal" class="form-control" placeholder="Judul Tugas Akhir .."></input>
                                                @if($errors->has('tanggal'))
                                                <div class="text-danger">
                                                    {{ $errors->first('tanggal')}}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label>Dosen Pembimbing</label>
                                                @foreach($mahasiswa as $p)
                                                <select name="dospem" class="form-select" aria-label="Default select example">
                                                    <option selected>Open this select menu</option>
                                                    <option value="{{ $p->dosen_id1 }}">{{ $p->dosen1 }}</option>
                                                    <option value="{{ $p->dosen_id2 }}">{{ $p->dosen2 }}</option>
                                                </select>
                                                @endforeach
                                                <!-- <input type="text" name="dospem" class="form-control" placeholder="Dosen Pembimbing .."></input> -->
                                                @if($errors->has('dospem'))
                                                <div class="text-danger">
                                                    {{ $errors->first('dosepem')}}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label>Materi Bimbingan</label>
                                                <textarea type="text" name="data" class="form-control" placeholder="Materi Bimbingan .."></textarea>
                                                @if($errors->has('data'))
                                                <div class="text-danger">
                                                    {{ $errors->first('data')}}
                                                </div>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" href="{{ route('create_data_bimbingan') }}" onclick="event.preventDefault(); document.getElementById('submit_data_bimbingan').submit();">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- EndModalCreateDataBimbingan -->

                    <!-- ModalUpdateDataBimbingan -->
                    @foreach($bimbingan as $b)
                    <div class="modal fade" id="UpdateDataBimbinganModal{{$b->id}}" href="/mahasiswa/edit_bimbingan/{{ $b->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
                    <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Bimbingan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <form action="/mahasiswa/edit_bimbingan/{{$b->id}}" id="submit_update_data_bimbingan" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <div class="form-group">
                                                <label>Tanggal Bimbingan</label>
                                                <input type="date" name="tanggal" class="form-control" placeholder="Judul Tugas Akhir .." value="{{$b->tanggal}}"></input>
                                                @if($errors->has('tanggal'))
                                                <div class="text-danger">
                                                    {{ $errors->first('tanggal')}}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label>Dosen Pembimbing</label>
                                                @foreach($mahasiswa as $p)
                                                <select name="dospem" class="form-select" aria-label="Default select example">
                                                    <option selected value="{{$b->dospem}}">Open this select menu</option>
                                                    <option value="{{ $p->dosen_id1 }}">{{ $p->dosen1 }}</option>
                                                    <option value="{{ $p->dosen_id2 }}">{{ $p->dosen2 }}</option>
                                                </select>
                                                @endforeach
                                                <!-- <input type="text" name="dospem" class="form-control" placeholder="Dosen Pembimbing .."></input> -->
                                                @if($errors->has('dospem'))
                                                <div class="text-danger">
                                                    {{ $errors->first('dosepem')}}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label>Materi Bimbingan</label>
                                                <textarea type="text" name="data" class="form-control" placeholder="Materi Bimbingan ..">{{$b->data}}</textarea>
                                                @if($errors->has('data'))
                                                <div class="text-danger">
                                                    {{ $errors->first('data')}}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="form-group" hidden>
                                                <label>Status Bimbingan</label>
                                                <input type="text" name="status_bimbingan" class="form-control" value="{{$b->status_bimbingan}}" placeholder="Status Bimbingan"></input>
                                                @if($errors->has('data'))
                                                <div class="text-danger">
                                                    {{ $errors->first('data')}}
                                                </div>
                                                @endif
                                            </div>
                                           
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <!-- <button type="submit" href="/mahasiswa/edit_bimbingan/{{$b->id}}" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button> -->
                                    <button type="button" class="btn btn-primary" href="/mahasiswa/edit_bimbingan/{{$b->id}}" onclick="event.preventDefault(); document.getElementById('submit_update_data_bimbingan').submit();">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- EndModalUpdateDataBimbingan -->

                    <!-- End Data Bimbingan -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- @dump($bimbingan) -->