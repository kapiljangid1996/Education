@extends('layouts.admin')

@section('title','Newsletter List')

@section('breadcrumb')
<div class="row align-items-center mb-2">
	<div class="col">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
				<li class="breadcrumb-item active" aria-current="product">Newsletter List</li>
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
				<strong class="card-title">Newsletter List</strong>
			</div>
			<div class="card-body">
				<form method="POST" action="{{ route('send.newsletter') }}">
					@csrf
					<table id="example-table" class="table table-borderless table-hover" cellspacing="0" width="55%">
						<thead>
							<tr>
								<th></th>
								<th>#</th>
								<th>Email</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody id="myTable">
								<?php
									$index = 0;	
									foreach ($newsletters as $newsletter){
										$index++;
								?>
								<tr>
									<td style="float: right;"><input type="checkbox" name="check_email[]" value="{{ $newsletter->id }}"></td>
									<td><?php echo $index; ?></td>
									<td>{{ $newsletter->email }}</td>
									<td>{{ $newsletter->subscription ? 'Subscribed' : 'Unsubscribed'}}</td>
								</tr>
								<?php  } ?>
						</tbody>
					</table><br>
					<button class="btn-primary btn-sm">Send Mail</button>
				</form>
			</div>
		</div>
	</div>
</div>
@stop