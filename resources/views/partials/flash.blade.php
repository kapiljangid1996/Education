@if (Session::has('success'))
	<div class="alert alert-success alert-dismissible fade show" role="alert" style="margin: 5px; margin-top: 10px" >
		<p>{{ Session::get('success') }}</p>
	</div>
@endif 
@if (Session::has('errors'))
	<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin: 5px; margin-top: 10px">
		<p>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</p>
	</div>
@endif 