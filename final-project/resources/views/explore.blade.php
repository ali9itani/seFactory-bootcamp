@extends('master')
@section('page-title','Explore')
@section('header-content')
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link  href="{{ asset('/grid/style.css') }}" rel="stylesheet" type="text/css" media="all" /> 
	<link  href="{{ asset('/grid/jphotogrid.css') }}" rel="stylesheet" type="text/css" media="screen" /> 
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script src="{{ asset('/grid/jphotogrid.js') }}"></script>
	<script src="{{ asset('/grid/jflickrfeed.js') }}"></script>
	<script src="{{ asset('/grid/setup.js') }}"></script>
@endsection
@section('body-content')
<style>
#body-content-div {
    background-color: white;
}
.ellipsis {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
h1 {
	text-align: center;
}
</style>
<div class="row">
	@if(Request::path() == 'explore' || Request::path() == 'explore/views')
		<h1 class="row text-align-center" style="margin: 0px;padding: 20px;text-decoration: underline;">
			@if(Request::path() == 'explore')
				{{'Random Exploration'}}
			@else
				{{'By Views Exploration'}}
			@endif
		</h1>
		<div >
			<ul id="pg">
				@foreach ($posts as $post)
					<li style="width:14.2%;">
						<img onclick="this.focus()" class="img-responsive" src="{{asset('/img/posts-images')}}/{{ $post->firstResources()['resource_name'] }}"
						 alt="{{ $post->title }}">
						<a  class="ellipsis" href="{{url('/post')}}/{{$post->post_id}}">{{ $post->title}}</a>
					</li> 
				@endforeach
			</ul>
		</div>

		<!-- pagination div -->
		<div class="row" style="min-height: 500px;">{{ $posts->links() }}</div>

	<!-- artists exploration section -->
	@elseif(Request::path() == 'explore/artists')

		<h1>Artists Exploration</h1>

	        <div id="explore-page-artists-box">
	        	@foreach ($users as $user)

					<div class="explore-page-artist-block well">
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

						@if($user->limitedPostsToFive->count())
							<div class="explore-page-artist-posts">
								@foreach ($user->limitedPostsToFive as $post)
									<a 
									href="{{asset('/img/posts-images')}}/{{ $post->firstResources()['resource_name'] }}">
										<figure>
											<img class="explore-artist-post-img" src="{{asset('/img/posts-images')}}/{{ $post->firstResources()['resource_name'] }}" alt="">
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
<script type="text/javascript">
    $(function() {
        $(".flex").flex();
    });
</script>
@endsection

