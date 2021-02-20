@extends('layouts.front')

@section('title', 'Registration Form')

@section('content')

<!--page-banner-area start-->
<div class="page-banner height-200 bg-1">
	<div class="d-table">
		<div class="page-title vertical-middle text-center">
			<h2>Management Bouquet - 2021</h2>
		</div>
	</div>
</div>
<!--page-banner-area end-->
<div style="clear: both;"></div>
<br><br>
<!--contact-us-area start-->
<div class="container">
	<div class="row">
		<div class="col-lg-5 bannerimg">
			<img src="{{asset('FrontDesign/Edufikki_banner.jpeg')}}">
		</div>
		<div class="col-lg-7">
			<div class="contact-form input-form mt-sm-50">
				<form method="POST" action="{{route('student.inquiry.submit')}}">
					@csrf
					<h3 class="text-center">Registration Form</h3><hr>
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
							<input type="text" name="tenth_Percent" placeholder="10th Percentage" value="{{old('tenth_Percent')}}" required />
							{!! $errors->first('tenth_Percent', '<small class="text-danger">:message</small>') !!}
						</div>
						<div class="col-sm-12 mt-30">
							<input type="text" name="twelfth_Percent" placeholder="12th Percentage" value="{{old('twelfth_Percent')}}" required />
							{!! $errors->first('twelfth_Percent', '<small class="text-danger">:message</small>') !!}
						</div>
						<div class="col-sm-12 mt-30">
							<input type="text" name="graduation_Percent" placeholder="Graduation Percentage" value="{{old('graduation_Percent')}}" required />
							{!! $errors->first('graduation_Percent', '<small class="text-danger">:message</small>') !!}
						</div>
						<input type="hidden" name="type" value="inquiry" />
						<div class="col-sm-12 mt-40">
							<button class="btn-common d-inline-block">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--contact-us-area End-->
@stop