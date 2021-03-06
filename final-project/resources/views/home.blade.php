@extends('master')

@section('page-title','Home')

@section('body-content')
<style>
	#home-body{
		width: 100%;
		margin-right: 0px;
		margin-top: 10px;
	}
	#side-bar {
		margin-left: 10px;
	}

	.home-post {
		margin-left: 10px;
	}

	.left-column {
		margin-left: 5px;
		min-height: 500px;
	}

	#post-img {
		max-height: 300px;
		max-width: 400px;
	}


</style>
@if(!$user->full_name || !isset($user->artist_arts[0]))

<a href="{{url('/me/edit')}}" class="row col-xs-12 alert alert-info fade in" style="margin-left: -5px;margin-top: 10px;">
	<strong>Note!</strong> Please complete your account information.
</a>

@endif
<div id="home-body-container" class="">
<!-- Page Content -->
    <div class="container" id="home-body">

        <!-- Posts Content Column -->
        <div class="left-column row col-lg-8 col-xs-12">
        @if(isset($posts[0]))
        @foreach($posts[0] as $post)
            <!-- Post -->
           <div class="home-post well row col-lg-11 col-lg-offset-1">
	            <!-- Title -->
	            <h1>{{$post->title}}</h1>

	            <!-- Author -->
	            <p class="lead">
	                by <a href="{{url('/artist/')}}/{{$post->user->username}}">{{$post->user->username}}</a>
	            </p>

	            <hr>

	            <!-- Date/Time -->
	            <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at}}</p>

	            <hr>

	            <!-- Preview Image -->
	            <a href="{{url('/post')}}/{{$post->post_id}}"><img class="img-responsive" id="post-img" src="{{asset('/img/posts-images')}}/{{$post->firstResources()['resource_name']}}" alt=""></a>
	                <div id="post-extras">
				        <section class="post-popularity">
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

	            <hr>

	            <!-- Post Content -->
	            <p class="lead">{{$post->text}}</p>

	            <hr>
	        </div>
	        @endforeach
            @else 
                No posts yet, make sure you follow someone
            @endif
        </div>

            <!-- home Sidebar Column -->
            <div id="side-bar" class="col-lg-4 col-lg-offset-1 col-xs-12">

                <!-- Search -->
                <div class="well">
                    <h4>Posts Search</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                <h4>Random Post</h4>
                @if(isset($random_post->post_id))
                    <a href="{{url('/post')}}/{{$random_post->post_id}}">
                        <img style="max-height:250px;max-width:300px;" src="{{asset('/img/posts-images')}}/{{$random_post->firstResources()['resource_name']}}" alt="">
                        <p>{{$random_post->text}}</p>
                    </a>
                @endif
                </div>

            </div>

        </div>
        <!-- /.row -->

</div>
@endsection

