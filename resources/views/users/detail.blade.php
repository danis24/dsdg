@extends('adminlte::page')

@section('title', 'Detail User')

@section('content_header')
<h1>Detail User</h1>
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Detail User</h3>
			</div>
			<div class="card-body">
				<div class="card card-primary card-outline">
					<div class="card-body box-profile">
						<h3 class="profile-username text-center">{{$user->name}}</h3>
						<p class="text-muted text-center"><b>Email :</b> {{ $user->email }}</p>
						<p class="text-muted text-center"><b>Role :</b> {{ $user->roles->pluck('name')[0] }}</p>
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