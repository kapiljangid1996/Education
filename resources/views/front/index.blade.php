@extends('layouts.front')  

@section('title', 'Home')

@section('content')
<!--banner-area start-->
<div class="slider">		
	<div class="slider">		
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<?php $i=0 ?>
				@foreach($sliders as $key => $slider)
					<li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i++ ?>" class="{{$key == 0 ? 'active' : '' }}"></li>
				@endforeach
			</ol>
			<div class="carousel-inner">
				@foreach($sliders as $key => $slider)
					<div class="carousel-item {{$key == 0 ? 'active' : '' }}">
						<img class="d-block w-100" src="{{asset('Uploads/Slider/1920x570').'/'.$slider->image}}" height="550px">
						<div class="carousel-caption d-none d-md-block">
							<h5 style="color: white">{{ $slider->button_text }}</h5>
						</div>
					</div>
				@endforeach
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			</a>
		</div>	
	</div>
</div>
<div class="container-fluid top-slider-text text-center">
	<div class="row">
		<div class="col-lg-10">
			<div class="banner-inner slider-text-style text-center">
				<div class="banner-text">
					<h1 style="color: white">Find Colleges Online</h1>
					<p style="color: white">Discover over 10,000 courses from 6,500 education providers in India</p>
				</div>
				<div class="mt-40">
					<div class="form-group search-edutab">
						<nav>
							<div class="nav nav-tabs edutab-color" id="nav-tab " role="tablist" style="border: none !important;">
								<a class="nav-item nav-link active" style="border: none !important;" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">College</a>
								<a class="nav-item nav-link" style="border: none !important;" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Course</a>
								<!-- <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Exams</a> -->
							</div>
						</nav>
						<div class="tab-content" id="nav-tabContent" style="padding-top: 2.5px;">
							<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
								<input type="text" id="livesearchcollege" searchdata="college" class="form-control input-lg searchresult" placeholder="Enter College Name">
							</div>
							<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
								<input type="text" name="course_search" searchdata="course" id="livesearchcourse"  class="form-control input-lg searchresult"  placeholder="Enter Course Name">
							</div>
							<!-- <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
								
							</div> -->
						</div>
						
						<div id="searchlist"></div>
						{{ csrf_field() }}
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>
<div style="clear: both;"></div>
<div class="courses-area pb-30 fix mt-60 educourse">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title text-center">
					<h2>Featured Colleges</h2>
				</div>
			</div>
		</div>		
		<!--single-tab-->
		<div class="container">
			<div class="row">
				@foreach($colleges as $key => $college)
					<div class="col-lg-4">
						<div class="course-single"><br>
							<div class="course-thumb">
								<a href="{{url('/college/'.$college->slug)}}"><img src="{{asset('Uploads/College/Image/400x200/').'/'.$college->image}}" style="height: 225px;"></a>
							</div>
							<div class="course-info">
								<div class="author-info">
									<div class="author-name">
										<img src="{{asset('Uploads/College/Logo/').'/'.$college->logo}}" alt="" />
										<a href="{{url('/college/'.$college->slug)}}">{{$college->name}}</a>
										<p style="margin-left: 22%">{{$college->city_name->name}}, {{$college->state_name->name}}</p>
									</div>
								</div>
								<div class="course-text mt-10">
									<p>{!!  substr(strip_tags($college->short_description), 0, 90) !!}</p>
								</div>
							</div>
							<div class="course-meta"></div>
						</div>
					</div>
				@endforeach
			</div>
		</div>		
	</div>
</div>

<!--subscribe-area start-->
<div class="subscribe-area overlay mt-80">
	<div class="container">
		<div class="row align-items-center height-415">
			<div class="col-lg-8 offset-lg-2">
				<div class="subscribe-form z-index">
					<h3>Subscribe To Our Newletter</h3>
					<p>Subscribe now and receive weekly newsletter with Coaching materials, new courses, interesting posts, popular books and much more!</p>
					<div class="row">
						<div class="col-lg-10 offset-lg-1">
							<form method="POST" action="{{ route('newsletter.store') }}">
								@csrf
								<input type="email" name="email" placeholder="Your Email" />
								<button type="submit" class="btn-common">Subscribe</button>
							</form>							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--subscribe-area end-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){

$('.searchresult').keyup(function(){ 
    var query = $(this).val();
    var type = $(this).attr('searchdata');
    if(query != '')
    {
    	var _token = $('input[name="_token"]').val();
     	$.ajax({
      		url:"{{ route('search') }}",
      		method:"POST",
      		data:{query:query, _token:_token, type:type},
      		success:function(data){
       			$('#searchlist	').fadeIn();  
            	$('#searchlist	').html(data);
      		}
     	});
    }
});

$(document).on('click', 'li', function(){  
   // $('#livesearchcollege').val($(this).text());  
    $('#searchlist	').fadeOut();  
}); 

$('.searchresult').keydown(function(){ 
    $('#searchlist	').fadeOut(); 
}); 

});
</script>
@stop