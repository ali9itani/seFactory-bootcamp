@extends('master')
@section('page-title','Login')
@section('body-content')
<style type="text/css">
	#content {
		background-repeat: no-repeat;
		background-size: cover;
		background-image: linear-gradient(to bottom, rgba(133,80,133, 0.5), rgba(0, 0, 0, 0.5)), url('img/background.jpg');
	}
	footer {
		color: white;
	}
</style>
<div id="login-page-body-container" class="container-980px text-align-center">
	@include('auth/login')
</div>
@endsection

