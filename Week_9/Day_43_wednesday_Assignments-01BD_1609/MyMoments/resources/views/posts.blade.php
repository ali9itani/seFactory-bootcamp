@extends('master')
@section('title','my profile')
@section('content')
<div class="container">
	<div class="row" >
		<div class="row">
			<section class="div-as-link" id="upload-image-section" onclick="window.open('image/upload');">
				<div id="upload-image-box" class="col-xs-10 col-xs-offset-1 col-sm-offset-3 col-sm-6" >
					<img id="add-image-icon" class="img-responsive" src="/MyMoments/resources/assets/img/camera-2-xxl.png" />
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
						<span id="post-{!!$post->post_id!!}-likes-count">{!!$post->likes_count!!}</span> likes
					</div>
					<div class="row post-item-image-comments col-sm-10 col-sm-offset-1" id="post-item-image-comments-{!!$post->post_id!!}">
					@if($post->comments)
						@foreach ($post->comments as $comment)
							<p>{!!$comment!!}</p>
						@endforeach
					@endif
					</div>
					<div class="row post-comment-and-like col-sm-11 col-sm-offset-1">
						<img class="like-image col-xs-4 col-xs-offset-4 col-sm-offset-0 col-sm-2 img-responsive" onclick="like('{!!$post->post_id!!}')" x-data="{!!$post->is_liked!!}" id="img-{!!$post->post_id!!}" style="margin-top: 5px;"
						@if($post->is_liked)
							{!!'src="/MyMoments/public/images/liked.png"'!!}
						@else
							{!!'src="/MyMoments/public/images/emptyheart.png"'!!}
						@endif
						 />
						<div class="row col-xs-12 col-sm-10" style="margin: 0px;padding: 0px;" >
						    <div class="input-group">
						      <input type="text" id="comment-input-{!!$post->post_id!!}" class="form-control" placeholder="Add a comment...">
						      <span class="input-group-btn">
						        <button class="btn btn-secondary" onclick="comment('{!!$post->post_id!!}');" type="button">go</button>
						      </span>
						    </div>
						 </div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</section>
</div> 
@endsection