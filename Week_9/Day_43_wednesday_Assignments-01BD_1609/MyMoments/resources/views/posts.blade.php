@extends('master')
@section('title','my profile')
@section('content')
<div class="container">
	<div class="row" >
		<div class="row">
			<section class="div-as-link" id="upload-image-section" onclick="window.open('image/upload');">
				<div id="upload-image-box" class="col-xs-10 col-xs-offset-1 col-sm-offset-3 col-sm-6" >
					<img id="add-image-icon" class="img-responsive" src="/MyMoments/resources/assets/img/plus-5-xxl.png" />
					Tap To Upload Image
				</div>
			</section>
		</div>
	</div>
	<section id="posts-section">
		@foreach ($posts as $post)
		<div class="row ">
			<div class="post-item col-xs-12  col-sm-6 col-sm-offset-3 ">
				<div class="">
					<div class="row post-item-details">
						<span class="col-xs-5 col-xs-offset-1 col-sm-3 col-sm-offset-1">author</span>
						<span class="col-xs-5 col-sm-offset-2 post-hours-ago">2hrs ago</span>
					</div>
					<div class="posts-item-image-box">
						<img  class="col-xs-12 img-responsive" src="/MyMoments/public/images/{!!$post->post_image_link!!}" />		
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</section>
</div> 
@endsection