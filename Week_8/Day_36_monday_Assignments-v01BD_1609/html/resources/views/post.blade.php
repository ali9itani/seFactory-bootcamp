@extends('master')
@section('title', 'post')
@section('content')
<div id="post">
	<h2 id="post-title" >{!!$data['title']!!}</h2>
	<h5 id="post-author-name">{!!$data['author_name']!!}e</h5>
	<h5 id="post-created-at">{!!$data['created_at']!!}</h5>
	<p id="post-text">{!!$data['text']!!}</p>
</div>
@endsection