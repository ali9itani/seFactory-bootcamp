@extends('master')
@section('title','posts')
@section('content')
<div id="posts">
	<h2>Blog Posts</h2>
	@foreach ($posts as $post)

	<div>
		<div class="posts-post-div" onclick="location.href=this.getAttribute('redirect');" redirect="post/{!! $post['id'] !!}">
		<h3 class="posts-post-title">{!! $post['title'] !!}</h3>
		<div>
			By: <h5 class="posts-post-author">{!! $post['author_name'] !!}</h5>
		</div>
		<h5 class="posts-post-date">{!! $post['created_at'] !!}</h5>
		<p class="posts-post-p">{!! $post['text'] !!}</p>
	</div>
	@endforeach
</div>
@endsection