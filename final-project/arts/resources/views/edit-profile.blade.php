@extends('master')
@section('page-title','Edit Profile')
@section('body-content')
<div id="profile-page-body-container" class="container-980px container-height-default pages-main-container text-align-center">
	<ul id="profile-save-status-msg">
	</ul>
	<form id="edit-profile-form" enctype="multipart/form-data">
		{{ csrf_field() }}
		<!-- profile image -->
		<div id="profile-page-pphoto-div" class="profile-page-profile-details">
			<img id="profile-img" user-data-img-id="{{$current_user->id}}" src="{!! Auth::user()->photo() !!}"></img>
			<span id="profile-page-change-photo-span">Change Your Photo!!</span>
			<input type="file" name="image" id="fileToUpload">
		</div>
		<div id="profile-page-profile-text1" class="profile-page-profile-details">
				<table>
				  	<col width="120">
					<tr>
						<td><label>Username: </label></td>
						<td><span>{{$current_user->username}}</span></td>
					</tr>
					<tr>
						<td><label>Email: </label></td>
						<td><span>{{$current_user->email}}</span></td>
					</tr>
					<tr>
						<td><label>Full name: </label></td>
						<td><input name="fullName"  value="{{$current_user->full_name}}"/></td>
					</tr>
					<tr>
						<td><label>Birth date: </label></td>
						<td><input  name="birthDate" type="date" value="{{$current_user->birth_date}}" /></td>
					</tr>
				</table>
		</div>
		<div id="profile-page-profile-text2" class="profile-page-profile-details">
			<label>bio: </label>
			<br/>
			<textarea name="bio" maxlength="200" rows="3">{{$current_user->bio}}</textarea>
		</div>
		</form>
		<div id="profile-page-profile-submit-div">
			<button onclick="saveProfileData()" class="float-right">Save</button>
		</div>
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

