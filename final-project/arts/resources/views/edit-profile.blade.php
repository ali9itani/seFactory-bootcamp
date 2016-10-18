@extends('master')
@section('page-title','Edit Profile')
@section('header-content')
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection
@section('body-content')
	<div class="container">
	    <h1>Edit Profile</h1>
	  	<hr>
	  	<form id="edit-profile-form" enctype="multipart/form-data">
				{{ csrf_field() }}
		<div class="row">
	      <!-- left column -->
	      <div class="col-md-3">
	        <div class="text-center">
	          <img  id="edit-profile-img" user-data-img-id="{{$current_user->id}}" src="{!! Auth::user()->photo() !!}" class="avatar img-circle" alt="avatar">
	          <h6>Upload a different photo...</h6>
	          <input type="file" class="form-control" name="image" id="fileToUpload">
	        </div>
	      </div>
	      
	      <!-- edit form column -->
	      <div class="col-md-9 personal-info">
	        <div id="profile-page-alert" class="alert alert-info alert-dismissable">
	          <a class="panel-close close" data-dismiss="alert">×</a> 
	          <i class="fa fa-coffee"></i>
	        </div>
	        <h3>Personal info</h3>
	        
	        <form class="form-horizontal" role="form">
	          <div class="form-group">
	            <label class="col-lg-3 control-label">Full name:</label>
	            <div class="col-lg-8">
	              <input class="form-control" type="text" name="fullName"  value="{{$current_user->full_name}}"/>
	            </div>
	          </div>
	          <div class="form-group">
	            <label class="col-lg-3 control-label">Birthdate:</label>
	            <div class="col-lg-8">
	              <input class="form-control" name="birthDate" type="date" value="{{$current_user->birth_date}}" />
	            </div>
	          </div>
	          <div class="form-group">
	            <label class="col-lg-3 control-label">Website:</label>
	            <div class="col-lg-8">
	              <input class="form-control" type="text" name="website" type="website" value="{{$current_user->website}}" />
	            </div>
	          </div>
	          <div class="form-group">
	            <label class="col-lg-3 control-label">Intrests:</label>
	            <div class="col-lg-8">
	              <div class="ui-select">
					<select id="edit-profile-select" class="form-control" multiple>

						@foreach($arts as $art)
							<option
								@if ($art->loggedArtistHasArt())
									{{'selected'}}
								@endif
							value="{{$art->art_id}}">

								{{$art->art_name}}

							</option>
						@endforeach

					</select> 
	              </div>
	            </div>
	          </div>
	          <div class="form-group">
	            <label class="col-md-3 control-label">Bio:</label>
	            <div class="col-md-8">
	              <textarea  class="form-control"  name="bio" maxlength="200" rows="3">{{$current_user->bio}}</textarea>
	            </div>
	          </div>
	          <div class="form-group">
	            <label class="col-md-3 control-label"></label>
	            <div class="col-md-8">
	              <input type="button" style="margin-bottom: 40px;" onclick="saveProfileData()" id="edit-profile-save-button" class="btn btn-primary" value="Save Changes">
	            </div>
	          </div>
	        </form>
	      </div>
	      </form>
	  </div>
	</div>

@endsection

