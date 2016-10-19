@extends('master')

@section('page-title')
	{{$artist[0]->username}}
@endsection

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
							<span id="profile-username-span">{{$artist[0]->username}}</span>
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
						<td><label>Website: </label></td>
						<td><a href="http://{{$artist[0]->website}}" target="_blank" class="fix-anchor">
								{{$artist[0]->website}}
								<i class="fa fa-hand-o-right" aria-hidden="true"></i>
							</a>
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

				<button id="register-following-button" onclick="location.href='{{ url('/')}}';">
					Register to follow
					<i class="fa fa-arrow-circle-right" style="margin-left:10px;" aria-hidden="true"></i>
				</button>

			@elseif(Auth::user()->id == $artist[0]->id)
				<!-- if the current user displaying his account -->

				<span class="following-count" onclick="followListDisplay(0)" style="margin-left:62px;">{{$artist[0]->followers->count()}} followers</span>
				<span class="following-count" onclick="followListDisplay(1)" style="margin-left:11px;">{{$artist[0]->following->count()}} following</span>

				@if($artist[0]->followers->count() == 0 && $artist[0]->following->count() == 0)
					<a id="profile-go-follow-a" href="{{ url('/explore/artists')}}">Go Follow Someone 
						<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
					</a>
				@else
					
					<div id="followers-list" class="profile-following-list-div" style="visibility:hidden;">
						<ul>
							@foreach ($artist[0]->followers as $follower)
								<li><a href="{{url('/artist/')}}/{{arts\User::where('id', '=', $follower->follower_id)->pluck('username')[0]}}">
								{{arts\User::where('id', '=', $follower->follower_id)->pluck('username')[0]}}
								</a></li>
							@endforeach
						</ul>
					</div>

					<div id="following-list" class="profile-following-list-div" style="visibility: hidden;">
						<ul>
							@foreach ($artist[0]->following as $follow)
								<li><a href="{{url('/artist/')}}/{{arts\User::where('id', '=', $follow->followed_id)->pluck('username')[0]}}">
								{{arts\User::where('id', '=', $follow->followed_id)->pluck('username')[0]}}
								</a></li>
							@endforeach
						</ul>
					</div>

				@endif

			@else
				<section id="following-status">
					<!-- if any registered user is displaying another user account -->
					<form id="follow-form">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
					</form>
						<!-- check if this user following that user -->
						@if($following_exist->exists)
							<button id="follow-button" class="following-button" onclick="follow()">
								<span id="follow-text">following</span>
								<i id="follow-icon" class="fa fa-times-circle" style="margin-left:10px;" aria-hidden="true"></i>
							</button>
						@else
							<button id="follow-button" class="follow-button" onclick="follow()" >
								<span id="follow-text">follow</span>
								<i id="follow-icon" class="fa fa-plus-circle" style="margin-left:10px;" aria-hidden="true"></i>
							</button>
						@endif
				</section>
			@endif
		</div>

	</section>
		
	<hr/>

	<div id="explore-page-grid">
		@foreach ($posts as $post)
		  <a href="{{url('/post')}}/{{$post->post_id}}">
		    <figure>
		    	<div class="post-image-and-date">
					<img src="{{asset('/img/posts-images')}}/{{$post->firstResources()['resource_name']}}" alt="">
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

