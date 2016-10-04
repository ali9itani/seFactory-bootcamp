@extends('master')
@section('page-title','Connect to')
@section('header-logout')
<div class="arrow-down"></div>
<div  id="logout-block">
	<div class="arrow-up"></div>
	<div class="logout-menu">
		<ul class="fix-list-ul logout-ul">
			<li onclick="fbLogoutUser()" class="cursor-pointer">Logout</li>
		</ul>
	</div>
</div>
@endsection
@section('body-content')
<div class="container-980px container-height-default text-align-center">
	<div>

	</div>
</div>
@endsection

