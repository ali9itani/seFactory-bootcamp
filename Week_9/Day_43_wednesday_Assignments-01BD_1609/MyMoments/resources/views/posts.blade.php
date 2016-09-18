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
						<span class="col-xs-5 col-xs-offset-1 col-sm-3 col-sm-offset-1">{!!$post->post_author_name!!}</span>
						<span class="col-xs-5 col-sm-offset-2 post-hours-ago">{!!$post->time!!}</span>
					</div>
					<div class="row posts-item-image-box">
						<img ondblclick="like('{!!$post->post_id!!}')"  class="col-xs-12 img-responsive" src="/MyMoments/public/images/{!!$post->post_image_link!!}" />		
					</div>
					<div class="row posts-item-image-caption col-sm-10 col-sm-offset-1">
						<p>{!!$post->image_caption!!}</p>		
					</div>
					<div class="row post-likes col-sm-10 col-sm-offset-1">
						{!!$post->likes_count!!} likes
					</div>
					<div class="row post-item-image-comments col-sm-10 col-sm-offset-1">
					@if($post->comments)
						@foreach ($post->comments as $comment)
							<div class="post-comment">
								<p>{!!$comment!!}</p>	
							</div>	
						@endforeach
					@endif
					</div>
					<div class="row post-comment-and-like col-sm-11 col-sm-offset-1">
						<img class="like-image col-xs-3 col-xs-offset-5 col-sm-offset-0 col-sm-3 img-responsive" onclick="like('{!!$post->post_id!!}')" x-data="{!!$post->is_liked!!}" id="img-{!!$post->post_id!!}"
						@if($post->is_liked)
							{!!'src="/MyMoments/public/images/liked.png"'!!}
						@else
							{!!'src="/MyMoments/public/images/emptyheart.png"'!!}
						@endif
						 />
						<input type="text" class="col-xs-12 col-sm-8" placeholder="Add a comment ..."/>
						
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</section>
</div> 
@endsection