@extends('master')
@section('title','my profile')
@section('content')
<div class="container">
	<div class="row" >
		<div class="col-sm-2 col-xs-hidden"></div>
		<div class="col-sm-3 col-xs-4" >
			<img  class="img-responsive img-rounded" src="/MyMoments/public/images/profile-default.png" />
		</div>
		<div class="col-sm-5 col-xs-8" id="insta-profile-details">
			<div class="row insta-profile-details-row">
				<p class="col-sm-7 col-xs-12" id="profile-user-name">{!!$data['username']!!}</p>
				<a class="col-sm-5"> edit profile</a>
			</div>

			<div class="row insta-profile-details-row">
					<p class="col-sm-4">{!!$data['posts_count']!!} post</p>
					<p class="col-sm-4">{!!$data['followers_count']!!} followers</p>
					<p class="col-sm-4">{!!$data['following_count']!!} following</p>
			</div>

			<div class="insta-profile-details-row">
				<div>
					{!!$data['name']!!}
				</div>
			</div>
		</div>
		<div class="col-sm-2 col-xs-hidden"></div>
	</div>
	<div id="profile-posts-div" class="row">
		@foreach ($data['posts'] as $post)
		    <img  class="col-xs-4 col-sm-2 img-responsive" src="/MyMoments/public/images/{!!$post->post_image_link!!}" />
		@endforeach	
	</div>
</div> 
@endsection