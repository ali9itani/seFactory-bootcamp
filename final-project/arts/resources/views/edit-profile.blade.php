@extends('master')
@section('page-title','Edit Profile')
@section('header-content')
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection
@section('body-content')

<div id="edit-profile-page-body-container" class="container-980px container container-height-default">
	<div class="row">
		<ul id="profile-save-status-msg">
		</ul>
	</div>

	<div class="row">
		<form id="edit-profile-form" enctype="multipart/form-data">
			{{ csrf_field() }}
			<!-- profile image -->
			<div class="row">
				<img id="edit-profile-img" class="img-responsive row" user-data-img-id="{{$current_user->id}}" src="{!! Auth::user()->photo() !!}"></img>
				<input type="file" name="image" class="row " id="fileToUpload">
			</div>
			<div>
				<div class="row">
					<label class="col-xs-12 col-sm-6 col-md-2 col-md-offset-3">Full name: </label>
					<input  class="col-xs-12 col-sm-6 col-md-3" name="fullName"  value="{{$current_user->full_name}}"/>
				</div>
				<div class="row">
					<label class="col-xs-12 col-sm-6 col-md-2 col-md-offset-3">Website: </label>
					<input  class="col-xs-12 col-sm-6 col-md-3" name="website" type="website" value="{{$current_user->website}}" />
				</div>
				<div class="row">
					<label class="col-xs-12 col-sm-6 col-md-2 col-md-offset-3" >Birth date: </label>
					<input class="col-xs-12 col-sm-6 col-md-3"  name="birthDate" type="date" value="{{$current_user->birth_date}}" />
				</div>
				<div class="row">
					<label class="col-xs-12 col-sm-6 col-md-2 col-md-offset-3">Bio: </label>
					<textarea class="col-xs-12 col-sm-6 col-md-3" name="bio" maxlength="200" rows="3">{{$current_user->bio}}</textarea>
				</div>
			</div>
			</form>
			<div class="row">
				<button onclick="saveProfileData()" id="edit-profile-save-button" class="col-xs-12 col-md-2 col-md-offset-6 btn btn-default waves-effect waves-light">Save</button>
			</div>
		</div>
</div>
@endsection

