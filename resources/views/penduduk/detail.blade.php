@extends('adminlte::page')

@section('title', 'Detail Penduduk')

@section('content_header')
<h1>Detail Penduduk</h1>
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Detail Penduduk</h3>
			</div>
			<div class="card-body">
				<div class="card card-primary card-outline">
					<div class="card-body box-profile">
						<div class="text-center">
							<img class="profile-user-img img-fluid img-circle"
								src="{{url('/images')}}/{{$penduduk->foto}}">
						</div>

						<h3 class="profile-username text-center">{{$penduduk->nama}}</h3>

						<p class="text-muted text-center"><b>NIK :</b> {{ $penduduk->nik }}</p>
						<p class="text-muted text-center"><b>Umur :</b> {{ $penduduk->umur }} Tahun</p>
						<p class="text-muted text-center"><b>Jenis Kelamin :</b>
							@if($penduduk->jenis_kelamin == "L")
							Laki - Laki
							@endif
							@if($penduduk->jenis_kelamin == "P")
							Perempuan
							@endif</p>
						<p class="text-muted text-center"><b>Alamat : </b> {{$penduduk->alamat}} RT {{$penduduk->rt }}
							RW {{$penduduk->rw }} Desa.
							Cibiru Wetan</p>
						<p class="text-muted text-center"><b>Tempat, Tanggal Lahir :</b> {{ $penduduk->tempat_lahir }},
							{{$penduduk->tanggal_lahir}}</p>
						<p class="text-muted text-center"><b>Agama :</b> {{ $penduduk->agama }}</p>
						<p class="text-muted text-center"><b>Pekerjaan :</b> {{ $penduduk->pekerjaan }}</p>

					</div>
					<!-- /.card-body -->
				</div>
			</div>
			<!-- /.card-header -->
			<!-- form start -->
		</div>
	</div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop