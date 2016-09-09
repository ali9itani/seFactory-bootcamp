@extends('master')
@section('title','add post')
@section('content')
	@section('main-title','Add New Post')
	<form id="add-post-form" method="post" action="/public/post">
		<input type="hidden" name="_method" value="POST">
		{{ csrf_field() }}
		<input type="text" name="title" placeholder="post title" maxlength="200" />
		<textarea  name="text" placeholder="post body..."></textarea>
		<button type="submit" >Post</button>
		<div class="clear"></div>
	</form>
@endsection