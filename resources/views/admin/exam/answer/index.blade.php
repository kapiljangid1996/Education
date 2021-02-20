@extends('layouts.admin')

@section('title','Exam Answers')

@section('breadcrumb')
<div class="row align-items-center mb-2">
	<div class="col">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="{{ url('/admin/exam') }}">Exam</a></li>
				<li class="breadcrumb-item active" aria-current="product">Exam Answers</li>
			</ol>
		</nav>
	</div>
</div>
@stop

@section('content')
<div class="row">
	<div class="col-md-12 my-4">
		<div class="card shadow">
			<div class="card-header">
				<strong class="card-title">Exam Answers</strong>
				<a href="{{url('admin/exam/answer/add_answer/'.$id)}}" class="btn btn-primary btn-round" style="float: right;">Add</a>
			</div>
			<div class="card-body">
				<table id="example-table" class="table table-borderless table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Heading</th>
							<th>Slug</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="myTable">
						<?php
							$index = 0;	
							foreach ($answers as $answer){
								$index++;
						?>
						<tr>
							<td><?php echo $index; ?></td>
							<td>{{ $answer->name }}</td>
							<td>{{ $answer->slug }}</td>
							<td>
								@if($answer->status == 1)
                                  	Active
                              	@else
                                  	Inactive
                              	@endif
							</td>
							<td>
								<button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="text-muted sr-only">Action</span></button>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="/admin/exam/answer/edit_answer/{{ $answer->id }}">Edit</a>
									<a class="dropdown-item" href="/admin/exam/answer/delete_answer/{{ $answer->id }}" onclick="return confirm('Are you sure you want to delete')">Delete</a>									
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
@stop