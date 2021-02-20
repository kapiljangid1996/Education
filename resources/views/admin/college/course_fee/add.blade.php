@extends('layouts.admin')

@section('title','Add Course & Fees')

@section('breadcrumb')
<div class="row align-items-center mb-2">
	<div class="col">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="{{url('/admin/college')}}">College</a></li>
				<li class="breadcrumb-item"><a href="{{url('/admin/college/course_fees/'.$id)}}">Course & Fees</a></li>
				<li class="breadcrumb-item active" aria-current="category">Add Course & Fees</li>
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
				<strong class="card-title">Add Course & Fees</strong>
			</div>
			<div class="card-body">
				<form action="{{url('admin/college/course_fees/add_course_fees')}}" method="POST" enctype="multipart/form-data" class="form-group">
					@csrf
					<div class="form-group row">
						<label for="course_id" class="col-sm-2 col-form-label">Course Name</label>
						<div class="col-sm-10">
							<select class="form-control" name="course_id" required>
								<option value="">Select Course</option>
								@foreach ($courses as $course)
									<option value="{{ $course->id }}">{{ $course->name }}</option>
								@endforeach
							</select>
							{!! $errors->first('course_id', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label">Sub Course Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name" value="{{old('name')}}"  name="name" required>
							{!! $errors->first('name', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="slug" class="col-sm-2 col-form-label">Slug</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="slug" value="{{old('slug')}}" name="slug" required>
							{!! $errors->first('slug', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="fee" class="col-sm-2 col-form-label">Course Fees</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" value="{{old('fee')}}" name="fee" required>
							{!! $errors->first('fee', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="duration" class="col-sm-2 col-form-label">Duration</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" value="{{old('duration')}}" name="duration" required>
							{!! $errors->first('duration', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="seats" class="col-sm-2 col-form-label">No of Seats</label>
						<div class="col-sm-10">
							<input type="number" class="form-control" value="{{old('seats')}}" name="seats" required>
							{!! $errors->first('seats', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="exam_id" class="col-sm-2 col-form-label">Exam</label>
						<div class="col-sm-10">
							<select class="form-control" name="exam_id[]" multiple="">
								<option value="">Select Exam</option>
								@foreach ($exams as $exam)
									<option value="{{ $exam->id }}">{{ $exam->name }}</option>
								@endforeach
							</select>
							{!! $errors->first('exam_id', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="long_description" class="col-sm-2 col-form-label">Description</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="long_description" required>{{ old('long_description') }}</textarea>
							{!! $errors->first('long_description', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="meta_name" class="col-sm-2 col-form-label">Meta Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="meta_name" value="{{old('meta_name')}}" required>
							{!! $errors->first('meta_name', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="meta_keyword" class="col-sm-2 col-form-label">Meta Keyword</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="meta_keyword" rows="3" required>{{ old('meta_keyword') }}</textarea>
							{!! $errors->first('meta_keyword', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="meta_description" class="col-sm-2 col-form-label">Meta Description</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="meta_description" rows="3" required>{{ old('meta_description') }}</textarea>
							{!! $errors->first('meta_description', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="status" class="col-sm-2 col-form-label">Status</label>
						<div class="col-sm-10">
							<input type="hidden" name="status" value="0">
							<input type="checkbox" name="status" checked="" value="1" style="margin-top: 7px">
						</div>
					</div>
					<input type="hidden"  name="college_id" value="{{$id}}">
					<div class="form-group mb-2">
						<button type="submit" class="btn btn-primary">Add</button>
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

<!-- Script -->
@stop