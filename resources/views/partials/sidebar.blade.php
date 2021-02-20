<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
	<a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
		<i class="fe fe-x"><span class="sr-only"></span></i>
	</a>
	<nav class="vertnav navbar navbar-light">
		<div class="w-100 mb-4 d-flex">
			<a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{url('/admin')}}">
				<svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
					<g>
						<img src="{{asset('Uploads/Site/150x100/').'/'.$settings->logo}}" alt="" width="150px" height="50px" style="margin-left: -35px;">
					</g>
				</svg>
			</a>
		</div>
		<ul class="navbar-nav flex-fill w-100 mb-2">
			<li class="nav-item w-100">
				<a class="nav-link" href="{{url('/admin')}}">
					<i class="fe fe-home fe-16"></i>
					<span class="ml-3 item-text">Dashboard</span>
				</a>
			</li>
		</ul>
		<p class="text-muted nav-heading mt-4 mb-1"><span>Components</span></p>
		<ul class="navbar-nav flex-fill w-100 mb-2">
			
			<li class="nav-item w-100">
				<a class="nav-link" href="{{url('/admin/menu')}}">
					<i class="fe fe-menu fe-16"></i>
					<span class="ml-3 item-text">Menu Builder</span>
				</a>
			</li>
			<li class="nav-item w-100">
				<a class="nav-link" href="{{url('/admin/slider')}}">
					<i class="fe fe-image fe-16"></i>
					<span class="ml-3 item-text">Slider</span>
				</a>
			</li>
			<li class="nav-item w-100">
				<a class="nav-link" href="{{url('/admin/category')}}">
					<i class="fe fe-layers fe-16"></i>
					<span class="ml-3 item-text">Category</span>
				</a>
			</li>
			<li class="nav-item w-100">
				<a class="nav-link" href="{{url('/admin/course')}}">
					<i class="fe fe-book-open fe-16"></i>
					<span class="ml-3 item-text">Course</span>
				</a>
			</li>
			<li class="nav-item w-100">
				<a class="nav-link" href="{{url('/admin/exam')}}">
					<i class="fe fe-book fe-16"></i>
					<span class="ml-3 item-text">Exam</span>
				</a>
			</li>
			<li class="nav-item w-100">
				<a class="nav-link" href="{{url('/admin/college')}}">
					<i class="fe fe-home fe-16"></i>
					<span class="ml-3 item-text">College</span>
				</a>
			</li>
			<li class="nav-item w-100">
				<a class="nav-link" href="{{url('/admin/newsLetter-list')}}">
					<i class="fe fe-file-plus fe-16"></i>
					<span class="ml-3 item-text">Newsletter</span>
				</a>
			</li>
			<li class="nav-item w-100">
				<a class="nav-link" href="{{url('/admin/contact-list')}}">
					<i class="fe fe-phone fe-16"></i>
					<span class="ml-3 item-text">Contact</span>
				</a>
			</li>
			<li class="nav-item w-100">
				<a class="nav-link" href="{{url('/admin/setting')}}">
					<i class="fe fe-settings fe-16"></i>
					<span class="ml-3 item-text">Settings</span>
				</a>
			</li>
		</ul>
	</nav>
</aside>