@extends('layouts.admin')

@section('title','Dashboard')

@section('breadcrumb')
<div class="row align-items-center mb-2">
	<div class="col">
		<h2 class="h5 page-title">Welcome!</h2>
	</div>
	<div class="col-auto">
		<form class="form-inline">
			<div class="form-group d-none d-lg-inline">
				<label for="reportrange" class="sr-only">Date Ranges</label>
				<div id="" class="px-2 py-2 text-muted">
					<?php use Carbon\Carbon; $dt = Carbon::now("Asia/Kolkata"); echo $dt->toDayDateTimeString();?>
				</div>
			</div>
		</form>
	</div>
</div>
@stop

@section('content')

@stop