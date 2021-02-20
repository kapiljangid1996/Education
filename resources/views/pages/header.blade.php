<?php 
	$MenuPagemodel = new App\Models\MenuPage;
?>
<header id="" class="header-area">
	<div class="container-fluid">
		<div class="row height-100 align-items-center">
			<div class="col-xl-2 col-lg-2 col-sm-4 col-4">
				<div class="logo">
					<a href="{{url('/')}}"><img src="{{asset('Uploads/Site/150x100').'/'.$settings->logo}}" /></a>
				</div>
			</div>
			<?php echo front_menu($MenuPagemodel,2,array('main_ul_class'=> '','main_li_class'=>'','child_ul_class'=>'submenu','child_li_class'=>'','sub_child_ul_class'=>'submenu sub-2')); ?>
			<div class="col-xl-3 col-lg-1 col-sm-5 col-5">
				<div class="header-right header_right">
					<div class="register-login register_login">
						<div class="mainmenu mainmenu_class">
							<nav>
								<ul>
									@guest
									@if (Route::has('register'))
										<li><a href="" data-toggle="modal" data-target="#register">Sign up</a></li>
									@endif
										<li><a href="" data-toggle="modal" data-target="#login">Sign in</a></li>
									@else										
										<li><a>{{ Auth::user()->name }}</a>
											<ul class="submenu">
												<li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
													<ul class="submenu sub-2">	</ul>
												</li>
											</ul>
										</li>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
	                                        @csrf
	                                    </form>
									@endguest
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<div class="loader" style="display: none;">
	<img src="{{asset('FrontDesign/images/1.gif')}}" width='100px' id='loader' alt='Loading...' />
</div>

<style>
	.header_right{
		margin-top: 50px;
	}
	.register_login{
		float: right; 
		margin-top: -43px;
	}
	.mainmenu_class{		
		padding-right: 35px;
	}
	.mr-90{
		margin-left: -36px;
	}
</style>