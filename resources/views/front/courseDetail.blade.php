@extends('layouts.front')

@section('title')
	{{ $courses[0]->name }}
@stop

@section('content')
<link rel="stylesheet" href="{{asset('css/star.css')}}">
<!--page-banner-area start-->
<div class="page-banner height-200 bg-1">
	<div class="d-table">
		<div class="page-title vertical-middle text-center">
			<h2>{{ $courses[0]->name }}</h2>
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
						<li><a href="{{url('/courses')}}">Courses</a></li>
						<li><i class="fa fa-angle-right"></i></li>
						<li>{{ $courses[0]->name }}</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!--breadcrumb-area end-->

<!--course-details start-->
<div class="course-details-area mt-80">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="course-details mb-40">
					<h2>{{ $courses[0]->name }}</h2>
					<div class="course-info mt-25 mb-50">
						<ul class="list-none">
							<!-- <li>
								<a href="#">Review</a>
								<div class="author-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-half-o"></i>
									<span>(4.5 Rate)</span>
								</div>
							</li> -->
						</ul><hr>

					</div>					
					<div>
						<div>
							{!! $courses[0]->long_description !!}
						</div>
					</div>
				</div>

				<!--rating-box-->
				<!-- <h3>Review and Rating</h3> -->
			</div>
			<div class="col-lg-4">
				<!--course-author-->
				
				<!--author-bio-->
				<!-- <div class="author-bio text-center mt-50">
					<h3>Ms. Lucius</h3>
					<small>Software Engineer</small>
					<img src="{{asset('FrontDesign/images/courses/authors/1.png')}}" alt="" />
					<div class="author-rating">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star-half-o"></i>
						<span>(4.5 Rate)</span>
					</div>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore .</p>
					<div class="social-icons mt-20">
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-linkedin"></i></a>
						<a href="#"><i class="fa fa-instagram"></i></a>
						<a href="#"><i class="fa fa-pinterest"></i></a>
					</div>
				</div> -->
				
				<!--advertisement-->
				<!-- <div class="sidebar-advertisement bg-1 height-250 mt-50">
					<div class="d-table">
						<div class="vertical-middle">
							<h3>Book Store</h3>
							<p>Buy Book Online Now!</p>
							<a href="#" class="btn-common mt-10">Visit Store</a>
						</div>
					</div>
				</div> -->
			</div>
		</div>
	</div>
</div>
<!--course-details end-->
@stop