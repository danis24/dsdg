@extends('adminlte::page')

@section('title', 'List Penduduk')

@section('content_header')
<h1>List Penduduk</h1>
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<a href="{{ url('/penduduk/add') }}" class="btn btn-primary">Tambah Penduduk</a>
				<a href="{{ url('/penduduk/import') }}" class="btn btn-success">Import Penduduk</a>
				<a href="{{ url('/penduduk/export') }}" class="btn btn-warning">Import Penduduk</a>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="penduduk" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="5%">No</th>
							<th>Foto</th>
							<th>NIK</th>
							<th>Nama</th>
							<th>Umur</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@if($penduduk->count() > 0)
						@foreach($penduduk as $key => $value)
						<tr>
							<td>{{$key+1}}</td>
							<td>
								<img class="profile-user-img img-fluid img-circle"
									src="{{url('images')}}/{{$value->foto}}" style="width: 60px;">
							</td>
							<td>{{$value->nik}}</td>
							<td>{{$value->nama}}</td>
							<td>{{$value->umur}} Tahun</td>
							<td width="20%">
								<a href="{{url('/penduduk/detail')}}/{{$value->id}}" class="btn btn-success">View</a>
								<a href="{{url('/penduduk/edit')}}/{{$value->id}}" class="btn btn-warning">Edit</a>
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
			$('#penduduk').DataTable({
				"paging": true, "lengthChange": false, "searching": true, "ordering": true, "info": true, "autoWidth": true,
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
						url: "{{url('/penduduk/delete')}}",
						data: {
							"_token": "{{ csrf_token() }}",
							"id": id
						},
						success: function (data) {
							if (data.status == "success") {
								window.location.href = "/penduduk";
							}
						}
					});
				}
			})
		});
	</script>
	@stop