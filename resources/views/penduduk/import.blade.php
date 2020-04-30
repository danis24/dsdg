@extends('adminlte::page')

@section('title', 'Import Penduduk')

@section('content_header')
<h1>Import Penduduk</h1>
@stop

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Import Data Penduduk</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form method="POST" action="{{ route('penduduk.importExcel') }}" enctype="multipart/form-data">
        @csrf
        <div class=" card-body">
			<p>Untuk Melakukan Import Penduduk Mohon untuk download template terlebih dahulu disini : <a href="{{url('/file_penduduk/template/Template_import_penduduk.xlsx')}}">Template Import</a></p>
			<label>Pilih file excel</label>
			<div class="form-group">
				<input type="file" name="file" required="required">
			</div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Import</button>
        </div>
      </form>
    </div>
  </div>
  @stop

  @section('css')
  @stop

  @section('js')
  @stop