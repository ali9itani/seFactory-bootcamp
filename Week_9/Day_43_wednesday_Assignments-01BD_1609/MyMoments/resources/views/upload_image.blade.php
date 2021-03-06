@extends('master')
@section('title','my profile')
@section('content')
<div class="container">
	@if($uploaded)
	<div class="row" >
		<div  class="col-xs-1 col-sm-3"></div>
		<div id="upload-status" class="col-sm-6 col-xs-10">{{$uploaded}}</div>
		<div  class="col-xs-1 col-sm-3"></div>
	</div>
	@endif
	<div class="row" >
		<div  class="col-xs-1 col-sm-3"></div>
		<section id="upload-image-form" class="col-sm-6 col-xs-10" >
			<form method="post" enctype="multipart/form-data">
			  <input type="hidden" name="_method" value="POST">
			  <input type="hidden" name="_token" value="{{ csrf_token() }}">
			  <div class="form-group">
			    <label for="hashtags">Hashtags</label>
			    <input type="text" class="form-control" id="hashtags"  name="hashtags" maxlength="300" placeholder="#...">
			  </div>

			  <div class="form-group">
			    <label for="image-caption">Image Caption</label>
			    <textarea class="form-control" id="image-caption"  name="imagecaption" maxlength="2200" placeholder="Image Caption" rows="5"></textarea>
			  </div>

			  <div class="form-group">
			    <label for="image-input">Image input</label>
			    <input type="file" name="image" id="image-input">
			  </div>

			  <button type="submit" class="btn btn-default">Submit</button>
			</form>
		</section>
		<div  class="col-xs-1 col-sm-3"></div>
	</div>
</div> 
@endsection