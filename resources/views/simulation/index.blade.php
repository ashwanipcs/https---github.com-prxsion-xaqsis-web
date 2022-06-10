@extends('layouts.app')

@section('head')
   <!-- Prism -->
<link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css"> 	 
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
            <h4>Simulation</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="{{asset('assets/media/image/icons/home.png')}}" alt="">
                        <a href="#">Manage</a>
                    </li>                    
                    <li class="breadcrumb-item active" aria-current="page">Simulation</li>
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
                        <button type="button" class="addModel btn btn-secondary btn-floating" data-toggle="tooltip" data-placement="top" title="Add">
						 <i class="ti-plus"></i></button>
						  
                    </div>
                </div>
                <div class="card">						
                    <div class="card-body">
					<table class="table table-striped table-bordered nowrap showDatatable" cellspacing="0" width="100%">
                        
                            <thead>
                            <tr>
                                <th>S.No.</th> 
								<th>Name</th>
								<th>Type</th>
								<th>Descriptions</th> 								
                                <th>Is Active</th>  
								<th>Is Default </th>  								
                                <th>Modified On</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
							@if($res)
								@foreach($res as $key=>$item)
								@php $item_id = Crypt::encrypt($item->uuid); @endphp
								<tr>
									<td>{{$key+1}}</td>
									<td>{{$item->name}}</td> 
									<td>{{$item->simulation_type}}</td> 								 
									<td>{{$item->description}}</td>                                 
									<td><div class="form-check">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input class="form-check-input"  type="checkbox" id="gridCheck1" disabled="disabled" {{($item->is_active == true ? ' checked' : '') }}></div></td>
									<td> <div class="form-check">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input class="form-check-input"  type="checkbox" id="gridCheck2" disabled="disabled" {{($item->is_default == true ? ' checked' : '') }}></div>
									
									</td>
									<td>{{$item->modified_on}}</td>
									<td> 										 
										<a href="javascript:void(0);" data-type="{{$item->simulation_type}}" data-uuid="{{$item->uuid}}" data-name="{{$item->name}}" data-desc="{{$item->description}}" data-active="{{$item->is_active}}" data-projectuuid="{{$item->project_uuid}}" class="editModel btn btn-success btn-floating" data-toggle="tooltip" data-placement="top" title="Edit">
										<i class="fa fa-edit"></i></a>											
										<a href="javascript:void(0);"  data-id="{{route('simulation.remove', $item_id)}}" class="confirmDelete btn btn-danger btn-floating"  data-toggle="tooltip" data-placement="top" title="Delete">
										<i class="fa fa-trash"></i></a>
										@if($item->is_default == true)
										@else
										<a href="javascript:void(0);" data-defauluuid="{{$item->uuid}}" class="confirmIsDefault btn btn-success btn-floating" data-toggle="tooltip" data-placement="top" title="Set Default"><i class="fa fa-rocket" aria-hidden="true"></i></a>
										@endif
									</td>
								</tr>
								@endforeach 
									
								@else
									No record found..
								@endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<!-- .modal -->
	<div class="modal fade showModel">
		<div class="modal-dialog">
			<form name="modelFrm" method="post" action="" class="frmAction needs-validation" novalidate>
			<!-- CROSS Site Request Forgery Protection -->
			@csrf	
				<div class="modal-content">
					<div class="modal-header">					 
						<h4 class="modal-title"><span class="txttitle"></span></h4> 
						<button type="button" class="close" data-dismiss="modal">×</button>								
					</div>
					<div class="modal-body">
						<input type="hidden" name="uuid" class="form-control uuid">
						<div class="form-group row">
							<div class="col-sm-2"><strong>Projects</strong>:</div>
							<div class="col-sm-10">
								<select name="project_uuid" class="form-control txtProjects" id="projectuuid" required>
									<option value="">-- select project--</option>
									@if($projects) 
										@foreach($projects as $key => $val)
										 <option value="{{$val->uuid}}">{{$val->name}}</option>
										@endforeach
									@endif
								</select>								
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-2"><strong>Simulation Type</strong>:</div>
							<div class="col-sm-10">
								<select name="simulation_type" class="form-control txtType" id="type" required>
									<option value="">-- select simulation type--</option>
										<option value="C">COST</option>
										<!--<option value="P">PERT</option>-->
										<option value="M">MCS</option>
								</select>								
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-2"><strong>Name</strong>:</div>
							<div class="col-sm-10">
								<input type="text" name="name" class="form-control txtname" style="width: 100%" required >								
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-2"><strong>Description</strong>:</div>
							<div class="col-sm-10">
								<input type="text" name="description" class="form-control txtdescription" style="width: 100%" required >								
							</div>
						</div> 
						<div class="form-group row">
							<div class="col-sm-4"><strong>Is Active</strong>:</div>
							<div class="col-sm-6">
								<input  type="checkbox" name="is_active" class="form-check-input" value="false" id="is_active1">
								 								
							</div>
						</div> 
					</div>   
					<div class="modal-footer">
						<button type="submit"  class="btn btn-primary btn-rounded">Save</button>
						<button type="button" class="btn btn-primary btn-rounded" data-dismiss="modal">Close</button>								                              
					</div>
				</div> 
			</form>
		</div>                                          
	</div>	
<!-- Start Confirm Model box -->
<!-- .modal -->
	<div class="modal fade showConfirmModel">
		<div class="modal-dialog">
			<form name="modeldefaultFrm" method="post" action="{{route('simulation.defaultsimulation')}}" class="modeldefaultFrm">
			<!-- CROSS Site Request Forgery Protection -->
			@csrf	
				<div class="modal-content">
					<div class="modal-header">					 
						<h4 class="modal-title">Is Default</h4> 
						<button type="button" class="close" data-dismiss="modal">×</button>								
					</div>
					<div class="modal-body">
						<input type="hidden" name="defaultuuid" class="default_uuid" value="" />
						<input type="hidden" name="is_default" class="default_uuid" value="1" />
						Do You want to set is default simulation.
					</div>					
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary btn-rounded ok">Yes</button>
						<button type="button" class="btn btn-primary btn-rounded cancel" data-dismiss="modal">Close</button>
					</div>
				</div> 
			</form>
		</div>                                          
	</div>


@endsection

@section('script')
    <!-- DataTable -->
<script type="text/javascript">
	$(function () {
		$('[data-toggle="tooltip"]').tooltip();
	});
	
	 
	$(document).ready(function() {
		var table = $('.showDatatable').DataTable( {       
        scrollX:        false,
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
<script type="text/javascript">
$(document).ready(function(){	 
	$("body").on("click", ".addModel", function(event){ 		
		$(".txttitle").show().text('Create Simulation');
		$('.frmAction').attr('action', "{{route('simulation.save')}}");
		
		$(".uuid").hide().val('');
		$(".txtname").val('');	
		$(".txtdescription").val('');
		$(".txtProjects").val('');
		$(".txtType").val('');
		
		$('.showModel').modal({
			backdrop: 'static',
			keyboard: false
		});
	});
});
$(document).ready(function(){
	$("body").on("click", ".editModel", function(event){ 		 
		$(".txttitle").show().text('Update Simulation');	
		$('.frmAction').attr('action', "{{route('simulation.update')}}");	
	 	
		var uuid 			= $(this).data("uuid"); 
		var name 			= $(this).data("name"); 
		var description 	= $(this).data("desc"); 
		var is_active 		= $(this).data("active"); 
		var project_uuid 	= $(this).data("projectuuid");
		var type		 	= $(this).data("type"); 		 
		$(".txtProjects option").each(function()
		{
			var selOptVal = $(this).val();
			if(selOptVal == project_uuid)
			{
				$(this).attr('selected', true);
			}
		});
		$(".txtType option").each(function()
		{
			var typeVal = $(this).val();
			if(typeVal == type)
			{
				$(this).attr('selected', true);
			}
		});
		 if(is_active == 1){
		   //alert("You have selected\n");
			$('#is_active1').attr('checked',true);
		  }
		  else{
			  $('#is_active1').attr('checked',false);	
		  }
		  
		$(".uuid").show().val(uuid);
		$(".txtname").val(name);	
		$(".txtdescription").val(description);

		
		$('.showModel').modal({
			backdrop: 'static',
			keyboard: false
		});
		 
	});
});

</script>
<script type="text/javascript">
  @if(Session::has('success'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
	"positionClass": 'toast-top-center'
  }
  		toastr.success("{{Session::get('success')}}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
	"positionClass": 'toast-top-center'
  }
  		toastr.error("{{Session::get('error')}}");
  @endif  
  
$(document).ready(function(){
	 $("body").on("click", ".confirmDelete", function(event){
		 var url = $(this).data("id");	
		 //alert(url);
		  toastr.success("<button type='button' class='confirmationRevertYes btn clear'>Yes</button><button type='button' class='confirmationRevertNo btn clear'>No</button>",'Are you sure you want to delete this item?',
		{
			  closeButton: true,
			  allowHtml: true,
			  onShown: function (toast) {
				  $(".confirmationRevertYes").click(function(){
					location.replace(url); 
				  });
				}
		});
	 }); 
  });
 // The function below will start the confirmation dialog confirmIsDefault
$(document).ready(function(){
	 $("body").on("click", ".confirmIsDefault", function(event){
		 var uuid = $(this).data("defauluuid"); 
		 $(".default_uuid").val(uuid);
		$('.showConfirmModel').modal({
			backdrop: 'static',
			keyboard: false
		});
		
		
	 });
	 
	 
});
</script>
<!-- Prism -->	  
<script src="{{ url('vendors/prism/prism.js') }}"></script>
@endsection
