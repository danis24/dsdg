@extends('adminlte::page')

@section('title', 'Tambah Penduduk')

@section('content_header')
<h1>Penduduk</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Data Penduduk</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" actions="" enctype="multipart/form-data">
                @csrf
                <div class=" card-body">
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control" placeholder="NIK"
                            value="{{ $penduduk->nik }}">
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama"
                            value="{{ $penduduk->nama }}">
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir"
                            value="{{$penduduk->tempat_lahir}}">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control"
                            value="{{$penduduk->tanggal_lahir}}">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="L" @if($penduduk->jenis_kelamin == "L")
                                selected
                                @endif
                                >Laki - Laki</option>
                            <option value="P" @if($penduduk->jenis_kelamin == "P")
                                selected
                                @endif
                                >Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Agama</label>
                        <select type="text" name="agama" class="form-control">
                            <option value="islam" @if($penduduk->agama == "islam")
                                selected
                                @endif
                                >Islam</option>
                            <option value="hindu" @if($penduduk->agama == "hindu")
                                selected
                                @endif
                                >Hindu</option>
                            <option value="katolik" @if($penduduk->agama == "katolik")
                                selected
                                @endif
                                >Katolik</option>
                            <option value="protestan" @if($penduduk->agama == "protestan")
                                selected
                                @endif
                                >Protestan</option>
                            <option value="budha" @if($penduduk->agama == "budha")
                                selected
                                @endif
                                >Budha</option>
                            <option value="konghucu" @if($penduduk->agama == "konghucu")
                                selected
                                @endif
                                >Konghucu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status Kawin</label>
                        <select name="status_perkawinan" class="form-control">
                            <option value="kawin" @if($penduduk->status_kawin == "kawin")
                                selected
                                @endif
                                >Kawin</option>
                            <option value="belum_kawin" @if($penduduk->status_kawin == "belum_kawin")
                                selected
                                @endif
                                >Belum Kawin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pekerjaan</label>
                        <input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan"
                            value="{{ $penduduk->pekerjaan }}">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="5"
                            placeholder="Alamat ..">{{ $penduduk->alamat }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>RT</label>
                        <input type="text" name="rt" class="form-control" placeholder="RT" value="{{ $penduduk->rt }}">
                    </div>
                    <div class="form-group">
                        <label>RW</label>
                        <input type="text" name="rw" class="form-control" placeholder="RW" value="{{ $penduduk->rw }}">
                    </div>
                    <div class="form-group">
                        <label>Umur</label>
                        <input type="text" name="umur" class="form-control" placeholder="Umur"
                            value="{{ $penduduk->umur }}">
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
    @stop

    @section('css')
    @stop

    @section('js')
    @stop