@extends('master')
@section('page-title','Wall')
<!-- add a options menu from a file  -->
@section('header-logout')
		@include('options_menu')
@endsection
@section('body-content')
<style type="text/css">
.container-height-default {
    height: 100%;
}
</style>
<div id="wall-page-main-container" class="container-980px container-height-default text-align-center">
	<!-- wall that contains all posts -->
	<div id="wall-page-wall-div">
		<div class="wall-page-post-div">
			<img class="wall-page-post-profile-image float-left" src="{{ asset('/img/logo.png') }}" />
			<!-- post username and location if exit, time , additional info  -->
			<div class="wall-page-post-info float-left">
				<div>
					<p class="wall-page-post-username float-left">username</p>
					<i class="fa fa-map-marker float-left" aria-hidden="true"></i>
					<p class="float-right wall-page-post-time">2 hrs</p>
				</div>
				<div class="clearfix"></div>
				<p class="wall-page-post-additional-info float-left">(shared from x / retweeted x)</p>
				<i class="fa fa-facebook-square float-right social-i" aria-hidden="true"></i>
			</div>		
			<div class="clearfix"></div>
			<p class="wall-page-post-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</p>
			<img class="wall-page-post-profile-image" src="{{ asset('/img/logo.png') }}" />
			<hr class="horizantal-line-facebook"/>
		</div>

		<div class="wall-page-post-div">
			<img class="wall-page-post-profile-image float-left" src="{{ asset('/img/logo.png') }}" />
			<!-- post username and location if exit, time , additional info  -->
			<div class="wall-page-post-info float-left">
				<div>
					<p class="wall-page-post-username float-left">username</p>
					<i class="fa fa-map-marker float-left" aria-hidden="true"></i>
					<p class="float-right wall-page-post-time">2 hrs</p>
				</div>
				<div class="clearfix"></div>
				<p class="wall-page-post-additional-info float-left">(shared from x / retweeted x)</p>
				<i class="fa fa-twitter-square float-right social-i" aria-hidden="true"></i>
			</div>		
			<div class="clearfix"></div>
			<p class="wall-page-post-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</p>
			<img class="wall-page-post-profile-image" src="{{ asset('/img/logo.png') }}" />
			<hr class="horizantal-line-twitter"/>
		</div>

		<div class="wall-page-post-div">
			<img class="wall-page-post-profile-image float-left" src="{{ asset('/img/logo.png') }}" />
			<!-- post username and location if exit, time , additional info  -->
			<div class="wall-page-post-info float-left">
				<div>
					<p class="wall-page-post-username float-left">username</p>
					<i class="fa fa-map-marker float-left" aria-hidden="true"></i>
					<p class="float-right wall-page-post-time">2 hrs</p>
				</div>
				<div class="clearfix"></div>
				<p class="wall-page-post-additional-info float-left">(shared from x / retweeted x)</p>
				<i class="fa fa-instagram float-right social-i" aria-hidden="true"></i>
			</div>		
			<div class="clearfix"></div>
			<p class="wall-page-post-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</p>
			<img class="wall-page-post-profile-image" src="{{ asset('/img/logo.png') }}" />
			<hr class="horizantal-line-instagram"/>
		</div>
	</div>
</div>
@endsection

