@extends('master')
@section('page-title','Add Post')
@section('body-content')
<style>
	/*post section*/
.new-post-caption{
	background: #182945;
}
.new-post-heading h2{
	color: #fff;
	font-size: 90px;
}
.new-post-info{
	padding-left: 40px;
}
.new-post-info h3{
	padding-left: 0;
	font-size: 30px;
	color: #fff;
	text-transform: uppercase;
	font-weight: bold;
	border-bottom: 1px solid #13849c;
	padding-bottom: 12px;
	margin-bottom: 0;
}
.new-post-form h3{
	padding-left: 0;
	font-size: 30px;
	color: #fff;
	text-transform: uppercase;
	font-weight: bold;
	border-bottom: 1px solid #13849c;
	padding-bottom: 12px;
	margin-bottom: 0;
}
.new-post-info ul{
	margin: 0;
	padding: 0;
}
.new-post-info ul li{
	font-family: 'Open Sans', sans-serif;
	font-size: 14px;
	color: #fff;
}
.new-post-info i.fa{
	font-size: 16px;
  	padding-right: 12px;
  	width: 25px;
  	height: 38px;
}
.new-post-info ul li span{
	font-weight: bold;
}
.new-post-form input{
	width: 100%;
	height: 40px;
	background: #fff;
	font-size: 13px;
	color: #084a5c;
	font-family: 'Open Sans', sans-serif;
	padding: 12px;
	border:0;
	margin-bottom: 12px;
}
.new-post-form textarea{
	font-family: 'Open Sans', sans-serif;
	padding:12px;
	width: 100%;
	height: 140px;
	border:0;
	margin-bottom: 12px;
}
.info-detail{
	border-top: 1px solid #53cde5;
	padding-top: 15px;
}
.form{
	border-top: 1px solid #53cde5;
	padding-top: 15px;
	text-align: right;
}
.new-post-form input.submit-btn{
	width: 180px;
	height: 50px;
	float: right;
	font-size: 24px;
	color: #fff;
	background: url(../img/btn-bg.jpg);
	background-repeat: no-repeat;
	padding: 0;
	font-family: 'BenchNine', sans-serif;
	font-weight: bold;
	
}
.new-post-form{
	padding-right: 35px;
	padding-left: 55px;
}
#new-post-container {
	width: 100%;
	padding-top: 20px;
}
.new-post-form h3 {
	margin-bottom: 20px;
	border-bottom: 1px solid #53cde5;
}
#post-images-uploader {
	color: white;
}
</style>
<div id="post-body-container" class="container-980px container-height-default text-align-center">
	<div class="row" id="new-post-msg-box"></div>
	<!-- post section starts here -->
	<section class="post">
		<form id="post-images-form" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="container" id="new-post-container">
				<div class="row">
						<div class="new-post-caption clearfix">
							<div class="col-md-6 new-post-info text-left">
								<h3>Upload Images</h3>
								<div class="info-detail">
									<input id="post-images-uploader" class="col-md-11" type="file" name="file[]" multiple> 
									<a href="#"  data-toggle="tooltip" title="Up to 10 photos">
										<i class="fa fa-info" aria-hidden="true"></i>
									</a>
								</div>
								<div class="panel panel-default">
								  <div id="new-post-photos-display" class="panel-body">
								    <p>your photos</p>
								  </div>
								</div>
							</div>
							
					<div class="col-md-6 new-post-form">
							<h3>Description</h3>

								<input required="true" name="title" type="text" placeholder="Title"/>
								<input type="text" name="location" placeholder="Location"/>
								<input type="text"  name="hashtags" placeholder="Hashtags"/>
								<textarea class="message" name="text" cols="30" rows="10" placeholder="Text"></textarea>
								<input type="button" onclick="uploadPost()" id="submit-post" class="btn btn-primary submit-btn" value="Post">

						</div>

					</div>
				</div>
			</div>
		</form>
	</section><!-- end of post section -->    
</div>
@endsection

