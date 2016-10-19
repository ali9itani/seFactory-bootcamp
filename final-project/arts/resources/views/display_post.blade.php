@extends('master')
@section('page-title','Explore')
@section('header-content')

@endsection
@section('body-content')
<style>
#body-content-div {
    background-color: white;
    width: 100%;
}

.container-fluid  .container {
	 min-height: 572px;
   background-color: white;
}

#post-title {
    font-family: times, Times New Roman, times-roman, georgia, serif;
    font-size: 28px;
    line-height: 30px;
    letter-spacing: -1px;
    color: #444;
    margin: 0 0 0 0;
    padding: 0 0 0 0;
    font-weight: 100;
}

#post-extras {
  margin-left: 15px;
}

footer {
	margin-top: 40px;
}

.detailBox {
    border:1px solid #bbb;
    margin-top: 10px;
}

.titleBox {
    background-color:#fdfdfd;
    padding:10px;
}
.titleBox label {
  color:#444;
  margin:0;
  display:inline-block;
}
.post-popularity {
	font-size: 21px;
	text-align: right;
}

.post-popularity span{
  text-align: left;
}

.commentBox {
    padding:10px;
    border-top:1px dotted #bbb;
}
.commentBox .form-group:first-child, .actionBox .form-group:first-child {
    width:80%;
}
.commentBox .form-group:nth-child(2), .actionBox .form-group:nth-child(2) {
    width:18%;
}
.actionBox .form-group * {
    width:100%;
}
.taskDescription {
    margin-top:10px 0;
}
.commentList {
    padding:0;
    list-style:none;
    max-height:200px;
    overflow:auto;
}
.commentList li {
    margin:0;
    margin-top:10px;
}
.commentList li > div {
    display:table-cell;
}
.commenterImage {
    width:30px;
    margin-right:5px;
    height:100%;
    float:left;
}
.commenterImage img {
    width:100%;
    border-radius:50%;
}
.commentText p {
    margin:0;
}
.sub-text {
    color:#aaa;
    font-family:verdana;
    font-size:11px;
}
.actionBox {
    border-top:1px dotted #bbb;
    padding:10px;
}
</style>
<script src="{{ asset('/js/jquery-1.11.3.min.js') }}" type="text/javascript"></script>
<script  src="{{ asset('/js/jssor.slider-21.1.6.mini.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {

        var jssor_1_SlideshowTransitions = [
          {$Duration:1200,x:0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:1200,x:-0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:1200,x:-0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:1200,x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:1200,y:0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:1200,y:-0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:1200,y:-0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:1200,y:0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:1200,x:0.3,$Cols:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:1200,x:0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:1200,y:0.3,$Rows:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:1200,y:0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:1200,y:0.3,$Cols:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:1200,y:-0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:1200,x:0.3,$Rows:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:1200,x:-0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:1200,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:1200,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:1200,$Delay:20,$Clip:3,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:1200,$Delay:20,$Clip:3,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:1200,$Delay:20,$Clip:12,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:1200,$Delay:20,$Clip:12,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2}
        ];

        var jssor_1_options = {
          $AutoPlay: true,
          $SlideshowOptions: {
            $Class: $JssorSlideshowRunner$,
            $Transitions: jssor_1_SlideshowTransitions,
            $TransitionsOrder: 1
          },
          $ArrowNavigatorOptions: {
            $Class: $JssorArrowNavigator$
          },
          $ThumbnailNavigatorOptions: {
            $Class: $JssorThumbnailNavigator$,
            $Cols: 10,
            $SpacingX: 8,
            $SpacingY: 8,
            $Align: 360
          }
        };

        var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

        /*responsive code begin*/
        /*you can remove responsive code if you don't want the slider scales while window resizing*/
        function ScaleSlider() {
            var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
            if (refSize) {
                refSize = Math.min(refSize, 800);
                jssor_1_slider.$ScaleWidth(refSize);
            }
            else {
                window.setTimeout(ScaleSlider, 30);
            }
        }
        ScaleSlider();
        $(window).bind("load", ScaleSlider);
        $(window).bind("resize", ScaleSlider);
        $(window).bind("orientationchange", ScaleSlider);
        /*responsive code end*/
    });
</script>
<style>
    /* jssor slider arrow navigator skin 05 css */
    /*
    .jssora05l                  (normal)
    .jssora05r                  (normal)
    .jssora05l:hover            (normal mouseover)
    .jssora05r:hover            (normal mouseover)
    .jssora05l.jssora05ldn      (mousedown)
    .jssora05r.jssora05rdn      (mousedown)
    .jssora05l.jssora05lds      (disabled)
    .jssora05r.jssora05rds      (disabled)
    */
    .jssora05l, .jssora05r {
        display: block;
        position: absolute;
        /* size of arrow element */
        width: 40px;
        height: 40px;
        cursor: pointer;
        background: url({{ asset('/img/a17.png') }}) no-repeat;
        overflow: hidden;
    } 
    .jssora05l { background-position: -10px -40px; }
    .jssora05r { background-position: -70px -40px; }
    .jssora05l:hover { background-position: -130px -40px; }
    .jssora05r:hover { background-position: -190px -40px; }
    .jssora05l.jssora05ldn { background-position: -250px -40px; }
    .jssora05r.jssora05rdn { background-position: -310px -40px; }
    .jssora05l.jssora05lds { background-position: -10px -40px; opacity: .3; pointer-events: none; }
    .jssora05r.jssora05rds { background-position: -70px -40px; opacity: .3; pointer-events: none; }
    /* jssor slider thumbnail navigator skin 01 css *//*.jssort01 .p            (normal).jssort01 .p:hover      (normal mouseover).jssort01 .p.pav        (active).jssort01 .p.pdn        (mousedown)*/.jssort01 .p {    position: absolute;    top: 0;    left: 0;    width: 72px;    height: 72px;}.jssort01 .t {    position: absolute;    top: 0;    left: 0;    width: 100%;    height: 100%;    border: none;}.jssort01 .w {    position: absolute;    top: 0px;    left: 0px;    width: 100%;    height: 100%;}.jssort01 .c {    position: absolute;    top: 0px;    left: 0px;    width: 68px;    height: 68px;    border: #000 2px solid;    box-sizing: content-box;    background: url({{ asset('/img/t01.png') }}) -800px -800px no-repeat;    _background: none;}.jssort01 .pav .c {    top: 2px;    _top: 0px;    left: 2px;    _left: 0px;    width: 68px;    height: 68px;    border: #000 0px solid;    _border: #fff 2px solid;    background-position: 50% 50%;}.jssort01 .p:hover .c {    top: 0px;    left: 0px;    width: 70px;    height: 70px;    border: #fff 1px solid;    background-position: 50% 50%;}.jssort01 .p.pdn .c {    background-position: 50% 50%;    width: 68px;    height: 68px;    border: #000 2px solid;}* html .jssort01 .c, * html .jssort01 .pdn .c, * html .jssort01 .pav .c {    /* ie quirks mode adjust */    width /**/: 72px;    height /**/: 72px;}
</style>
<div class="container-fluid">

  <div class="page-header">
    <h1 id="post-title" class="row">{{$post->title}}</h1>
  </div>

	<div id="jssor_1" class="row col-lg-5 col-lg-offset-1 col-xs-12" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 800px; height: 456px; overflow: hidden; visibility: hidden; background-color: #24262e;">
	    <!-- Loading Screen -->
		<div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
		        <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
		        <div style="position:absolute;display:block;background:url({{ asset('/img/loading.gif') }}) no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
		    </div>
		    <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 800px; height: 356px; overflow: hidden;">
		    	@foreach($post->resources as $resource)
		        <div data-p="144.50">
		            <img data-u="image" src="{{asset('/img/posts-images')}}/{{$resource['resource_name']}}" />
		        </div>
		        @endforeach
		    </div>
		    <!-- Thumbnail Navigator -->
		    <div data-u="thumbnavigator" class="jssort01" style="position:absolute;left:0px;bottom:0px;width:800px;height:100px;" data-autocenter="1">
		        <!-- Thumbnail Item Skin Begin -->
		        <div data-u="slides" style="cursor: default;">
		            <div data-u="prototype" class="p">
		                <div class="w">
		                    <div data-u="thumbnailtemplate" class="t"></div>
		                </div>
		                <div class="c"></div>
		            </div>
		        </div>
		        <!-- Thumbnail Item Skin End -->
		    </div>
		    <!-- Arrow Navigator -->
		    <span data-u="arrowleft" class="jssora05l" style="top:158px;left:8px;width:40px;height:40px;"></span>
		    <span data-u="arrowright" class="jssora05r" style="top:158px;right:8px;width:40px;height:40px;"></span>
		</div>
		<!-- #endregion Jssor Slider End -->

	

    <div id="post-extras" class="row col-lg-4 col-xs-12">
      <div class="row panel panel-default">
        <section class="post-popularity">
        <span class="">{{$post->created_at}}</span>
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


    <div class="row detailBox detailBox">
            <div class="commentBox">
                <p class="taskDescription"> {{ $post->text }}</p>
            </div>
            <div class="actionBox">
                <ul class="commentList">
                  @foreach($post->post_comments as $comment)
                    <li>
                        <div class="commenterImage">
                          <img src="{!! $post->user->photo() !!}"/>
                        </div>
                        <div class="commentText">
                            <b>{!! $comment->user->username !!}</b>
                            <p class="">{{$comment->comment}}.</p> 
                            <span class="date sub-text">{{$comment->created_at->format('Y-m-d')}}</span>

                        </div>
                    </li>
                  @endforeach
                </ul>
                <form class="form-inline" role="form">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Your comments" />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-default">Add</button>
                    </div>
                </form>
          </div>
        </div>
    </div>

	</div>
@endsection
