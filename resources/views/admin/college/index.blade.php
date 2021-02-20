@extends('layouts.admin')

@section('title','College')

@section('breadcrumb')
<div class="row align-items-center mb-2">
	<div class="col">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
				<li class="breadcrumb-item active" aria-current="product">College</li>
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
				<strong class="card-title">College</strong>
				<a href="{{route('college.create')}}" class="btn btn-primary btn-round" style="float: right;">Add</a>
			</div>
			<div class="card-body">
				<table id="example-table" class="table table-borderless table-hover table-responsive" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Ownership</th>
							<th>Email</th>
							<th>Contact</th>
							<th>Status</th>
							<th>Is Featured</th>
							<th>Action</th>
							<th>More</th>
						</tr>
					</thead>
					<tbody id="myTable">
						<?php
							$index = 0;	
							foreach ($colleges as $college){
								$index++;
						?>
						<tr>
							<td><?php echo $index; ?></td>
							<td>{{ $college->name }}</td>
							<td>{{ $college->ownership }}</td>
							<td>{{ $college->email1 }} {{ $college->email2 ? ','.$college->email2 : ''}}</td>
							<td>{{ $college->contact1 }} {{ $college->contact2 ? ','.$college->contact2 : ''}}</td>
							<td>{{ $college->status ? 'Active' : 'Inactive'}}</td>
							<td>{{ $college->featured_colleges ? 'Yes' : 'No'}}</td>
							<td>
								<button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="text-muted sr-only">Action</span></button>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{route('college.edit', $college->id)}}">Edit</a>
									<form action="{{ url('/admin/college', $college->id) }}" method="POST">
										@csrf
	                      				@method('DELETE')
										<button class="dropdown-item" type="submit" onclick="return confirm('Are you sure you want to delete')">Delete</button>
									</form>
								</div>
							</td>
							<td>
								<button class="btn btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ url('/admin/college/course_fees', $college->id) }}">Courses & Fees</a>
								    <a class="dropdown-item" href="{{ url('/admin/college/admissions', $college->id) }}">Admissions</a>
								    <a class="dropdown-item" href="{{ url('/admin/college/placements', $college->id) }}">Placements</a>
								    <a class="dropdown-item" href="{{ url('/admin/college/cut_offs', $college->id) }}">Cut Off</a>
								    <a class="dropdown-item" href="{{ url('/admin/college/infrastructures', $college->id) }}">Infrastructure</a>
								    <a class="dropdown-item" href="{{ url('/admin/college/scholarships', $college->id) }}">Scholarships</a>
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