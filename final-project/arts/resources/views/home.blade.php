@extends('master')

@section('page-title','Home')

@section('body-content')

@if(!$user->full_name || !isset($user->artist_arts[0]))
<div id="home-page-go-to-edit-profile">
	<a href="{{url('/me/edit')}}" class="fix-anchor">Click on to complete your account information.</a>
</div>
@endif
<div id="home-body-container" class="container-980px container-height-default text-align-center">

</div>
@endsection

