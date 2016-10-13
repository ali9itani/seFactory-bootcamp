@extends('master')
@section('page-title','Post')
@section('body-content')
<div id="post-body-container" class="container-980px container-height-default text-align-center">
	<form id="post-images-form" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="text" name="title" placeholder="title">
		<input type="text" name="text" placeholder="text">
		<input type="text" name="location" placeholder="location">
		<input type="text" name="hashtags" placeholder="hashtags">
	    <input id="post-images-uploader" type="file" name="file[]" multiple><br />
	    <input type="submit">
	</form>
	<div id="message"></div>

</div>
@endsection

