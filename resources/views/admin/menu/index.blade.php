@extends('layouts.admin')

@section('title','Menu Builder')

@section('breadcrumb')
<div class="row align-items-center mb-2">
	<div class="col">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
				<li class="breadcrumb-item active" aria-current="product">Menu Builder</li>
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
				<strong class="card-title">Exam</strong>
				<a href="{{route('menu.create')}}" class="btn btn-primary btn-fix" style="float: right;">Add New</a>
			</div>
			<div class="card-body">
				<table id="example-table" class="table table-borderless table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
                            <th>#</th>
                            <th>Menu ID</th>
                            <th>Name</th>
							<th>Heading</th>
                            <th>Status</th>
                            <th>Created date</th>
                            <th>Action</th>
						</tr>
					</thead>
					<tbody id="myTable">
						<?php
							$index = 0;	
							foreach ($menus as $menu){
								$index++;
						?>
						<tr>
							<td><?php echo $index; ?></td>
							<td>{{ $menu->id }}</td>
							<td>{{ $menu->title }}</td>
							<td>{{ $menu->heading }}</td>
							<td>
								@if($menu->status == 1)
                                  	Active
                              	@else
                                  	Inactive
                              	@endif
							</td>
							<td><?php echo date('d-m-Y',strtotime($menu['created_at'])); ?></td>
							<td>
								<button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="text-muted sr-only">Action</span></button>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{route('menu.edit', $menu->id)}}">Edit</a>
									<a class="dropdown-item" href="{{route('menu_manager.show', $menu->id)}}">View</a>
									<form action="{{ url('/admin/menu', $menu->id) }}" method="POST">
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
@stop