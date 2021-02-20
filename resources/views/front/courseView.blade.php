@extends('layouts.front')

@section('title', 'Courses')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!--page-banner-area start-->
<div class="page-banner height-200 bg-1">
	<div class="d-table">
		<div class="page-title vertical-middle text-center">
			<h2>Courses</h2>
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
						<li>Courses</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!--breadcrumb-area end-->

<!--course-area start-->
<div class="course-area mt-70">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<div class="site-sidebar">
					<form id="coursefilterform" method="get">
						<!--search-->
						<div class="sidebar-search">
							<input id="filter_course_name" class="filter_course" type="text" placeholder="Search Course Name" name="course_name_text" value="<?php echo (isset($_GET['course_name_text']) && !empty($_GET['course_name_text'])) ? $_GET['course_name_text']  : '' ;?>"/>

							<input id="filter_course_name_id"  name="course_name" value="<?php echo (isset($_GET['course_name']) && !empty($_GET['course_name'])) ? $_GET['course_name']  : '' ;?>" type="hidden" >
							<button><i class="fa fa-search"></i></button>
						</div>
						<!--category-->
						<div class="sidebar-category mt-25">
							<h3 class="sidebar-title">Categories</h3>
							<ul class="list-none">
								@foreach ($categories as $category)
									<input type="checkbox" class="filter_course" name="category_id[]" value="{{$category->id}}" <?php echo (isset($_GET['category_id']) && !empty($_GET['category_id']) && in_array($category->id,$_GET['category_id'])) ? 'checked=checked' : '' ;?>>
									<label class="labelOwnership">{{$category->name}}</label><br>
								@endforeach
							</ul>
						</div>
					</form>											
				</div>
			</div>
			<div class="col-lg-9 mt-sm-50 courseView">
				<div class="row align-items-center mb-30">
					<div class="col-xl-7 col-sm-6"></div>
					<div class="col-xl-5 col-md-6">
						<div class="site-pagination on-top pull-right">
						</div>
						<div class="product-results pull-right">
							<span>Showing {{ $courses->total() }} results</span>
						</div>
					</div>
				</div>
				<div class="tab-content">
					<div id="list-courses" class="infinite-scroll-course">
						<div class="row">
							@foreach($courses as $key => $course)
								<div class="col-lg-12 mt-30">
									<div class="course-single list-view">
										<div class="course-info" style="border-left: 1px solid #ebebeb !important; width: 100% !important">
											<div class="course-text mt-10">
												<div class="table-view">
													<div class="table-cell pr-10">
														<h3><a href="{{url('/course/'.$course->slug)}}">{{ $course->name }}</a></h3>
													</div>
												</div>
												<p>{!!  substr(strip_tags($course->short_description), 0, 150) !!}</p>
											</div>
										</div>
									</div>
								</div>
							@endforeach
							{!! $courses->links("pagination::bootstrap-4") !!}
						</div>
					</div>
				</div>
				<div class="row align-items-center mt-30">
					<div class="col-lg-6">
						<div class="site-pagination">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="product-results pull-right">
							<span>Showing {{ $courses->total() }} results</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--course-area end-->

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="{{asset('js/scroll.js')}}"></script>
<script type="text/javascript">
    $('ul.pagination').hide();
    $('.infinite-scroll-course').jscroll({
        autoTrigger: true,
        debug: true,
        loadingHtml: '<img class="center-block" src="http://localhost/New_Education/public/FrontDesign/images/1.gif" width="100px" alt="Loading..." />',
        padding: 0,
        nextSelector: '.pagination li.active + li a',
        contentSelector: 'div.infinite-scroll',
        callback: function() {
            $('ul.pagination').remove();            
        }
    });
</script>
@stop