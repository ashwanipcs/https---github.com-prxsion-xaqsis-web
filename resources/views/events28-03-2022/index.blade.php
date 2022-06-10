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
            <h4>Events</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="{{asset('public/assets/media/image/icons/home.png')}}" alt="">
                        <a href="#">Manage</a>
                    </li>                    
                    <li class="breadcrumb-item active" aria-current="page">Events</li>
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
								<th>Description</th> 	
								<th>Event Type</th> 	
								<th>Productive</th>
								<th>Start Date</th>
								<th>End Date</th> 								
                                <th>Is Active</th> 
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
							@if($res)
								@foreach($res as $key=>$items)
								@php $item_id = Crypt::encrypt($items->uuid); 
									$sdate = date('d-m-Y',$items->start_date);
									$edate = date('d-m-Y',$items->end_date);
								@endphp
								<tr>
									<td>{{$key+1}}</td>
									<td>{{$items->name}}</td>
									<td>{{$items->description}}</td> 								 
									<td>{{$items->event_type}}</td>                                 
									<td><div class="form-check">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input class="form-check-input"  type="checkbox" id="gridCheck1"  disabled="disabled" {{($items->is_active == true ? ' checked' : '') }}></div></td>
									<td>{{$sdate}}</td>
									<td>{{$edate}}</td>
									<td><div class="form-check">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input class="form-check-input"  type="checkbox" id="gridCheck1" disabled="disabled" {{($items->is_productive == true ? ' checked' : '') }}></div></td>									
									<td> 
										 <a href="javascript:void(0);" data-id="{{$items->uuid}}" data-name="{{$items->name}}" data-desc="{{$items->description}}" data-sdate="{{$sdate}}" data-edate="{{$edate}}" data-type="{{$items->event_type}}" data-active="{{$items->is_active}}" data-productive="{{$items->is_productive}}" class="editModel btn btn-success btn-floating" data-toggle="tooltip" data-placement="top" title="Edit">
										 <i class="fa fa-edit"></i></a>
											
										<a href="javascript:void(0);"  data-id="{{route('events.remove', $items->uuid)}}" class="confirmDelete btn btn-danger btn-floating"  data-toggle="tooltip" data-placement="top" title="Delete">
										<i class="fa fa-trash"></i></a> 
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
		<div class="modal-dialog modal-xl">
			<form name="modelFrm" method="post" action="" class="frmAction">
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
							<div class="col-sm-2"><strong>Event Type</strong>:</div>
							<div class="col-sm-10">
								<select name="event_type" class="form-control txttype" style="width: 100%" required >
									<option value="">-- select event type --</option>
									<option value="REGIONAL_HOLIDAY">REGIONAL HOLIDAY</option>
									<option value="PUBLIC_HOLIDAY">PUBLIC_HOLIDAY</option>
									<option value="MEETING">MEETING</option>
									<option value="LOCKDOWN">LOCKDOWN</option>
									<option value="RESOURCE_ISSUE">RESOURCE ISSUE</option>
									<option value="MANPOWER_ISSUE">MANPOWER_ISSUE</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-2"><strong>Start Date</strong>:</div>
							<div class="col-sm-4">
								<input type="date" name="start_date" class="form-control txtsdate" value="<?php echo date('d-m-Y'); ?>" style="width: 100%" required >								
							</div>
						 
							<div class="col-sm-2"><strong>End Date</strong>:</div>
							<div class="col-sm-4">
								<input type="date" name="end_date" class="form-control txtedate" value="<?php echo date('d-m-Y'); ?>" style="width: 100%" required >								
							</div>
						</div> 						
						<div class="form-group row">
							<div class="col-sm-2"><strong>Active</strong>:</div>
							<div class="col-sm-4">
								<input  type="checkbox" name="is_active" class="form-check-input" value="false" id="isActive">								 								
							</div>						
							<div class="col-sm-2"><strong>Productive</strong>:</div>
							<div class="col-sm-4">
								<input  type="checkbox" name="is_productive" class="form-check-input" value="false" id="isProductive">								 								
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


@endsection

@section('script')
    <!-- DataTable -->
<script type="text/javascript">
	$(function () {
		$('[data-toggle="tooltip"]').tooltip();
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
<script type="text/javascript">
$(document).ready(function(){	 
	$("body").on("click", ".addModel", function(event){ 		
		$(".txttitle").show().text('Create Events');
		$('.frmAction').attr('action', "{{route('events.save')}}");		
		$(".uuid").hide().val('');
		$(".txtname").val('');	
		$(".txtdescription").val('');
		$(".txttype").val('');
		$(".txtsdata").val('');
		$(".txtedata").val('');
		
		$('.showModel').modal({
			backdrop: 'static',
			keyboard: false
		});
	});
});
$(document).ready(function(){
	$("body").on("click", ".editModel", function(event){ 		 
		$(".txttitle").show().text('Update Events');	
		$('.frmAction').attr('action', "{{route('events.update')}}");	
	 	
		var uuid 			= $(this).data("id"); 
		var name 			= $(this).data("name"); 
		var description 	= $(this).data("desc"); 
		var type 			= $(this).data("type"); 
		var startdate 		= $(this).data("sdate"); 
		var enddate 		= $(this).data("edate"); 
		var is_active 		= $(this).data("active"); 
		var isproductive 	= $(this).data("productive"); 
		
		$(".txttype option").each(function()
		{
			var selOptVal = $(this).val();
			if(selOptVal == type)
			{
				$(this).attr('selected', true);
			}
		});
		if(is_active == 1){
		   //alert("You have selected\n");
			$('#isActive').attr('checked',true);
		  }
		else{
			  $('#isActive').attr('checked',false);	
		}
		if(isproductive == 1){
		   //alert("You have selected\n");
			$('#isProductive').attr('checked',true);
		  }
		else{
			  $('#isProductive').attr('checked',false);	
		}
		  
		$(".uuid").show().val(uuid);
		$(".txtname").val(name);	
		$(".txtdescription").val(description);
		$(".txtsdate").val(startdate);
		$(".txtedate").val(enddate);
		
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
 
</script>
<!-- Prism -->	  
<script src="{{ url('public/vendors/prism/prism.js') }}"></script>
@endsection
