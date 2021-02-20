@extends('layouts.admin')

@section('title','Category')

@section('breadcrumb')
<div class="row align-items-center mb-2">
	<div class="col">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
				<li class="breadcrumb-item active" aria-current="category">Category</li>
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
				<strong class="card-title">Category</strong>
				<a href="{{route('category.create')}}" class="btn btn-primary btn-round" data-toggle="modal" data-target="#addCategoryModal" style="float: right;">Add</a>
			</div>
			<div class="card-body">
				<table id="example-table" class="table table-borderless table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Parent Category</th>
							<th>Slug</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="myTable">
						<?php
							$index = 0;	
							foreach ($categories as $category){
								$index++;
						?>
						<tr>
							<td><?php echo $index; ?></td>
							<td>{{ $category->name }}</td>
							<td>{{ $category->parent ? $category->parent->name : ''}}</td>
							<td>{{ $category->slug }}</td>
							<td>
								<button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="text-muted sr-only">Action</span></button>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{route('category.edit', $category->id)}}">Edit</a>
									<form action="{{ url('/admin/category', $category->id) }}" method="POST">
										@csrf
	                      				@method('DELETE')
										<button class="dropdown-item" type="submit" onclick="return confirm('Are you sure you want to delete')">Delete</button>
									</form>
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

<!-- Add Category Model -->

<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header text-center">
				<h5 class="modal-title w-100 font-weight-bold">Add Category</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body mx-3">
				<form class="form" action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
				@csrf
					<div class="md-form mb-3">
						<select class="form-control" name="parent_id">
							<option value="">Select Parent Category</option>
							@foreach ($categories as $category)
								@if($category->parent == null)
									<option value="{{ $category->id }}">{{ $category->name }}</option>
								@endif
							@endforeach
						</select>
					</div>
					<div class="md-form mb-3">
						<input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ old('name') }}" required>
						{!! $errors->first('name', '<small class="text-danger">:message</small>') !!}
					</div>
					<div class="md-form mb-3">
						<input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" value="{{ old('slug') }}" required>
						{!! $errors->first('slug', '<small class="text-danger">:message</small>') !!}
					</div>
					<div class="md-form mb-3">
						<textarea class="form-control" name="long_description" placeholder="Description" required>{{ old('long_description') }}</textarea>
						{!! $errors->first('long_description', '<small class="text-danger">:message</small>') !!}
					</div>
					<div class="md-form mb-3">
						<input type="file" class="form-control" name="image">
						{!! $errors->first('image', '<small class="text-danger">:message</small>') !!}
					</div>
					<div class="md-form mb-3">
						<input type="text" class="form-control" name="meta_name" placeholder="Meta Name" value="{{ old('meta_name') }}" required>
						{!! $errors->first('meta_name', '<small class="text-danger">:message</small>') !!}
					</div>
					<div class="md-form mb-3">
						<textarea class="form-control" name="meta_keyword" placeholder="Meta Keyword" required>{{ old('meta_keyword') }}</textarea>
						{!! $errors->first('meta_keyword', '<small class="text-danger">:message</small>') !!}
					</div>
					<div class="md-form mb-3">
						<textarea class="form-control" name="meta_description" placeholder="Meta Description" required>{{ old('meta_description') }}</textarea>
						{!! $errors->first('meta_description', '<small class="text-danger">:message</small>') !!}
					</div>				
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button class="btn btn-primary" type="submit">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Add Category Model End -->
@stop