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
				<a href="{{url('/users/add')}}" class="btn btn-primary">Tambah User</a>
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
								<a href="{{ url('/users')}}/{{$value->id}}" class="btn btn-success">View</a>
								<a href="{{ url('/users/edit')}}/{{$value->id}}" class="btn btn-warning">Edit</a>
								<a href="#" class="btn btn-danger" data-id="{{$value->id}}" id="deleteButton">Delete</a>
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
	@stop

	@section('js')
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

		$(document).on('click', '#deleteButton', function (e) {
			e.preventDefault();
			var id = $(this).data('id');
			Swal.fire({
				title: 'Are you sure?',
				text: 'You will not be able to recover this imaginary file!',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Yes, delete it!',
				cancelButtonText: 'No, keep it'
			}).then((result) => {
				if (result.value) {
					$.ajax({
						type: "POST",
						url: "{{url('/users/delete')}}",
						data: {
							"_token": "{{ csrf_token() }}",
							"id": id
						},
						success: function (data) {
							if (data.status == "success") {
								window.location.href = "/users";
							}
						}
					});
				}
			})
		});
	</script>
	@stop
