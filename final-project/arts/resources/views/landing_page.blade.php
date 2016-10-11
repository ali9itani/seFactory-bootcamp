@extends('master')
@section('page-title','Welcome')
@section('body-content')
<style type="text/css">
	body {
		background-repeat: no-repeat;
		background-size: cover;
		background-image: linear-gradient(to bottom, rgba(133,80,133, 0.5), rgba(0, 0, 0, 0.5)), url('img/background.jpg');
	}
	footer {
		color: white;
	}
</style>
<div id="landing-page-body-container" class="container-980px container-height-default text-align-center">
	<div class="landing-page-body-divs">
		<h1>Our arts platform</h1>
		<!-- an intro for the website and its purpose -->
		<p class="landing-page-intro-p">A social hub that target all busy clients who has no much time to 
		spend on social media
		</p>
		<p class="landing-page-intro-p">Its a hub for your twitter, facebook and Instagram accounts. Now you
		can keep in touch with all social posts in one place at the same time.
		</p>
		<p class="landing-page-intro-p">It will track how much you spend time on the website, give you 
		statistics
		</p>
		<p class="landing-page-intro-p">It will track how much you spend time on the website
		</p>
	</div>
	<!-- list of buttons to connect to different social media  -->
	<div class="landing-page-body-divs float-right">
		<h1>Become an artist</h1>
		<!-- signup new artist account -->
		<div>
			@include('auth/register')
		</div>

	</div>
</div>
@endsection

