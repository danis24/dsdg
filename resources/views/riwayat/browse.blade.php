@extends('adminlte::page')

@section('title', 'Riwayat Pengajuan')

@section('content_header')
<h1>Riwayat Pengajuan</h1>
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<!-- /.card-header -->
			<div class="card-body">
				@if(session()->has('success'))
				<div class="alert alert-success">
					{{ session()->get('success') }}
				</div>
				@endif
				@if(session()->has('failed'))
				<div class="alert alert-danger">
					{{ session()->get('failed') }}
				</div>
				@endif
				<table id="users" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Penduduk</th>
							<th>Nama Pengajuan</th>
							<th>Tanggal Pengajuan</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						@if($riwayat->count() > 0)
						@foreach($riwayat as $key => $value)
						<tr>
							<td>{{$key+1}}</td>
							<td>{{$value->Penduduk->nama}}</td>
							<td>{{$value->nama_pengajuan}}</td>
							<td>{{$value->created_at}}</td>
							<td>
								@if($value->status == 0)
								<span class="badge badge-warning" role="alert">
									Belum Di Print
								</span>
								@endif
								@if($value->status == 1)
								<span class="badge badge-success" role="alert">
									Sudah di Print
								</span>
								@endif
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
	</script>
	@stop