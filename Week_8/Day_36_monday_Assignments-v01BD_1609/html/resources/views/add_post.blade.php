@extends('master')
@section('title','add post')
@section('content')
<div id="add-post-div">
	<h2>Add New Post</h2>
	<form method="post" action="addpost">
		<input type="hidden" name="_method" value="POST">
		{{ csrf_field() }}
		<input type="text" name="title" placeholder="post title" />
		<textarea  name="text" placeholder="post body..."></textarea>
		<button type="submit" >Post</button>
		<div class="clear"></div>
	</form>
</div>
@endsection