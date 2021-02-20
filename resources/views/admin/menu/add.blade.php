@extends('layouts.admin')

@section('title','Add Menu')

@section('breadcrumb')
<div class="row align-items-center mb-2">
	<div class="col">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="{{url('/admin/menu')}}">Menu</a></li>
				<li class="breadcrumb-item active" aria-current="category">Add Menu</li>
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
				<strong class="card-title">Add Menu</strong>
			</div>
			<div class="card-body">
				<form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data" class="form-group">
					@csrf
					<div class="form-group row">
						<label for="title" class="col-sm-2 col-form-label">Menu Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" value="{{old('title')}}"  name="title" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="heading" class="col-sm-2 col-form-label">Menu Heading</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" value="{{old('heading')}}" name="heading" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="status" class="col-sm-2 col-form-label">Status</label>
						<div class="col-sm-10">
							<input type="hidden" name="status" value="0">
							<input type="checkbox" name="status" checked="" value="1" style="margin-top: 7px">
						</div>
					</div>
					<div class="form-group mb-2">
						<button type="submit" class="btn btn-primary">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@stop