@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Manage Users</h1>
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<a href="" class="btn btn-primary">Tambah User</a>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="users" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Email</th>
							<th>Roles</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@if($users->count() > 0)
						@foreach($users as $key => $value)
						<tr>
							<td>{{$key+1}}</td>
							<td>{{$value->name}}</td>
							<td>{{$value->email}}</td>
							<td>{{$value->getRoleNames()[0]}}</td>
							<td width="20%">
								<a href="" class="btn btn-success">View</a>
								<a href="" class="btn btn-warning">Edit</a>
								<a href="" class="btn btn-danger">Delete</a>
							</td>
						</tr>
						@endforeach
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
	@stop

	@section('css')
	<link rel="stylesheet" href="/css/admin_custom.css">
	<link rel="stylesheet"
		href="https://adminlte.io/themes/dev/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
	@stop

	@section('js')
	<script src="https://adminlte.io/themes/dev/AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
	<script src="https://adminlte.io/themes/dev/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
	<script>
		$(function () {
			$('#users').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": true,
				"ordering": true,
				"info": true,
				"autoWidth": true,
			});
		});
	</script>
	@stop