@extends('master')
@section('title', 'post')
@section('content')
	@section('main-title')
		{!!$data['title']!!}
	@endsection
	<div id="post-details">
		<h5 id="post-author-name">{!!$data['author_name']!!}e</h5>
		<h5 id="post-created-at">{!!$data['created_at']!!}</h5>
		<p id="post-text">{!!$data['text']!!}</p>
	</div>
@endsection