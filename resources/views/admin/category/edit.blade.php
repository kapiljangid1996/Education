@extends('layouts.admin')

@section('title','Edit Category')

@section('breadcrumb')
<div class="row align-items-center mb-2">
	<div class="col">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="{{url('/admin/category')}}">Category</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Category</li>
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
				<strong class="card-title">Edit Category</strong>
			</div>
			<div class="card-body">
				<form action="{{ route('category.update',$categories->id) }}" method="POST" enctype="multipart/form-data" class="form-group">
					@csrf
					@method('PUT')
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name" value="{{$categories->name}}" name="name">
							{!! $errors->first('name', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="slug" class="col-sm-2 col-form-label">Slug</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="slug" value="{{$categories->slug}}" name="slug">
							{!! $errors->first('slug', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>											
					<div class="form-group row">
						<label for="parent_id" class="col-sm-2 col-form-label">Category</label>
						<div class="col-sm-10">
							<select class="form-control" name="parent_id">
								<option value="">Select Parent Category</option>
								@foreach ($catgs as $catg)
								<?php $category = isset($categories->parent_id) ? $categories->parent_id:' '; ?>
									<option value="{{ $catg->id }}" {{ $catg->id == $category ? 'selected' : '' }}>{{ $catg->name }}</option>
								@endforeach
							</select>
							{!! $errors->first('parent_id', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="long_description" class="col-sm-2 col-form-label">Description</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="long_description" rows="4">{{ $categories->long_description }}</textarea>
							{!! $errors->first('long_description', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="meta_name" class="col-sm-2 col-form-label">Meta Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" value="{{$categories->meta_name}}" name="meta_name">
							{!! $errors->first('meta_name', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="meta_keyword" class="col-sm-2 col-form-label">Meta Keyword</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="meta_keyword" rows="4">{{ $categories->meta_keyword }}</textarea>
							{!! $errors->first('meta_keyword', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="meta_description" class="col-sm-2 col-form-label">Meta Description</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="meta_description" rows="4">{{ $categories->meta_description }}</textarea>
							{!! $errors->first('meta_description', '<small class="text-danger">:message</small>') !!}
						</div>
					</div>
					<div class="form-group mb-2">
						<button type="submit" class="btn btn-primary">Edit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@stop