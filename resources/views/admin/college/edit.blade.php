@extends('layouts.admin')

@section('title','Edit College')

@section('breadcrumb')
<div class="row align-items-center mb-2">
	<div class="col">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="{{url('/admin/college')}}">College</a></li>
				<li class="breadcrumb-item active" aria-current="category">Edit College</li>
			</ol>
		</nav>
	</div>
</div>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card shadow mb-4">
			<div class="card-header">
				<strong class="card-title">Edit College</strong>
			</div>
			<div class="card-body">
				<form action="{{ route('college.update',$colleges->id) }}" method="POST" enctype="multipart/form-data" class="form-group">
					@csrf
					@method('PUT')
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name" name="name" value="{{$colleges->name}}">
							{!! $errors->first('name', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="slug" class="col-sm-2 col-form-label">Slug</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="slug" name="slug" value="{{$colleges->slug}}">
							{!! $errors->first('slug', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="category_id" class="col-sm-2 col-form-label">Category</label>
						<div class="col-sm-10">
							<select class="form-control" name="category_id[]" multiple="">
								<option value="" disabled>Chooose Category</option>
								@foreach ($categories as $category)
									<option value="{{ $category->id }}" @foreach ($colleges->category_list as $cat) {{ $category->id === $cat->category_id ? 'selected' : '' }}  @endforeach>{{ $category->name }}</option>
								@endforeach
							</select>
							{!! $errors->first('category_id', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="ownership" class="col-sm-2 col-form-label">Ownership</label>
						<div class="col-sm-10">
							<select class="form-control" name="ownership">
								<option value="" disabled>Choose Ownership</option>
								<option value="Private" {{ $colleges->ownership == "Private" ? 'selected' : '' }}>Private</option>
                                <option value="Public / Government" {{ $colleges->ownership == "Public / Government" ? 'selected' : '' }}>Public / Government</option>
								<option value="Public Private" {{ $colleges->ownership == "Public Private" ? 'selected' : '' }}>Public Private</option>
							</select>
							{!! $errors->first('ownership', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>				
					<div class="form-group row">
						<label for="location" class="col-sm-2 col-form-label">Location</label>
						<div class="col-sm-10">
							<select name ="state" class="form-control" id="state_id">
								<option>Select State</option>
								@foreach($state_list as $states)
									<option value="{{$states->id}}" {{ $colleges->state == $states->id ? 'selected' : '' }}>{{$states->name}}</option>
								@endforeach
							</select><br>
							<select class="form-control" id="city_id" name="city"></select>
							<input type="hidden" value="{{$colleges->city}}" id="selected_city">
							{!! $errors->first('state', '<small class="text-danger">:message</small>') !!}
							{!! $errors->first('city', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="street" class="col-sm-2 col-form-label">Street</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="street">{{$colleges->street}}</textarea>
							{!! $errors->first('street', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="post_code" class="col-sm-2 col-form-label">Post Code</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="post_code" value="{{$colleges->post_code}}">
							{!! $errors->first('post_code', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="contact1" class="col-sm-2 col-form-label">Contact 1</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="contact1" value="{{$colleges->contact1}}">
							{!! $errors->first('contact1', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="contact2" class="col-sm-2 col-form-label">Contact 2</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="contact2" value="{{$colleges->contact2}}">
							{!! $errors->first('contact2', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="email1" class="col-sm-2 col-form-label">Email 1</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" name="email1" value="{{$colleges->email1}}">
							{!! $errors->first('email1', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="email2" class="col-sm-2 col-form-label">Email 2</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" name="email2" value="{{$colleges->email2}}">
							{!! $errors->first('email2', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="website" class="col-sm-2 col-form-label">Website</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="website" value="{{$colleges->website}}">
							{!! $errors->first('website', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="long_description" class="col-sm-2 col-form-label">Description</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="long_description">{{$colleges->long_description}}</textarea>
							{!! $errors->first('long_description', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="short_description" class="col-sm-2 col-form-label">Short Description</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="short_description" rows="3">{{$colleges->short_description}}</textarea>
							{!! $errors->first('short_description', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="image" class="col-sm-2 col-form-label">Image</label>
						<div class="col-sm-10">
							<input type="file" name="image" class="form-control">
							<input type="hidden" class="form-control" name="old_image" value="{{$colleges->image}}">
							<br>
							<div class="row my-4 pb-1">
								<div class="col-md-3">
			                      	<div class="card shadow text-center mb-4">
				                        <div class="card-body file">
				                          	<div class="my-4">
				                            	<img src="{{asset('Uploads/College/Image/').'/'.$colleges->image}}"  width="100px">
				                          	</div>
				                        </div>
			                      	</div>
			                    </div>	
							</div>
							{!! $errors->first('image', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="logo" class="col-sm-2 col-form-label">Logo</label>
						<div class="col-sm-10">
							<input type="file" name="logo" class="form-control">
							<input type="hidden" class="form-control" name="old_logo" value="{{$colleges->logo}}">
							<br>
							<div class="row my-4 pb-1">
								<div class="col-md-3">
			                      	<div class="card shadow text-center mb-4">
				                        <div class="card-body file">
				                          	<div class="my-4">
				                            	<img src="{{asset('Uploads/College/Logo/').'/'.$colleges->logo}}"  width="100px">
				                          	</div>
				                        </div>
			                      	</div>
			                    </div>	
							</div>
							{!! $errors->first('logo', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="avg_rating" class="col-sm-2 col-form-label">Average Rating</label>
						<div class="col-sm-10">
							<input type="number" class="form-control" name="avg_rating" step="0.5" max="5" value="{{$colleges->avg_rating}}">
							{!! $errors->first('avg_rating', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="academic_rating" class="col-sm-2 col-form-label">Academic Rating</label>
						<div class="col-sm-10">
							<input type="number" class="form-control" name="academic_rating" step="0.5" max="5" value="{{$colleges->academic_rating}}">
							{!! $errors->first('academic_rating', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="fee_rating" class="col-sm-2 col-form-label">Fee Rating</label>
						<div class="col-sm-10">
							<input type="number" class="form-control" name="fee_rating" step="0.5" max="5" value="{{$colleges->fee_rating}}">
							{!! $errors->first('fee_rating', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="placement_rating" class="col-sm-2 col-form-label">Placement Rating</label>
						<div class="col-sm-10">
							<input type="number" class="form-control" name="placement_rating" step="0.5" max="5" value="{{$colleges->placement_rating}}">
							{!! $errors->first('placement_rating', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="infrastructure_rating" class="col-sm-2 col-form-label">Infrastructure Rating</label>
						<div class="col-sm-10">
							<input type="number" class="form-control" name="infrastructure_rating" step="0.5" max="5" value="{{$colleges->infrastructure_rating}}">
							{!! $errors->first('infrastructure_rating', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="meta_name" class="col-sm-2 col-form-label">Meta Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="meta_name" value="{{$colleges->meta_name}}">
							{!! $errors->first('meta_name', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="meta_keyword" class="col-sm-2 col-form-label">Meta Keyword</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="meta_keyword" rows="3">{{$colleges->meta_keyword}}</textarea>
							{!! $errors->first('meta_keyword', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="meta_description" class="col-sm-2 col-form-label">Meta Description</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="meta_description" rows="3">{{$colleges->meta_description}}</textarea>
							{!! $errors->first('meta_description', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="status" class="col-sm-2 col-form-label">Status</label>
						<div class="col-sm-10">
							<input type="hidden" name="status" value="0">
							<input type="checkbox" name="status" value="1" style="margin-top: 7px" @if(old('status', $colleges->status)) checked @endif>
						</div>
					</div>
					<div class="form-group row">
						<label for="status" class="col-sm-2 col-form-label">Featured college</label>
						<div class="col-sm-10">
							<input type="checkbox" name="featured_colleges" value="1" style="margin-top: 7px" @if(old('featured_colleges', $colleges->featured_colleges)) checked @endif>
						</div>
					</div>
					<input type="hidden" value="{{$colleges->id}}" name="id_college">
					<div class="form-group mb-2">
						<button type="submit" class="btn btn-primary">Edit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Script -->

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

<script>
  CKEDITOR.replace( 'long_description', {
    filebrowserBrowseUrl: 'http://localhost/New_Education/public/ckfinder/ckfinder.html',
    filebrowserUploadUrl: 'http://localhost/New_Education/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
  });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>

<script>
	window.onload = function() {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var stateName = document.getElementById('state_id').value;
		var cityName = document.getElementById('selected_city').value;

		if(stateName){
			$.ajax({
				type:'POST',
				url: "{{route('get.city')}}",
				data: 	{
						 	state_id:stateName,
						 	city_id:cityName,
						 	_token: CSRF_TOKEN
					 	},
				success:function(html){
                    $('#city_id').html(html);
                },
			});
		}
		else{
        	$('#city_id').html('<option value="">Select state first</option>'); 
    	}
	};
</script>

<script>
	$(document).ready(function(){
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$('#state_id').on('change',function(){
			var stateName = $(this).val();
			if(stateName){
				$.ajax({
					type:'POST',
					url: "{{route('get.city')}}",
					data: 	{
							 	state_id:stateName,
							 	_token: CSRF_TOKEN
						 	},
					success:function(html){
	                    $('#city_id').html(html);
	                },
				});
			}
			else{
            	$('#city_id').html('<option value="">Select state first</option>'); 
        	}
		});
	});
</script>

<!-- Script -->
@stop

							