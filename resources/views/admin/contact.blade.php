@extends('layouts.admin')

@section('title','Contact List')

@section('breadcrumb')
<div class="row align-items-center mb-2">
	<div class="col">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
				<li class="breadcrumb-item active" aria-current="product">Contact List</li>
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
				<strong class="card-title">Contact List</strong>
				<div class="btn-group" style="float: right;">
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    					Export
  					</button>
  					<div class="dropdown-menu">
  						<a class="dropdown-item" href="{{url('/contact/export/xlsx')}}">Excel</a>
						<a class="dropdown-item" href="{{url('/contact/export/xls')}}">Csv</a>
  					</div>
				</div>
			</div>
			<div class="card-body">
				<table id="example-table" class="table table-borderless table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Contact Number</th>
							<th>City</th>
							<th>10th Percent</th>
							<th>12th Percent</th>
							<th>Graduation Percent</th>
							<th>Reg Id</th>
							<th>Type</th>
						</tr>
					</thead>
					<tbody id="myTable">
						<?php
							$index = 0;	
							foreach ($contacts as $contact){
								$index++;
						?>
						<tr>
							<td><?php echo $index; ?></td>
							<td>{{ $contact->name }}</td>
							<td>{{ $contact->email }}</td>
							<td>{{ $contact->contact }}</td>
							<td>{{ $contact->city }}</td>
							<td>{{ $contact->tenth_Percent }}</td>
							<td>{{ $contact->twelfth_Percent }}</td>
							<td>{{ $contact->graduation_Percent }}</td>
							<td>{{ $contact->reg_id }}</td>
							<td>{{ $contact->type }}</td>
						</tr>
						<?php  } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@stop