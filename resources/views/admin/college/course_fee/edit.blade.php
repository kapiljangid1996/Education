@extends('layouts.admin')

@section('title','Edit Course & Fees')

@section('breadcrumb')
<div class="row align-items-center mb-2">
	<div class="col">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="{{url('/admin/college')}}">College</a></li>
				<li class="breadcrumb-item"><a href="{{url('/admin/college/course_fees/'.$course_fees->college_id)}}">Course & Fees</a></li>
				<li class="breadcrumb-item active" aria-current="category">Edit Course & Fees</li>
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
				<strong class="card-title">Edit Course & Fees</strong>
			</div>
			<div class="card-body">
				<form action="{{url('admin/college/course_fees/edit_course_fees/'.$course_fees->id)}}" method="POST" enctype="multipart/form-data" class="form-group">
					@csrf					
					<div class="form-group row">
						<label for="course_id" class="col-sm-2 col-form-label">Course</label>
						<div class="col-sm-10">
							<select class="form-control" name="course_id" required>
								<option value="">Select Course</option>
								@foreach ($courses as $course)
									<option value="{{ $course->id }}" {{ $course->id == $course_fees->course->id ? 'selected' : '' }}>{{ $course->name }}</option>
								@endforeach
							</select>
							{!! $errors->first('course_id', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label">Sub Course Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name" name="name" value="{{$course_fees->name}}">
							{!! $errors->first('name', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="slug" class="col-sm-2 col-form-label">Slug</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="slug" name="slug" value="{{$course_fees->slug}}">
							{!! $errors->first('slug', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="fee" class="col-sm-2 col-form-label">Fees</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="fee" value="{{$course_fees->fee}}">
							{!! $errors->first('fee', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>	
					<div class="form-group row">
						<label for="duration" class="col-sm-2 col-form-label">Duration</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="duration" value="{{$course_fees->duration}}">
							{!! $errors->first('duration', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>	
					<div class="form-group row">
						<label for="seats" class="col-sm-2 col-form-label">No. of Seats</label>
						<div class="col-sm-10">
							<input type="number" class="form-control" name="seats" value="{{$course_fees->seats}}">
							{!! $errors->first('seats', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>		
					<div class="form-group row">
						<label for="exam_id" class="col-sm-2 col-form-label">Exam</label>
						<div class="col-sm-10">
							<select class="form-control" name="exam_id[]" multiple="">
								<option value="">Select Exam</option>
								@foreach ($exams as $exam)
									<option value="{{ $exam->id }}"  @foreach ($course_fees->coursefee_exam as $exam_id_colleges) {{ $exam->id === $exam_id_colleges->exam_id ? 'selected' : '' }}  @endforeach
										>{{ $exam->name }}</option>
								@endforeach
							</select>
							{!! $errors->first('exam_id', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="long_description" class="col-sm-2 col-form-label">Description</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="long_description" required>{{$course_fees->long_description}}</textarea>
							{!! $errors->first('long_description', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="meta_name" class="col-sm-2 col-form-label">Meta Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="meta_name" value="{{$course_fees->meta_name}}">
							{!! $errors->first('meta_name', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="meta_keyword" class="col-sm-2 col-form-label">Meta Keyword</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="meta_keyword" rows="3" required>{{$course_fees->meta_keyword}}</textarea>
							{!! $errors->first('meta_keyword', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="meta_description" class="col-sm-2 col-form-label">Meta Description</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="meta_description" rows="3" required>{{$course_fees->meta_description}}</textarea>
							{!! $errors->first('meta_description', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="status" class="col-sm-2 col-form-label">Status</label>
						<div class="col-sm-10">
							<input type="hidden" name="status" value="0">
							<input type="checkbox" name="status" value="1" style="margin-top: 7px" @if(old('status', $course_fees->status)) checked @endif>
						</div>
					</div>
					<input type="hidden" value="{{$course_fees->id}}" name="course_fee_id">
					<input type="hidden"  name="college_id" value="{{$course_fees->college_id}}">
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

<!-- Script -->
@stop

							