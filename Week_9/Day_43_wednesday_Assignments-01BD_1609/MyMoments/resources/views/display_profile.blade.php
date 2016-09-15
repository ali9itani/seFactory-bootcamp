@extends('master')
@section('title','my profile')
@section('content')
<div class="container">
	<div class="row" >
		<div class="row">
			<section class="div-as-link" id="upload-image-section" onclick="window.open('image/upload');">
				<div class="col-xs-3"></div>
				<div id="upload-image-box" class="col-xs-6" >
					<img id="add-image-icon" class="img-responsive" src="/MyMoments/resources/assets/img/plus-5-xxl.png" />
					Tap To Upload Image
				</div>
				<div class="col-xs-3"></div>
			</section>
		</div>
	</div>
</div> 
@endsection