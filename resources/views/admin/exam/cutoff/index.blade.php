@extends('layouts.admin')

@section('title','Exam Cut Offs')

@section('breadcrumb')
<div class="row align-items-center mb-2">
	<div class="col">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="{{ url('/admin/exam') }}">Exam</a></li>
				<li class="breadcrumb-item active" aria-current="product">Exam Cut Offs</li>
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
				<strong class="card-title">Exam Cut Offs</strong>
				<a href="{{url('admin/exam/cutoff/add_cutoff/'.$id)}}" class="btn btn-primary btn-round" style="float: right;">Add</a>
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
							foreach ($cutoffs as $cutoff){
								$index++;
						?>
						<tr>
							<td><?php echo $index; ?></td>
							<td>{{ $cutoff->name }}</td>
							<td>{{ $cutoff->slug }}</td>
							<td>
								@if($cutoff->status == 1)
                                  	Active
                              	@else
                                  	Inactive
                              	@endif
							</td>
							<td>
								<button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="text-muted sr-only">Action</span></button>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="/admin/exam/cutoff/edit_cutoff/{{ $cutoff->id }}">Edit</a>
									<a class="dropdown-item" href="/admin/exam/cutoff/delete_cutoff/{{ $cutoff->id }}" onclick="return confirm('Are you sure you want to delete')">Delete</a>									
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