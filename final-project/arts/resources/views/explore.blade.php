@extends('master')
@section('page-title','Explore')
@section('body-content')
<div id="explore-body-container" class="container-height-default text-align-center">
	<div class="container">
    @foreach ($posts as $post)
        {{ $post }}
        <br/>
        <br/>
    @endforeach
	</div>


	<!-- pagination div -->
	<div id="pagination-div">{{ $posts->links() }}</div>	
</div>
@endsection

