@extends('adminlte::page')

@section('title', 'Tambah Users')

@section('content_header')
<h1>Users</h1>
@stop

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Tambah Data User</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form method="POST" actions="{{ route('user.store') }}">
        @csrf
        <div class=" card-body">
          <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" placeholder="Nama">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password">
          </div>
          <div class="form-group">
            <label>Roles</label>
            <select name="role" class="form-control">
            @if($roles->count() > 0)
            @foreach($roles as $key => $value)
              <option value="{{ $value->name }}">{{ $value->name }}</option>
            @endforeach
            @endif
            </select>
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