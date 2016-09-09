@extends('master')
@section('title', 'post')
@section('content')
	@section('main-title')
		{!!$data['title']!!}
	@endsection
	<div id="post-details">
		<h5 id="post-author-name">{!!$data['author_name']!!}</h5>
		<h5 id="post-created-at">{!!$data['created_at']!!}</h5>
		<p id="post-text">{!!$data['text']!!}</p>
		 @if ($data['allow_delete'])
			 <form action="{{ url('post/'.$data['post_id']) }}" method="POST">
				<input type="hidden" name="_method" value="delete">
				{{ csrf_field() }}
				<button type="submit" >Delete</button>
            </form>
        @endif
	</div>
@endsection