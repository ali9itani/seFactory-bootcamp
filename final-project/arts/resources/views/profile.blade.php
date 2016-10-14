@extends('master')
@section('page-title','Profile')
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

	@foreach ($posts as $post)
    <p>{{ $post->post_id }}</p>
    <p>{{ $post->resources }}</p>
    ------
	@endforeach

</div>
@endsection

