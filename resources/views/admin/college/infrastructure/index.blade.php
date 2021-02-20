@extends('layouts.admin')

@section('title','College Infrastructure')

@section('breadcrumb')
<div class="row align-items-center mb-2">
	<div class="col">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="{{ url('/admin/college') }}">College</a></li>
				<li class="breadcrumb-item active" aria-current="product">Infrastructure</li>
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
				<strong class="card-title">College Infrastructure</strong>
			</div>
			<div class="card-body">
				<div class="toolbar">
					<div class="row">
						@if(count($infras) == 0)
							<div class="col-sm-6">
								<a href="{{url('admin/college/infrastructures/add_infrastructures/'.$id)}}" class="btn btn-primary btn-round">Add</a>
							</div>
						@else
							<div class="col-sm-6">
								<a href="{{url('admin/college/infrastructures/edit_infrastructures/'.$id)}}" class="btn btn-info btn-round button-Edit" style="margin-right: 5px;">Edit</a>
								<a class="btn btn-danger btn-round button-Delete" href="/admin/college/infrastructures/delete_infrastructures/{{$id}}" onclick="return confirm('Are you sure you want to delete')">Delete</a>
							</div>						
						@endif
					</div>
				</div>
				<br>
				<table id="example" class="table table-borderless table-hover">
					<thead>
						<tr>
							<th>Heading</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody id="myTable">
						<?php $i=0 ?>
						@foreach($infras as $key => $infrastructure)
					        <tr>
				                <td>{{$infrastructure['name']}}</td> 
				                <td>{{$infrastructure['long_description']}}</td>  
			                	<td><input type="hidden"  name="addmore[<?php echo $i ?>][college_id]" value="{{$infrastructure['college_id']}}"></td> 
				            </tr> 
				        <?php $i++; ?>
			            @endforeach
					</tbody>
				</table>				
			</div>
		</div>
	</div>
</div>
@stop