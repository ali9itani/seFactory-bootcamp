@extends('master')

@section('page-title','Explore')

@section('body-content')
<div id="explore-body-container" class="container-height-default text-align-center">
	@if(Request::path() == 'explore' || Request::path() == 'explore/views')
		<h1>
			@if(Request::path() == 'explore')
				{{'Random Exploration'}}
			@else
				{{'By Views Exploration'}}
			@endif
		</h1>
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

	<!-- artists exploration section -->
	@elseif(Request::path() == 'explore/artists')

		<h1>Artists Exploration</h1>

	        <div id="explore-page-artists-box">
	        	@foreach ($users as $user)

					<div class="explore-page-artist-block">
						<div class="explore-page-artist-info">

							<img class="artists-explore-artist-img" src="{!! $user->photo() !!}" />
							<div class="artist-explore-artist-text-info">
								<a href="{{url('/artist/')}}/{!! $user->username !!}"
									class="artist-explore-artist-name">{!! $user->username !!}
								</a>
								<br/>
								@foreach($user->artist_arts as $artist_art)

									<span class="artist-arts">{{$artist_art->art->art_name}}</span>

									@if($loop->index == 5)
										{{', and others'}}
										@break
									@elseif(!$loop->last)
										{{','}}
									@endif
									
								@endforeach
							</div>
							 
						</div>

						@if($user->limitedPostsToSix->count())
							<div class="explore-page-artist-posts">
								@foreach ($user->limitedPostsToSix as $post)
									<a 
									href="{{asset('/img/posts-images')}}/{{ $post->resources[0]['resource_name'] }}">
										<figure>
											<img class="explore-artist-post-img" src="{{asset('/img/posts-images')}}/{{ $post->resources[0]['resource_name'] }}" alt="">
										</figure>
									</a>	
								@endforeach
							</div>
						@else 
							<span>No Posts Yet</span>
						@endif
					</div>	

				@endforeach
			</div>

	@endif

<!-- end of main container of page -->
</div>
@endsection

