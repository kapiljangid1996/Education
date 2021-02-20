@extends('layouts.front')

@section('title', 'Contact Us')

@section('content')

<!--page-banner-area start-->
<div class="page-banner height-200 bg-1">
	<div class="d-table">
		<div class="page-title vertical-middle text-center">
			<h2>Contact Us</h2>
		</div>
	</div>
</div>
<!--page-banner-area end-->

<!--breadcrumb-area start-->
<div class="breadcrumb-area mt-25">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="site-breadcrumb">
					<ul class="list-none">
						<li><a href="{{url('/')}}">Home</a></li>
						<li><i class="fa fa-angle-right"></i></li>
						<li><a href="{{url('/colleges')}}">Contact Us</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!--breadcrumb-area end-->

<!--contact-us-area start-->
<div class="container">
	<div class="row">
		<div class="col-lg-3"></div>
		<div class="col-lg-6 text-center">
			<div class="contact-form input-form mt-sm-50">
				<form method="POST" action="{{route('contact.submit')}}">
					@csrf
					<h3>Contact Us Form</h3><hr>
					<div class="row">
						<div class="col-sm-12">
							<input type="text" name="name" placeholder="Name" value="{{old('name')}}" required />
							{!! $errors->first('name', '<small class="text-danger">:message</small>') !!}
						</div>
						<div class="col-sm-12 mt-30">
							<input type="text" name="email" placeholder="Email" value="{{old('email')}}" required />
							{!! $errors->first('email', '<small class="text-danger">:message</small>') !!}
						</div>
						<div class="col-sm-12 mt-30">
							<input type="text" name="contact" placeholder="Contact Number" value="{{old('contact')}}" required />
							{!! $errors->first('contact', '<small class="text-danger">:message</small>') !!}
						</div>
						<div class="col-sm-12 mt-30">
							<select id="opt" name="city" class="form-control" autocomplete="on" required>
								<option>Choose City</option>
								@foreach($city_list as $city)
									<option value="{{ $city->name }}">{{ $city->name }}</option>
								@endforeach
							</select>
							{!! $errors->first('city', '<small class="text-danger">:message</small>') !!}
						</div>
						<div class="col-sm-12 mt-30">
							<input type="text" name="tenth_Percent" placeholder="10th %" value="{{old('tenth_Percent')}}" required />
							{!! $errors->first('tenth_Percent', '<small class="text-danger">:message</small>') !!}
						</div>
						<div class="col-sm-12 mt-30">
							<input type="text" name="twelfth_Percent" placeholder="12th %" value="{{old('twelfth_Percent')}}" required />
							{!! $errors->first('twelfth_Percent', '<small class="text-danger">:message</small>') !!}
						</div>
						<div class="col-sm-12 mt-30">
							<input type="text" name="graduation_Percent" placeholder="Graduation %" value="{{old('graduation_Percent')}}" required />
							{!! $errors->first('graduation_Percent', '<small class="text-danger">:message</small>') !!}
						</div>
						<div class="col-sm-12 mt-30">
							<script src="https://www.google.com/recaptcha/api.js" async defer></script>
							<?php 
								$google_captcha_site_key = "6LdDQVMaAAAAACIiLvivR92QtZxDx1GFpxliON7m"; // previewsourceart key
							?>
							<div class="g-recaptcha" data-sitekey="<?php echo $google_captcha_site_key; ?>"></div>
						</div>
						<input type="hidden" name="type" value="contact" />
						<div class="col-sm-12 mt-40">
							<button class="btn-common d-inline-block">Send message</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="col-lg-3"></div>
	</div>
</div>
<!--contact-us-area End-->
@stop