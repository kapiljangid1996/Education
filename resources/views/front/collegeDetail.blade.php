@extends('layouts.front')

@section('title')
	{{ $colleges[0]->name }}
@stop

@section('content')

<link rel="stylesheet" href="{{asset('css/star.css')}}">
<!--page-banner-area start-->
<div class="page-banner height-200 bg-1">
	<div class="d-table">
		<div class="page-title vertical-middle text-center">
			<h2>{{ $colleges[0]->name }}</h2>
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
						<li><a href="{{url('/colleges')}}">Colleges</a></li>
						<li><i class="fa fa-angle-right"></i></li>
						<li>{{ $colleges[0]->name }}</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!--breadcrumb-area end-->

<!--college-details start-->
<div class="course-details-area mt-80">
	<div class="container college-details">
		<div class="row">
			<div class="col-lg-8">
				<div class="course-details mb-40">
					<h2>{{ $colleges[0]->name }}</h2>
					<div class="course-info mt-25 mb-50">
						<ul class="list-none">
							<li>
								<a>{{ $colleges[0]->ownership }}</a>
							</li>
							<li>
								<a href="#">Review</a>
								@php $i = $colleges[0]->avg_rating; @endphp
								<div class="author-rating">
									@while($i>0)
										@if($i >0.5)
											<i class="fa fa-star" style="color: orange"></i>
										@else
											<i class="fa fa-star-half" style="color: orange"></i>
										@endif
										@php $i--; @endphp
									@endwhile
									<span>({{$colleges[0]->avg_rating}})</span>
								</div>
							</li>
						</ul>
					</div>
					<img src="{{asset('Uploads/College/Image/').'/'.$colleges[0]->image}}" class="mb-40" />

					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
						</li>
						@if(!empty($colleges[0]->course_fee[0]))
							<li class="nav-item">
								<a class="nav-link" id="course_fee-tab" data-toggle="tab" href="#course_fee" role="tab" aria-controls="course_fee" aria-selected="true">Courses & Fees</a>
							</li>
						@endif
						@if(!empty($colleges[0]->admission[0]))
							<li class="nav-item">
								<a class="nav-link" id="admission-tab" data-toggle="tab" href="#admission" role="tab" aria-controls="admission" aria-selected="true">Admission</a>
							</li>
						@endif
						@if(!empty($colleges[0]->placement[0]))
							<li class="nav-item">
								<a class="nav-link" id="placement-tab" data-toggle="tab" href="#placement" role="tab" aria-controls="placement" aria-selected="true">Placement</a>
							</li>
						@endif
						@if(!empty($colleges[0]->cut_off[0]))
							<li class="nav-item">
								<a class="nav-link" id="cut_off-tab" data-toggle="tab" href="#cut_off" role="tab" aria-controls="cut_off" aria-selected="true">Cut-Offs</a>
							</li>
						@endif
						@if(!empty($colleges[0]->infrastructure[0]))
							<li class="nav-item">
								<a class="nav-link" id="infrastructure-tab" data-toggle="tab" href="#infrastructure" role="tab" aria-controls="infrastructure" aria-selected="true">Infrastructure</a>
							</li>
						@endif
					</ul>
					
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active mt-30" id="description" role="tabpanel" aria-labelledby="description-tab">
							{!! $colleges[0]->long_description !!}
						</div>
						<div class="tab-pane fade" id="admission" role="tabpanel" aria-labelledby="admission-tab">
							@foreach($colleges as $college)
								@foreach($college->admission as $key => $collegeAdmission)
									{!! $collegeAdmission->long_description !!}
								@endforeach
							@endforeach
						</div>
						<div class="tab-pane fade" id="course_fee" role="tabpanel" aria-labelledby="course_fee-tab">
							<div class="container">
								<div class="row">
									<h4 style="margin-left: 25px">{{ $colleges[0]->name }}, Courses and Fee Structure</h4><hr>
									@foreach($colleges as $college)
										@foreach($college->course_fee as $key => $collegeCourseFee)
											<div class="col-lg-12 mt-30">
												<div class="course-single list-view">
													<div class="course-info" style="border-left: 1px solid #ebebeb !important; width: 100% !important">
														<div class="course-text mt-10">
															<div class="table-view">
																<div class="table-cell pr-10">
																	@foreach($courses as $course)
																		@if($course->id == $collegeCourseFee->course_id)
																			<a href="#">																
																				{{ $course->name }}														
																			</a>
																		@endif
																	@endforeach
																</div>
															</div>
															<div class="course-meta">
																<a><i class="fa fa-book"></i>{{ $collegeCourseFee->name }}</a>
																<a><i class="fa fa-calendar"></i>{{ $collegeCourseFee->duration }}</a>
																<a><i class="fa fa-money"></i>{{ $collegeCourseFee->fee }}</a>
																<a><i class="fa fa-chair"></i>Seats : {{ $collegeCourseFee->seats }}</a>
															</div>
															<p>{{ $collegeCourseFee->short_description }}</p>
														</div>
													</div>
												</div>
											</div>
										@endforeach
									@endforeach
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="placement" role="tabpanel" aria-labelledby="placement-tab">
							@foreach($colleges as $college)
						        	@foreach($college->placement as $key => $collegePlacement)
						        		{!! $collegePlacement->long_description !!}
					        	@endforeach
					        @endforeach
						</div>
						<div class="tab-pane fade" id="cut_off" role="tabpanel" aria-labelledby="cut_off-tab">
							@foreach($colleges as $college)
						        	@foreach($college->cut_off as $key => $collegeCutOff)
						        		{!! $collegeCutOff->long_description !!}
					        	@endforeach
					        @endforeach
						</div>
						<div class="tab-pane fade" id="infrastructure" role="tabpanel" aria-labelledby="infrastructure-tab">
							<table class="table">
								<tr>
						            <th colspan="2">Infrastructure/Facilities</th>
						        </tr>
						        @foreach($colleges as $college)
						        	@foreach($college->infrastructure as $key => $collegeInfrastructure)
								        <tr>
								        	<td style="width: 100px; text-align: center;">
								        		@if($collegeInfrastructure['name'] == "Library" or $collegeInfrastructure['name'] == "library")
								        			<span><img src="{{asset('FrontDesign/images/education/books.png')}}" style="margin-bottom: 15px; width: 55px; height: 50px;"></span>
								        			{{$collegeInfrastructure['name']}}
								        		@elseif($collegeInfrastructure['name'] == "Hostel" or $collegeInfrastructure['name'] == "hostel")
								        			<span><img src="{{asset('FrontDesign/images/education/hostel.png')}}" style="margin-bottom: 15px; width: 55px; height: 50px;"></span>
								        			{{$collegeInfrastructure['name']}}
								        		@elseif($collegeInfrastructure['name'] == "Sports Complex" or $collegeInfrastructure['name'] == "sports complex")
								        			<span><img src="{{asset('FrontDesign/images/education/sport.png')}}" style="margin-bottom: 15px; width: 55px; height: 50px;"></span>
								        			{{$collegeInfrastructure['name']}}
								        		@elseif($collegeInfrastructure['name'] == "Labs" or $collegeInfrastructure['name'] == "labs")
								        			<span><img src="{{asset('FrontDesign/images/education/flask.png')}}" style="margin-bottom: 15px; width: 55px; height: 50px;"></span>
								        			{{$collegeInfrastructure['name']}}
								        		@elseif($collegeInfrastructure['name'] == "Cafeteria" or $collegeInfrastructure['name'] == "cafeteria")
								        			<span><img src="{{asset('FrontDesign/images/education/cafe.png')}}" style="margin-bottom: 15px; width: 55px; height: 50px;"></span>
								        			{{$collegeInfrastructure['name']}}
								        		@elseif($collegeInfrastructure['name'] == "Gym" or $collegeInfrastructure['name'] == "gym")
								        			<span><img src="{{asset('FrontDesign/images/education/fitness.png')}}" style="margin-bottom: 15px; width: 55px; height: 50px;"></span>
								        			{{$collegeInfrastructure['name']}}
								        		@elseif($collegeInfrastructure['name'] == "Hospital / Medical Facilities" or $collegeInfrastructure['name'] == "hospital / medical facilities")
								        			<span><img src="{{asset('FrontDesign/images/education/hospital.png')}}" style="margin-bottom: 15px; width: 55px; height: 50px;"></span>
								        			{{$collegeInfrastructure['name']}}
								        		@elseif($collegeInfrastructure['name'] == "Wi-Fi Campus" or $collegeInfrastructure['name'] == "wi-fi campus")
								        			<span><img src="{{asset('FrontDesign/images/education/wifi-signal.png')}}" style="margin-bottom: 15px; width: 55px; height: 50px;"></span>
								        			{{$collegeInfrastructure['name']}}
								        		@elseif($collegeInfrastructure['name'] == "Shuttle Service" or $collegeInfrastructure['name'] == "shuttle service")
								        			<span><img src="{{asset('FrontDesign/images/education/shuttle.png')}}" style="margin-bottom: 15px; width: 55px; height: 50px;"></span>
								        			{{$collegeInfrastructure['name']}}
								        		@elseif($collegeInfrastructure['name'] == "Auditorium" or $collegeInfrastructure['name'] == "auditorium")
								        			<span><img src="{{asset('FrontDesign/images/education/hostel.png')}}" style="margin-bottom: 15px; width: 55px; height: 50px;"></span>
								        			{{$collegeInfrastructure['name']}}
								        		@elseif($collegeInfrastructure['name'] == "Convenience Store" or $collegeInfrastructure['name'] == "convenience store")
								        			<span><img src="{{asset('FrontDesign/images/education/store.png')}}" style="margin-bottom: 15px; width: 55px; height: 50px;"></span>
								        			{{$collegeInfrastructure['name']}}
								        		@elseif($collegeInfrastructure['name'] == "Other Facilities")
								        			Other Facilities
								        		@endif
								        	</td>
								        	<td>
								        		{{$collegeInfrastructure['long_description']}}
								        	</td>
								        </tr>
						        	@endforeach
						        @endforeach
							</table>
						</div>
					</div>
				</div>

				<!--rating-box-->
				<!-- <h3>Review and Rating</h3> -->
				<!-- <div class="rating-box mt-25"> -->
					<!-- <div class="row"> -->
						<!-- <div class="col-lg-3">
							<div class="rating-number d-table">
								<div class="vertical-middle">
									<h5>4.0</h5>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
									<p>Average Rating</p>
								</div>
							</div>
						</div> -->
						<!-- <div class="col-lg-9 mt-sm-40"> -->
							<!--rating-line-->
							<!-- <div class="row">
								<div class="col-xl-2 col-lg-3 col-4">
									<strong>5 stars</strong>
								</div>
								<div class="col-xl-8 col-lg-7 col-5">
									<div class="single-progress">
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="20"
											aria-valuemin="0" aria-valuemax="100" style="width:20%">
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-2 col-lg-2 col-2">
									<span>1</span>
								</div>
							</div> -->
							<!--rating-line-->
							<!-- <div class="row">
								<div class="col-xl-2 col-lg-3 col-4">
									<strong>4 stars</strong>
								</div>
								<div class="col-xl-8 col-lg-7 col-5">
									<div class="single-progress">
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="20"
											aria-valuemin="0" aria-valuemax="100" style="width:20%">
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-2 col-lg-2 col-2">
									<span>1</span>
								</div>
							</div> -->
							<!--rating-line-->
							<!-- <div class="row">
								<div class="col-xl-2 col-lg-3 col-4">
									<strong>3 stars</strong>
								</div>
								<div class="col-xl-8 col-lg-7 col-5">
									<div class="single-progress">
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="20"
											aria-valuemin="0" aria-valuemax="100" style="width:20%">
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-2 col-lg-2 col-2">
									<span>1</span>
								</div>
							</div> -->
							<!--rating-line-->
							<!-- <div class="row">
								<div class="col-xl-2 col-lg-3 col-4">
									<strong>2 stars</strong>
								</div>
								<div class="col-xl-8 col-lg-7 col-5">
									<div class="single-progress">
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="0"
											aria-valuemin="0" aria-valuemax="100" style="width:0%">
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-2 col-lg-2 col-2">
									<span>0</span>
								</div>
							</div> -->
							<!--rating-line-->
							<!-- <div class="row">
								<div class="col-xl-2 col-lg-3 col-4">
									<strong>1 star</strong>
								</div>
								<div class="col-xl-8 col-lg-7 col-5">
									<div class="single-progress">
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="0"
											aria-valuemin="0" aria-valuemax="100" style="width:0%">
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-2 col-lg-2 col-2">
									<span>0</span>
								</div>
							</div> -->
						<!-- </div> -->
					<!-- </div> -->
				<!-- </div> -->
				<div class="student-reviews mt-20">
					<h3>Review and Rating</h3>
					<ul class="list-none">
						@foreach($colleges as $college)
							@foreach($college->reviews as $review)
								<li>
									<div class="student-thumb">
										<a href="#"><img src="{{asset('FrontDesign/images/courses/students/1.png')}}" alt="" /></a>
										<a href="#">{{ $review->user->name }}</a>
										<small>{{ \Carbon\Carbon::parse($review->created_st)->format('d F, Y')}} </small>
									</div>
									@php $i = $review->rating; @endphp
									<div class="student-review">
										<div class="students-rating">
											<i class="fa fa-star" style="color: lightgray;"></i>
											<i class="fa fa-star" style="color: lightgray;"></i>
											<i class="fa fa-star" style="color: lightgray;"></i>
											<i class="fa fa-star" style="color: lightgray;"></i>
											<i class="fa fa-star" style="color: lightgray;"></i>
											<span class="small">({{ $i }})</span>
										</div>
										<div class="students-rating" style="position: relative; top: -32px;">
											@while($i>0)
												@if($i >0.5)
													<i class="fa fa-star" style="color: orange"></i>
												@else
													<i class="fa fa-star-half" style="color: orange"></i>
												@endif
												@php $i--; @endphp
											@endwhile
										</div>
										<p>{{$review->description}}</p>
									</div>
								</li>
							@endforeach
						@endforeach
					</ul>
				</div>
			</div>
			<div class="col-lg-4">
				<!--college-features-->
				<div class="course-features mt-sm-40 text-center">
					<ul class="list-none">
						<li>
							<p>{{ $colleges[0]->name }}</p>
						</li>
						<li>
							<span><i class="fa fa-bank"></i>Ownership</span>
							<span>{{ $colleges[0]->ownership }}</span>
						</li>
						<li>
							<span><i class="fa fa-building-o"></i>State</span>
							<span>{{ $colleges[0]->state_name->name }}</span>
						</li>
						<li>
							<span><i class="fa fa-building-o"></i>City</span>
							<span>{{ $colleges[0]->city_name->name }}</span>
						</li>
						<li>
							<span><i class="fa fa-address-card-o"></i>Street</span>
							<span style="width: 175px;">{{ $colleges[0]->street }}</span>
						</li>
						<li>
							<span><i class="fa fa-comments-o"></i>Post Code</span>
							<span>{{ $colleges[0]->post_code }}</span>
						</li>
						<li>
							<span><i class="fa fa-globe"></i>Website</span>
							<span>{{ $colleges[0]->website }}</span>
						</li>
					</ul>
				</div>
				<!--course-author-->
				
				<!--reviews-->
				<div class="author-bio text-center mt-50">
					@if(auth()->check())                
                   	<div>
                   		<a href="" class="primary-btn text-right text-uppercase" data-toggle="modal" data-target="#modalform1">Write a Review</a>
                   	</div>                
                	@else
                    	<a href="#" data-toggle="modal" data-target="#login" class="primary-btn text-right text-uppercase">Write a Review</a>
                	@endif
				</div>
				
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
<!--college-details end-->

<div class="modal fade" id="modalform1" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header text-center">
				<h4 class="modal-title w-100 font-weight-bold">Ratings</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="{{route('review.submit')}}" method="POST">
				@csrf
				<div class="modal-body mx-3">
					<div class="md-form mb-3" style="padding: 15px;">
						<i class="fa fa-star"></i>&nbsp;&nbsp;<label data-error="wrong" data-success="right" for="orangeForm-name">Provide Rating</label><br>
						<fieldset class="rate">
							<input type="radio" id="rating10" name="rating" value="5" /><label for="rating10" title="5 stars"></label>
							<input type="radio" id="rating9" name="rating" value="4.5" /><label class="half" for="rating9" title="4.5 stars"></label>
							<input type="radio" id="rating8" name="rating" value="4" /><label for="rating8" title="4 stars"></label>
							<input type="radio" id="rating7" name="rating" value="3.5" /><label class="half" for="rating7" title="3.5 stars"></label>
							<input type="radio" id="rating6" name="rating" value="3" /><label for="rating6" title="3 stars"></label>
							<input type="radio" id="rating5" name="rating" value="2.5" /><label class="half" for="rating5" title="2.5 stars"></label>
							<input type="radio" id="rating4" name="rating" value="2" /><label for="rating4" title="2 stars"></label>
							<input type="radio" id="rating3" name="rating" value="1.5" /><label class="half" for="rating3" title="1.5 stars"></label>
							<input type="radio" id="rating2" name="rating" value="1" /><label for="rating2" title="1 star"></label>
							<input type="radio" id="rating1" name="rating" value="0.5" /><label class="half" for="rating1" title="0.5 star"></label>
						</fieldset>
					</div>
					<div class="md-form mb-5">
						<i class="fa fa-paragraph"></i>&nbsp;&nbsp;<label data-error="wrong" data-success="right" for="orangeForm-name">Headline</label>
						<input type="text" id="orangeForm-name" name="headline" class="form-control validate"> 
					</div>
					<div class="md-form mb-5">
						<i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;<label data-error="wrong" data-success="right" for="orangeForm-name">Tell us more</label>
						<textarea id="orangeForm-description" name="description" class="form-control validate"></textarea>
					</div>
					<input type="hidden" name="college_id" value="{{ $colleges[0]->id }}">
					@guest
						<input type="hidden" name="user_id" value="">
					@else
						<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
					@endguest
				</div>
				<div class="modal-footer d-flex justify-content-center">
					<button class="btn btn-success">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
  	var logID = 'log',
  	log = $('<div id="'+logID+'"></div>');
	$('.star').append(log);
  	$('[type*="radio"]').change(function () {
    	var me = $(this);
    	log.html(me.attr('value'));
  	});
</script>
@stop