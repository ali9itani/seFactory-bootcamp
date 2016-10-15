@extends('master')
@section('page-title','Explore')
@section('body-content')
<div id="explore-body-container" class="container-height-default text-align-center">
<style>
#explore-page-grid {
	padding-bottom: 30px;
	padding-top: 50px;
}
#explore-page-grid h3 {
  text-align: center;
  font-size: 1.65em;
  margin: 0 0 30px;
}

#explore-page-grid div {
  display: flex;
  flex-wrap: wrap;
}

#explore-page-grid a {
  display: inline-block;
  margin-bottom: 8px;
  width: calc(50% - 4px);
  margin-right: 8px;
  text-decoration: none;
  color: black;
}

#explore-page-grid a:nth-of-type(2n) {
  margin-right: 0;
}

@media screen and (min-width: 50em) {
  #explore-page-grid a {
    width: calc(25% - 6px);
  }
  
  #explore-page-grid a:nth-of-type(2n) {
    margin-right: 8px;
  }
  
  #explore-page-grid a:nth-of-type(4n) {
    margin-right: 0;
  }
}

#explore-page-grid a:hover img {
  transform: scale(1.15);
}

#explore-page-grid figure {
  margin: 0;
  overflow: hidden;
  border: 1px dotted gray;
}

#explore-page-grid figcaption {
  margin-top: 15px;
}

#explore-page-grid img {
  border: none;
  height: auto;
  display: block;
  background: #ccc;
  transition: transform .2s ease-in-out;
  width: 100%;
}

#explore-page-grid .p a {
  display: inline;
  font-size: 13px;
  margin: 0;
  text-decoration: underline;
  color: blue;
}

#explore-page-grid .p {
  text-align: center;
  font-size: 13px;
  padding-top: 100px;
}
</style>
	<div id="explore-page-grid">
		@foreach ($posts as $post)
		  <a href="{{asset('/img/posts-images')}}/{{ $post->resources[0]['resource_name'] }}">
		    <figure>
			<img src="{{asset('/img/posts-images')}}/{{ $post->resources[0]['resource_name'] }}" alt="">
		      <figcaption>
		        {{ $post->title }}
		      </figcaption>
		    </figure>
		  </a>	
		@endforeach
	</div>


	<!-- pagination div -->
	<div id="pagination-div">{{ $posts->links() }}</div>	
</div>
@endsection

