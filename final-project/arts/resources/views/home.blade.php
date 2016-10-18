@extends('master')

@section('page-title','Home')

@section('body-content')

@if(!$user->full_name || !isset($user->artist_arts[0]))

<a href="{{url('/me/edit')}}" class="alert alert-info fade in">
	<a class="close" data-dismiss="alert">&times;</a>
	<strong>Note!</strong> Please complete your account information.
</a>

@endif
<div id="home-body-container" class="container-980px container-height-default text-align-center">

</div>
@endsection

