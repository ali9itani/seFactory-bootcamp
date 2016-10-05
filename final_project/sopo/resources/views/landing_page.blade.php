@extends('master')
@section('page-title','Welcome')
@section('body-content')
<div class="container-980px container-height-default text-align-center">
	<div class="landing-page-body-divs">
		<h1>Social Media Hub</h1>
		<!-- an intro for the website and its purpose -->
		<p class="landing-page-intro-p">A social hub that target all busy clients who has no much time to 
		spend on social media
		</p>
		<p class="landing-page-intro-p">Its a hub for your twitter, facebook and Instagram accounts. Now you
		can keep in touch with all social posts in one place at the same time.
		</p>
		<p class="landing-page-intro-p">It will track how much you spend time on the website, give you 
		statistics and plan with you to decrease that time.
		</p>
	</div>
	<div class="landing-page-body-divs float-right">
		<h1>Get started</h1>
		<!-- login box via twitter or facebook -->
		<div>
			<!-- fb login button-->
			<div>
				<a href="" alt="Facebook login">
					<img id="login-via-fb-img" src="{{ asset('/img/fb_login_button.png') }}" onclick="FB.login()" />
				</a>
			</div>
			<div>
				<p>OR</p>
			</div>
			<!-- twitter login button -->
			<div>
				<a href="" alt="Twitter login">
					<img id="login-via-twtr-img" src="{{ asset('/img/twitter-sign-in-button.png') }}" onclick="" />
				</a>
			</div>
			<div id="status">

			</div>
		</div>

	</div>
</div>
@endsection

