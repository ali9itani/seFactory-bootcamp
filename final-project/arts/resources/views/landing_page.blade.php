@extends('master')
@section('page-title','Welcome')
@section('body-content')
<style type="text/css">
	#content {
		background-repeat: no-repeat;
		background-size: cover;
		background-image: linear-gradient(to bottom, rgba(133,80,133, 0.5), rgba(0, 0, 0, 0.5)), url('img/background.jpg');
	}

	body {
        background-repeat: no-repeat;
        background-size: cover;
        background-image: linear-gradient(to bottom, rgba(133,80,133, 0.5), rgba(0, 0, 0, 0.5)), url('img/background.jpg');
    }
    footer {
        color: white;
    }
    header .navbar-inverse {
      background-color: rgba( 24, 41, 69, 0.5);
    }   
	.landing-page-body-divs:nth-child(2) {
		right: 110px;
		position: relative;
	}
</style>
<div id="landing-page-body-container" class="container-980px container-height-default text-align-center row container">
	<div class="landing-page-body-divs xs-hidden" >
		<h1>Our arts platform</h1>
		<!-- an intro for the website and its purpose -->
		<p class="landing-page-intro-p">DotArts a web platform dedicate for visual artists and arts
		</p>
		<p class="landing-page-intro-p">Its a social media look like, where you can share your art
		and it
		</p>
		<p class="landing-page-intro-p">It connect you with your audience and other artists, so you
		 can get benefit of their feedback or at least you can get inspired by other artists
		</p>
		<p class="landing-page-intro-p">It supports up/down voting  mechanism that helps you knowing
		 what your audience like and don't 
		</p>
	</div>
	<!-- list of buttons to connect to different social media  -->
	<div class="landing-page-body-divs float-right" style="">
		<h1>Become an artist</h1>
		<!-- signup new artist account -->
		<div>
			@include('auth/register')
		</div>

	</div>
</div>
@endsection

