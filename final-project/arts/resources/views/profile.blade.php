@extends('master')
@section('page-title','Profile')
@section('body-content')
<div id="profile-page-body-container" class="container-980px container-height-default pages-main-container text-align-center">
	<!-- user info and followings section -->
	<section id="profile-page-cover-section">
		<!-- profile image -->
		<div id="profile-page-spphoto-div" >
			<img id="profile-img" user-data-img-id="{{$current_user->id}}" src="{!! Auth::user()->photo() !!}"></img>
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
							<span>{{$current_user->username}}</span>
						</td>
					</tr>
					<tr>
						<td><label>Email: </label></td>
						<td><span>{{$current_user->email}}</span></td>
					</tr>
					<tr>
						<td>
							<label>Full name: </label>
						</td>
						<td>
							<span>{{$current_user->full_name}}</span>
						</td>
					</tr>
					<tr>
						<td>
							<label>Birth date: </label>
						</td>
						<td>
							<span>{{$current_user->birth_date}}</span>
						</td>
					</tr>
					<tr>
						<td>
							<label>Bio: </label>
						</td>
						<td>
							<p>{{$current_user->bio}}</p>
						</td>
					</tr>
				</table>
		</div>
		<div id="profile-page-profile-followig-section">

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

