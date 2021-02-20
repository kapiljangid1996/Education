@extends('layouts.admin')

@section('title','Edit Infrastructure')

@section('breadcrumb')
<div class="row align-items-center mb-2">
	<div class="col">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="{{url('/admin/college')}}">College</a></li>
				<li class="breadcrumb-item"><a href="{{url('/admin/college/infrastructures/'.$id)}}">Infrastructure</a></li>
				<li class="breadcrumb-item active" aria-current="category">Edit Infrastructure</li>
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
				<strong class="card-title">Edit Infrastructure</strong>
			</div>
			<div class="card-body">
				<form action="{{url('admin/college/infrastructures/edit_infrastructures/'.$id)}}" method="POST" class="form-group">
					@csrf
					<table class="table table-borderless " id="dynamicTable">
						<tr>
				            <th>Name</th>
				            <th>Description</th>
				            <th>Action</th>
				        </tr>
				        <?php $i=1 ?>
						@foreach($infras as $key => $infrastructure)
					        <tr>
				                <td><input type="text" name="addmore[<?php echo $i ?>][name]" value="{{$infrastructure['name']}}" class="form-control topClass" /></td> 
				                <td><textarea class="form-control" name="addmore[<?php echo $i ?>][long_description]" rows="4">{{$infrastructure['long_description']}}</textarea></td>  
				                <td><button type="button" class="btn btn-danger remove-tr topClass">Remove</button></td> 
			                	<td><input type="hidden"  name="addmore[<?php echo $i ?>][college_id]" value="{{$infrastructure['college_id']}}"></td> 
				            </tr> 
				        <?php $i++; ?>
			            @endforeach
					</table>
					<input type="hidden" name="id_college" value="{{$id}}">
					<button type="button" name="add" id="add" class="btn btn-info">Add More</button>
					<button type="submit" class="btn btn-primary">Edit</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">   

    var i = '<?php echo !empty($infras) ? count($infras) : 0 ?>';       

    $("#add").click(function(){ 

        ++i;   

        $("#dynamicTable").append('<tr><td><input type="text" name="addmore['+i+'][name]" placeholder="Label" class="form-control topClass" /></td><td><textarea class="form-control" name="addmore['+i+'][long_description]" rows="4"></textarea></td><td><button type="button" class="btn btn-danger remove-tr topClass">Remove</button></td><td><input type="hidden"  name="addmore['+i+'][college_id]" value="<?php echo $id; ?>"></td></tr>');
    });   

    $(document).on('click', '.remove-tr', function(){  

        $(this).parents('tr').remove();

    });   

</script>
<style>
	.topClass{
		margin-top: -48px;
	}
</style>
@stop