@extends('master')

@section('page-title','Explore')

@section('body-content')
<div id="explore-body-container" class="container-height-default text-align-center">
	<h1>Random Exploration</h1>
	<div id="explore-page-grid">
		@foreach ($posts as $post)
		  <a href="{{asset('/img/posts-images')}}/{{ $post->resources[0]['resource_name'] }}">
		    <figure>
			<img src="{{asset('/img/posts-images')}}/{{ $post->resources[0]['resource_name'] }}" alt="">
				<figcaption >
					<div>
						<section class="post-credit">
							Credit: {{ $post->user->username }}
						</section>
						<section class="post-popularity">
							<i class="fa fa-eye" aria-hidden="true"></i> {{ $post->view_count }}
							<i class="fa fa-comment" aria-hidden="true"></i> {{ $post->post_comments->count() }}
							<i class="fa fa-arrow-up" aria-hidden="true"></i>
							@if(isset($post->upVotesCount[0]))
							     {{ $post->upVotesCount[0]['count']}}
							@else
								{{'0'}}
							@endif
							 
							<i class="fa fa-arrow-down"  aria-hidden="true"></i> 
							@if(isset($post->downVotesCount[0]))
							     {{ $post->downVotesCount[0]['count'] }}
							@else
								{{'0'}}
							@endif
						</section>
					</div>
					<p class="post-title">{{ $post->title }}</p>
				</figcaption>
		    </figure>
		  </a>	
		@endforeach
	</div>

	<!-- pagination div -->
	<div id="pagination-div">{{ $posts->links() }}</div>	
</div>
@endsection

