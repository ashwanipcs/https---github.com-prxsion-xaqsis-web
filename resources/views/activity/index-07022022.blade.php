@extends('layouts.app')
@section('head')
 <!-- Prism -->
    <link rel="stylesheet" href="{{ url('public/vendors/prism/prism.css') }}" type="text/css">
	<style>
	body {
  background: #dd5e89;
  background: -webkit-linear-gradient(to left, #dd5e89, #f7bb97);
  background: linear-gradient(to left, #dd5e89, #f7bb97);
  min-height: 100vh;
}
	</style>
@endsection

@section('content')
    <!-- begin::page-header -->
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Activity</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="{{asset('public/assets/media/image/icons/home.png')}}" alt="">
                        <a href="#">Manage</a>
                    </li>
                    
                    <li class="breadcrumb-item active" aria-current="page">Activity</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- end::page-header -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 text-right mb-3" >
                        <a href="#" data-toggle="modal" data-target="#cost_head">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
                        <!--<button type="button" class="btn btn-primary btn-sm rounded-0"  data-toggle="tooltip" data-placement="top" title="Add">
						<i class="fa fa-table"></i></button>-->
						<button type="button" class="createModel btn btn-primary btn-sm rounded-0" data-toggle="tooltip" data-placement="top" title="Add">Show Modal</button>
						<button type="button" class="importModel btn btn-primary btn-sm rounded-0" data-toggle="tooltip" data-placement="top" title="Import Activity">Import Activity</button>							
                    </div>
                </div>
                <div class="card">
						<!-- Success message -->
						@if(Session::has('success'))
							<div class="alert alert-success">
								{{Session::get('success')}}
							</div>
						@endif
						<!-- Success message -->
						@if(Session::has('error'))
							<div class="alert alert-danger">
								{{Session::get('error')}}
							</div>
						@endif
                    <div class="card-body">
                        <table class="datatableTbl table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Org Name</th> 
								<th>Name</th>  
								<th>Description</th>								
                                <th>Is Active</th>  
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
							 @foreach($res as $key =>$items)
							 @php $item_id = Crypt::encrypt($items->uuid); @endphp
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$items->org_name}}</td>  
								<td>{{$items->name}}</td>
								<td>{{$items->description}}</td>								
                                <td><div class="form-check">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input class="form-check-input" name="is_active" type="checkbox" id="gridCheck1" @if($items->is_active==true) checked @endif></div></td>                              
                                <td> 
									<a href="javascript:void(0); return false;" data-uuid ="{{$items->uuid}}" data-name="{{$items->name}}" data-desc="{{$items->description}}" data-active="{{$items->is_active}}" class="editModel btn btn-success btn-sm rounded-0" data-toggle="tooltip" data-placement="top" title="Edit">
									 <i class="fa fa-edit"></i></a>
                                    &nbsp;&nbsp; 
									<a href="{{route('activity.remove',$item_id)}}" class="btn btn-danger btn-sm rounded-0"  data-toggle="tooltip" data-placement="top" title="Delete">
									<i class="fa fa-trash"></i></a> 
                                </td>
                            </tr>
							@endforeach                                              
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<!-- Modal -->
	<div class="showModel modal fade" role="dialog">
		<div class="modal-dialog">
			<form name="frmProjects" class="formAction" method="post" action="">
				<!-- CROSS Site Request Forgery Protection -->
				@csrf	
				<!-- Modal content-->
				<div class="modal-content">
					 <div class="modal-header">						
						<h4 class="modal-title"> <span class="txttitle"></span></h4>
						<button type="button" class="close" data-dismiss="modal"><i class="ti-close"></i></button>
					 </div>
					 <div class="modal-body">
						<input type="hidden" name="uuid" class="form-control uuid">
						<div class="form-group row">
							<div class="col-sm-4"><strong>Name</strong>:</div>
							<div class="col-sm-8">
								<input type="text" name="name" class="form-control txtname" style="width: 70%" required >								
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-4"><strong>Description</strong>:</div>
							<div class="col-sm-8">
								<input type="text" name="description" class="form-control txtdescription" style="width: 70%" required >								
							</div>
						</div>	
						<div class="form-group row">
							<div class="col-sm-4"><strong>Is Active</strong>:</div>
							<div class="col-sm-8">
								<input class="form-check-input txtactive" name="is_active" type="checkbox" id="gridCheck1">								
							</div>
						</div>							
					</div>
					<div class="modal-footer">						
						<button type="submit"  class="btn btn-primary">Save changes</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>	
		</div>
	</div> 
	
	<!-- Modal For Import Activity -->
	<div class="showImportModel modal fade" role="dialog">
		<div class="modal-dialog modal-xl">
			<form name="frmProjects" class="formAction" method="post" action="">
				<!-- CROSS Site Request Forgery Protection -->
				@csrf	
				<!-- Modal content-->
				<div class="modal-content">
					 <div class="modal-header">		
						<h4 class="modal-title"> <span class="txttitle"></span></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						
					 </div>
					 <div class="modal-body">
						<table class="table table-striped table-bordered nowrap showDatatable" cellspacing="0" width="100%">
							  <thead>
									<tr>
									  <th>Name</th>
									  <th>Description</th>
									  <th>Is Active</th>							  
									</tr>
							  </thead>
							  <tbody>
								@foreach($rs as $k=>$ac)
									<tr>
										<div class="form-row">
										  <td>
											 <div class="form-group col-md-12">											  
											  <input type="text" name="name[]" value="{{$ac->name}}" class="form-control" id="inputEmail4">
											</div>
										  </td>
										  <td>
											 <div class="form-group col-md-12">											  
											  <input type="text" name="description[]" value="{{$ac->description}}" class="form-control" id="inputEmail4">
											</div>
										  </td>
										  <td> <div class="form-group col-md-12">											  
											  <input class="form-check-input txtactive" name="is_active[]" type="checkbox" id="gridCheck1" @if($ac->is_active==1) checked @endif>	
											</div>
										</td>
										</div>
									</tr>
								@endforeach
							  </tbody>
						</table>				
					</div>
					<div class="modal-footer">						
						<button type="submit"  class="btn btn-primary">Save changes</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>	
		</div>
	</div> 
	
@endsection

@section('script')
<script>	
$(document).ready(function(){
	$(".importModel").click(function(){
		/* form action */
		$('.formAction').attr('action', "{{ route('activity.syncActivity') }}");		
		$(".txttitle").show().text('Import Activity');
		/* Model Open Here*/
		$(".showImportModel").modal({
			backdrop: 'static',
			keyboard: false
		});
	});
});
</script>

<script>
$(document).ready(function(){
	$(".createModel").click(function(){
		/* form action */
		$('.formAction').attr('action', "{{ route('activity.save') }}");
		
		/* If Create Button all fields is blank*/
		$(".uuid").hide().val('');
		$(".txtname").val('');
		$(".txtdescription").val('');		
		$(".txttitle").show().text('Create Activity');
		/* Model Open Here*/
		$(".showModel").modal({
			backdrop: 'static',
			keyboard: false
		});
	});
	
	//$(".editModel").click(function(){
	$("body").on("click", ".editModel", function(event){ 
		
		$(".txttitle").show().text('Update Activity');
		/* form action */
		$('.formAction').attr('action', "{{ route('activity.update') }}");		
		/* If Update Button all fields*/ 
		var uuid 		= $(this).data("uuid");
		var name 		= $(this).data("name");
		var description = $(this).data("desc");
		var isActive 	= $(this).data("active");
		if(isActive==1){ $(".txtactive").attr ( "checked" ,"checked" );}		
		$(".uuid").show().val(uuid);
		$(".txtname").val(name);
		$(".txtdescription").val(description);
	
		/* Model Open Here*/
		$(".showModel").modal({
			backdrop: 'static',
			keyboard: false
		});
	});
});
 
$(function () {
	$('[data-toggle="tooltip"]').tooltip();
});
 	
$(document).ready(function () {
	$('.datatableTbl').DataTable({
		responsive: true
	});
});

$(document).ready(function() {
		var table = $('.showDatatable').DataTable( {       
        scrollX:        true,
        scrollCollapse: true,
        autoWidth:         true,  
        paging:         true,       
        columnDefs: [
        { "width": "80px", "targets": [0,1] },       
        { "width": "40px", "targets": [4] }
      ]
    } );
} );
</script>

 	<!-- Javascript -->
    <script src="{{ url('public/vendors/prism/prism.js') }}"></script>
@endsection
