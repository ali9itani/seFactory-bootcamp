@extends('master')
@section('page-title','Connect to')
<!-- add a options menu from a file  -->
@section('header-logout')
		@include('options_menu')
@endsection
@section('body-content')
<div id="connect_to-page-main-container" class="container-980px container-height-default text-align-center">
	<div id="connect_to-page-inner-div">
		<h1>Connect to</h1>
		<p>You did it, you are <b>AWESOME!</b><br/>Connect another one.</p>
		<div id="connect_to-social-buttons-div">
			<!-- facebook connect button -->
			<div>
				<button id="social-fb-btn" disabled class="social-connect-button">
					<i  class="fa fa-facebook-square social-icons"></i>
					Connected to facebook
				</button>
			</div>
			<!-- twitter connect button -->
			<div>
				<button id="social-twtr-btn" disabled class="social-connect-button">
					<i  class="fa fa-twitter social-icons"></i>
					Connected to twitter
				</button>
			</div>
			<!-- instagram connect button -->
			<div>
				<button id="social-insta-btn" class="social-connect-button">
					<i  class="fa fa-instagram social-icons"></i>
					Connect to instagram
				</button>
			</div>
		</div>
		<div id="connect_to-done-div" class="cursor-pointer">
			Done
			<i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
		</div>
	</div>
</div>
@endsection

