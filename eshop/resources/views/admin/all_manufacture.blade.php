@extends('admin_layout')
@section('admin_content')

<ul class="breadcrumb">
	<li>
		<i class="icon-home"></i>
		<a href="index.html">Home</a> 
		<i class="icon-angle-right"></i>
	</li>
	<li><a href="#">All Manufacture</a></li>
</ul>

<p class="alert-success">
	<?php 
		$message=Session::get('message');
		if ($message) {
			echo $message;
			Session::put('message', null);
		}
	?>
</p>

<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon user"></i><span class="break"></span>All Manufacture</h2>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
			  <thead>
				  <tr>
					  <th>Manufacture Id</th>
					  <th>Manufacture name</th>
					  <th>Manufacture Description</th>
					  <th>Status</th>
					  <th>Actions</th>
				  </tr>
			  </thead>  
			  <tbody>
			  @foreach($all_manufacture_info as $v_manufacture) 
				<tr>
					<td>{{$v_manufacture->manufacture_id }}</td>
					<td>{{$v_manufacture->manufacture_name }}</td>
					<td>{{$v_manufacture->manufacture_description }}</td>
					<td class="center">
						@if($v_manufacture->publication_status==1)
						<span class="label label-success">Active</span>
						@else
						<span class="label label-danger">Unactive</span>
						@endif
					</td>
					<td class="center">
						@if($v_manufacture->publication_status==1)
						<a class="btn btn-danger" href=" {{('/unactive_manufacture/'.$v_manufacture->manufacture_id)}} ">
							<i class="halflings-icon white thumbs-down"></i>  
						</a>
						@else
						<a class="btn btn-success" href=" {{('/active_manufacture/'.$v_manufacture->manufacture_id)}} ">
							<i class="halflings-icon white thumbs-up"></i>  
						</a>
						@endif

						<a class="btn btn-info" href=" {{('/edit-manufacture/'.$v_manufacture->manufacture_id)}} ">
							<i class="halflings-icon white edit"></i>  
						</a>
						<a class="btn btn-danger" href=" {{('/delete-manufacture/'.$v_manufacture->manufacture_id)}} " id="delete" >
							<i class="halflings-icon white trash"></i> 
						</a>
					</td>
				</tr>
				  @endforeach
			  </tbody>
		  </table>            
		</div>
	</div><!--/span-->

</div><!--/row-->

@endsection