@extends('master')
@section('page-title','Profile')
@section('body-content')
<div id="profile-page-body-container" class="container-980px container-height-default pages-main-container text-align-center">
	<!-- user info and followings section -->
	<section id="profile-page-cover-section">
		<!-- profile image -->
		<div id="profile-page-spphoto-div" >
			<img id="profile-img" user-data-img-id="{{$artist[0]->id}}" src="{!! $artist[0]->photo() !!}"></img>
		</div>

		<!-- profile info -->
		<div id="profile-page-profile-text1" class="profile-page-profile-details">
				<table>
				  	<col width="110">
					<tr>
						<td>
							<label>Username: </label>
						</td>
						<td>
							<span>{{$artist[0]->username}}</span>
						</td>
					</tr>
					<tr>
						<td><label>Email: </label></td>
						<td><span>{{$artist[0]->email}}</span></td>
					</tr>
					<tr>
						<td>
							<label>Full name: </label>
						</td>
						<td>
							<span>{{$artist[0]->full_name}}</span>
						</td>
					</tr>
					<tr>
						<td>
							<label>Birth date: </label>
						</td>
						<td>
							<span>{{$artist[0]->birth_date}}</span>
						</td>
					</tr>
					<tr>
						<td>
							<label>Bio: </label>
						</td>
						<td>
							<p>{{$artist[0]->bio}}</p>
						</td>
					</tr>
				</table>
		</div>
		<hr id="profile-info-verticl-ruler" style="width:4px; height:100%"/>
		<div id="profile-page-profile-followig-section">
			@if(Auth::guest())
				<!-- if its a guest than change following section to register to follow -->

				{{'1'}}

			@elseif(Auth::user()->id == $artist[0]->id)
				<!-- if the current user displaying his account -->

				@if($artist[0]->followers->count() == 0 && $artist[0]->following->count() == 0)
				<span style="margin-left:62px;">{{$artist[0]->followers->count()}} followers</span>
				<span style="margin-left:11px;">{{$artist[0]->following->count()}} following</span>
				<a id="profile-go-follow-a" href="{{ url('/explore/artists')}}">Go Follow Someone 
					<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
				</a>
				@endif

			@else
				<!-- if any registered user is displaying another user account -->

					{{'3'}}

			@endif
		</div>

	</section>
		
	<hr/>

	<div id="explore-page-grid">
		@foreach ($posts as $post)
		  <a href="{{asset('/img/posts-images')}}/{{ $post->resources[0]['resource_name'] }}">
		    <figure>
		    	<div class="post-image-and-date">
					<img src="{{asset('/img/posts-images')}}/{{ $post->resources[0]['resource_name'] }}" alt="">
					<span >{{ $post->created_at->format('Y-m-d') }}</span>
				</div>
				<figcaption>
					<div>
						<section class="post-popularity" style="width:100%">
							<br/>
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


</div>
@endsection

