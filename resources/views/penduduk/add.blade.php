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
        <h3 class="card-title">Tambah Data Penduduk</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form method="POST" actions="{{ route('penduduk.store') }}" enctype="multipart/form-data">
        @csrf
        <div class=" card-body">
          <div class="form-group">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" placeholder="NIK">
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" placeholder="Nama">
          </div>
          <div class="form-group">
            <label>Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir">
          </div>
          <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control">
          </div>
          <div class="form-group">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control">
              <option value="L">Laki - Laki</option>
              <option value="P">Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <label>Agama</label>
            <select type="text" name="agama" class="form-control">
              <option value="islam">Islam</option>
              <option value="hindu">Hindu</option>
              <option value="katolik">Katolik</option>
              <option value="protestan">Protestan</option>
              <option value="budha">Budha</option>
              <option value="konghucu">Konghucu</option>
            </select>
          </div>
          <div class="form-group">
            <label>Status Kawin</label>
            <select name="status_perkawinan" class="form-control">
              <option value="kawin">Kawin</option>
              <option value="belum_kawin">Belum Kawin</option>
            </select>
          </div>
          <div class="form-group">
            <label>Pekerjaan</label>
            <input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan">
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" rows="5" placeholder="Alamat .."></textarea>
          </div>
          <div class="form-group">
            <label>RT</label>
            <input type="text" name="rt" class="form-control" placeholder="RT">
          </div>
          <div class="form-group">
            <label>RW</label>
            <input type="text" name="rw" class="form-control" placeholder="RW">
          </div>
          <div class="form-group">
            <label>Umur</label>
            <input type="text" name="umur" class="form-control" placeholder="Umur">
          </div>
          <div class="form-group">
            <label for="">Foto</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" name="image" class="custom-file-input">
                <label class="custom-file-label">Choose file</label>
              </div>
              <div class="input-group-append">
                <span class="input-group-text" id="">Upload</span>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
  @stop

  @section('css')
  @stop

  @section('js')
  @stop