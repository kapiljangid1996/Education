@extends('layouts.admin')

@section('title','College Course & Fees')

@section('breadcrumb')
<div class="row align-items-center mb-2">
	<div class="col">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="{{ url('/admin/college') }}">College</a></li>
				<li class="breadcrumb-item active" aria-current="product">College Course & Fees</li>
			</ol>
		</nav>
	</div>
</div>
@stop

@section('content')<?php echo $id; ?>
<div class="row">
	<div class="col-md-12 my-4">
		<div class="card shadow">
			<div class="card-header">
				<strong class="card-title">College Course & Fees</strong>
				<div class="btn-group" style="float: right;">
					<a href="{{url('admin/college/course_fees/add_course_fees/'.$id)}}" class="btn btn-info btn-round">Add</a>&nbsp&nbsp&nbsp
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    					Export
  					</button>
  					<div class="dropdown-menu">
  						<a class="dropdown-item" href="{{url('/college/courses/'.$id.'/xlsx')}}">Excel</a>
						<a class="dropdown-item" href="{{url('/college/courses/'.$id.'/xls')}}">Csv</a>
  					</div>
				</div>
			</div>
			<div class="card-body">
				<table id="example-table" class="table table-borderless table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>#</th>
							<th style="width: 180px;">Name</th>
							<th>Course</th>
							<th>Exam</th>
							<th>Fees</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="myTable">
						<?php
							$index = 0;	
							foreach ($course_fees as $course_fee){
								$index++;
						?>
						<tr>
							<td><?php echo $index; ?></td>
							<td>{{ $course_fee->name }}</td>
							<td>{{ $course_fee->course->name}}</td>
							<td>
								@foreach($exams as $key => $exam)
									@foreach($course_fee->coursefee_exam as $key => $exam_id_colleges)
										@if($exam->id == $exam_id_colleges->exam_id)
											{{ $exam->name }}
										@endif
									@endforeach
								@endforeach
							</td>
							<td>{{ $course_fee->fee }}</td>
							<td>
								@if($course_fee->status == 1)
                                  	Active
                              	@else
                                  	Inactive
                              	@endif
							</td>
							<td>
								<button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="text-muted sr-only">Action</span></button>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="/New_Education/admin/college/course_fees/edit_course_fees/{{ $course_fee->id }}">Edit</a>
									<a class="dropdown-item" href="/New_Education/admin/college/course_fees/delete_course_fees/{{ $course_fee->id }}" onclick="return confirm('Are you sure you want to delete')">Delete</a>									
								</div>
							</td>
						</tr>
						<?php  } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">				
	<form action="{{ route('college.courses.import') }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="row">
			<div class="col">
	            <label class="custom-file-label" for="customFile">Choose file</label><br>
				<input type="file" name="file" class="custom-file-input" id="customFile">
				<button class="btn btn-primary">Import File</button>
			</div>
		</div>					
	</form>
</div>
@stop