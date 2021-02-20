<footer class="footer-area mt-60">
	<!--footer-top-->
	<div class="footer-top">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-sm-6">
					<div class="company-info">
						<img src="{{asset('Uploads/Site').'/'.$settings->logo}}" alt="logo" />
						<ul class="list-none">
							
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6 px-lg-5">
					<div class="footer-widget">
						<h4>Our Courses</h4>
						<div class="row">
							<div class="col-lg-12 col-sm-12">
								<div class="footer-menu">
									<ul class="list-none">
										@foreach($courses as $course)
											<li><a href="{{url('/course/'.$course->slug)}}">{{$course->name}}</a></li>
										@endforeach
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-sm-6">
					<div class="footer-widget">
						<h4>Featured Colleges</h4>
						<div class="row">
							<div class="col-lg-12 col-sm-12">
								<div class="footer-menu">
									<ul class="list-none">
										@foreach($colleges as $college)
											<li><a href="{{url('/college/'.$college->slug)}}">{{$college->name}}</a></li>
										@endforeach
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget">
						<h4>Details</h4>
						<div class="row">
							<div class="col-lg-12 col-sm-12">
								<div class="footer-menu">
									<ul class="list-none">
										<li>
											<a> {{ $settings->email1 }} </a>
											<a> {{ $settings->email2 ? ','.$settings->email2 : ''}} </a>
										</li>
										<li>
											<a> {{ $settings->contact1 }} </a>
											<a> {{ $settings->contact2 ? ','.$settings->contact2 : ''}} </a>
										</li>
										<li>
											<a> {{ $settings->address1 }} </a> 
											<a> {{ $settings->address2 ? ','.$settings->address2 : ''}} </a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--footer-bottom-->
	<div class="footer-bottom">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6 col-md-6 col-12">
					<div class="copyright-text">
						<p> {{ $settings->footer }} </p>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 d-xs-none">
					<ul class="list-none">
					</ul>
				</div>
			</div>
		</div>
	</div>
</footer>