@extends('adminlte::page')

@section('title', 'Update Foto Penduduk')

@section('content_header')
<h1>Update Foto Penduduk</h1>
@stop

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Update Foto Penduduk</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form method="POST" action="{{ url('/penduduk/image') }}/{{$id}}" enctype="multipart/form-data">
        @csrf
        <div class=" card-body">
			<label>Pilih Foto</label>
			<div class="form-group">
				<input type="file" name="foto" required="required">
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