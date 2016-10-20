@extends('master')

@section('page-title')
	{{$artist[0]->username}}
@endsection

@section('header-content')
	<link rel="stylesheet" href="{{asset('css/profile.css')}}" />
	<style>
		a {
			border: none;
		}
		#artist-details div{
			margin-top: 10px;
		}
		#main {
			padding-top: 40px;
			padding-right: 0px;
			padding-left: 0px;
		}
		#profile-username-span {
			font-weight: bold;
			color: white;
			font-size: 30px;
		}
		footer {
			visibility: hidden;
		}
	</style>
@endsection

@section('body-content')

<div id="top">

	<!-- Profile Header -->
		<div id="header" class="row">
			<div class="inner">
				<a href="#"  style="width:auto;" class="image avatar col-md-8 col-md-offset-2"><img style="height: 200px;margin-right: 65px;" src="{!! $artist[0]->photo() !!}" alt="" /></a>
				<div class="row text-align-center" id="artist-details">
					<h1 class="row col-lg-12"><span id="profile-username-span" class="col-lg-12 text-align-center">{{$artist[0]->username}}</span></h1>
					<div class="row col-lg-12">
						{{$artist[0]->full_name}} {{$artist[0]->birth_date}} {{$artist[0]->email}}
					</div>
					<div class="row col-lg-12">
						{{$artist[0]->bio}}
					</div>
					<div class="row col-lg-12">
						<span class="col-lg-12">Visit me on <a href="http://{{$artist[0]->website}}">MY WEBSITE</a></span>
					</div>				
				</div>
			</div>
		</div>

	<!-- Main -->
		<div id="main">
			<!-- One -->
			<section id="one">
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
						
						<div id="followers-list" class="profile-following-list-div" style="display:none;">
							<ul>
								@foreach ($artist[0]->followers as $follower)
									<li><a href="{{url('/artist/')}}/{{arts\User::where('id', '=', $follower->follower_id)->pluck('username')[0]}}">
									{{arts\User::where('id', '=', $follower->follower_id)->pluck('username')[0]}}
									</a></li>
								@endforeach
							</ul>
						</div>

						<div id="following-list" class="profile-following-list-div" style="display:none;">
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
					<style>
						#profile-page-profile-followig-section {
							width: 20%;
						}
					</style>
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

			<!-- Two -->
				<section id="two" style="padding-top: 20px;">
					<h2>Posts</h2>
					<div class="row">
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

				</section>

					<!-- Scripts -->
		<script src="{{asset('js/jquery.poptrox.min.js')}}"></script>
		<script src="{{asset('js/skel.min.js')}}"></script>
		<script src="{{asset('js/util.js')}}"></script>
		<script src="{{asset('js/profile.js')}}"></script>
</div>
@endsection

