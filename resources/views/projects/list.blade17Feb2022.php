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
/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
.modal{
 padding: 0px 0px 0px 250px !important;
}
.modal-dialog {
  max-width: 80% !important;
  height: 100%;
  padding: 0;
  margin: 0;
}

.modal-content {
  border-radius: 0 !important;
  height: 100%;
}
</style>
@endsection

@section('content')

    <!-- begin::page-header -->
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Projects</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="{{asset('public/assets/media/image/icons/home.png')}}" alt="">
                        <a href="#">Manage</a>
                    </li>
                    
                    <li class="breadcrumb-item active" aria-current="page">Projects</li>
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
                        <table  class="table table-striped table-bordered showDatatable" width="100%">
                            <thead>
                            <tr>
                                <th></th>                                
                            </tr>
                            </thead>
                            <tbody>
							@if($res)
							@foreach($res as $key=>$item)
							@php $item_id = Crypt::encrypt($item->uuid); @endphp
                            <tr>
                                <td>
								<div class="card">
									  <div class="card-body" style="padding: 0.5rem !important;">
												<div class="row">
													<div class="col-md-9"><strong style="font-size:20px;">{{$item->name}}</strong> &nbsp;&nbsp;
														 
														@if($item->is_active==1)
															<img style="height: 12px; margin-top: -3px;" src="{{asset('public/assets/media/image/icons/online.png')}}" alt=""></span> <br>
														@else
														<img style="height: 12px; margin-top: -3px;" src="{{asset('public/assets/media/image/icons/offline.png')}}" alt=""></span> <br>
														@endif
															{{$item->name}} - {{$item->name}}</p>
													</div>
													<div class="col-md-3"> 
														<div class="row">															 
																<div class="col-md-4">
																<strong>														
																	<a href="{{route('projectactivity.create', $item->uuid )}}">
																	<img style="height: 40px; margin-top: -3px;" src="{{asset('public/assets/media/image/icons/option.png')}}" alt=""></a>
																</strong><br> 
																</div>
																<div class="col-md-8">
																	<a href="javascript: void(0); return false;" data-id="{{$item_id}}xaqsis{{$item->name}}xaqsis{{$item->is_active}}" class="editModel btn btn-success btn-floating" data-toggle="tooltip" data-placement="top" title="Edit">
																	 <i class="fa fa-edit"></i></a> 
																	<a href="javascript:void(0); return false;"  data-id="{{route('projects.remove',$item_id)}}" class="confirmDelete btn btn-danger btn-floating"  data-toggle="tooltip" data-placement="top" title="Delete">
																	<i class="fa fa-trash"></i></a> 
																</div>
															</div><br>
													Planned Cost : 0</p>
													</div>
												</div>	
												<div class="row">
													<div class="col-md-12"></div>
												</div><br/>
												<div class="row">
													<div class="col-md-2"><p style="text-align: left;">
													<a href="javascript:void(0);" class="addSimulationModel" data-id="{{$item->uuid}}" data-name="{{$item->name}}"> 														
													<img style="height:20px;" src="{{ url('public/assets/media/image/icons/media.png') }}" alt="logo">
													Run Simulation	
													</a>	</p>		
													</div>
													<div class="col-md-8">  
													 	<strong> Mean</strong>:  0 &nbsp;<strong>Planned Cost</strong>:  0 &nbsp;<strong>Std</strong>:  0 &nbsp;<strong>Co-Var</strong>:  0 &nbsp;<strong>Z-Value</strong>: 0
													 
													</div>
													<div class="col-md-2">  
													 	<a href="{{route('summary.create', $item->uuid )}}">
														<img style="height:20px;" src="{{ url('public/assets/media/image/icons/contract.png') }}" alt="logo">
														Summary
														</a>
													</div>													 
												</div>										 
									  </div>
									</div>	 
                                </td>
                            </tr>
							@endforeach   
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
			<form name="frmProjects" method="post" action="{{ route('projects.save') }}">
			<!-- CROSS Site Request Forgery Protection -->
			@csrf	
				<div class="modal-content">
					<div class="modal-header">					 
						<h4 class="modal-title"><span class="txttitle"></span></h4> 
						<button type="button" class="close" data-dismiss="modal">×</button>								
					</div> 
					<div class="modal-body">
						<div class="form-group row">
							<div class="col-sm-4"><strong>Name</strong>:</div>							 
							<div class="col-sm-8">
								<input type="hidden" name="editid" class="form-control edit_id" style="display:none;">
								<input type="text" name="name" class="form-control txtname" style="width: 70%" required >								 
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-4"><strong>Is Active</strong>:</div>
							<div class="col-sm-8">
								<div class="form-check">
									<input name="is_active" class="form-check-input " type="checkbox" id="isActive">
								</div>
							</div>
						</div>
						 					
						<!-- Start Setting section-->
						<div class="form-group row">
							<div class="col-sm-4"><strong>Setting</strong>:</div>
							<div class="col-sm-8"></div>
						</div>						
						
						<div class="form-group row">										
							<div class="col-sm-12">
								  <div class="tab">
								  <button type="button" class="tablinks" onclick="openCity(event, 'Cost')">Cost</button>
								  <button type="button" class="tablinks" onclick="openCity(event, 'Pert')">Pert</button>
								  <button type="button" class="tablinks" onclick="openCity(event, 'MCS')">MCS</button>
								</div>
							</div>
						</div>
						<div class="form-group row">										
							<div class="col-sm-12">
								<div id="Cost" class="tabcontent" style="display:block;">									 											 												  
									 <div class="row">
											 <div class="col-10 text-left">
												<label><strong> Cost Trails</strong></label>
												<p>Unusual activity notification</p>
											</div>
											<div class="col-2 text-right">															
											   <input type="text" name="trails"  class="form-control trails" value="1000">
											</div>
									  </div>									  
									</div>
									<div id="Pert" class="tabcontent">
										<div class="row">	
											 <div class="col-10 text-left">
												<label><strong> Desired Min Duration</strong><br/>
												<p>Unusual activity notification</p>
												</label>												
											</div>
											<div class="col-2 text-right">
												<input type="text" name="desired_min_duration"  class="form-control desired_min" value="10">
											</div> 
											<div class="col-10 text-left">
												<label><strong> Desired Max Duration</strong><br/>
												<p>Unusual activity notification</p>
												</label>												
											</div>
											<div class="col-2 text-right">
												<input type="text" name="desired_max_duration"  class="form-control desired_max" value="112">
											</div> 
										</div>
									 </div>
									<div id="MCS" class="tabcontent">																  
										<div class="row">	
											 <div class="col-10 text-left">
												<label><strong> Include Critical Path</strong><br/>
												<p>Unusual activity notification</p>
												</label>												
											</div>
											<div class="col-2 text-right">
												<div class="custom-control custom-switch">
												<input type="checkbox" name="include_critical_path" value="1" class="custom-control-input" id="customSwitches4" checked>
												<label class="custom-control-label" for="customSwitches4"></label>
											  </div>
											</div> 
											<div class="col-10 text-left">
												<label><strong> Trails</strong><br/>
												<p>Unusual activity notification</p>
												</label>												
											</div>
											<div class="col-2 text-right">
												<input type="text" name="pert_trials"  class="form-control pert_trials" value="10000">
											</div> 
										</div>					  
									</div>
							</div>
						</div>	
					<!-- end Setting section-->
							
					</div>   
					<div class="modal-footer">
						<button type="submit"  class="btn btn-primary btn-rounded">Save changes</button>
						<button type="button" class="btn btn-primary btn-rounded" data-dismiss="modal">Close</button>								                              
					</div>
				</div> 
			</form>
		</div>                                          
	</div>
<!-- ===========Modal Run Simulation============== -->
            <div class="modal showSimulationModel" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
					<form name="frmProjects" method="post" action="">
						<!-- CROSS Site Request Forgery Protection -->
						@csrf	
						<div class="modal-content">
							<div class="modal-header">
								<h4>Run Simulation	</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-6">
										<div class="form-group row">
											<div class="col-sm-4"><strong>Project</strong>:</div>
												<input type="hidden" name="project_uuid" class="form-control projectuuid" value=""> 										
												<div class="col-sm-8"><h3><span class="proName"></span></h3></div>
										</div>	
										<div class="form-group row">
											<div class="col-sm-4"><strong>Simulation</strong>:</div>										 
												<div class="col-sm-8">
													<select name="uuid" class="form-control simulationOpt uuid" id="select_list" required>
														<option value="">-- select simulation--</option>
													</select>
												</div>
										</div>
									</div>
									
										<div class="col-6">
											<div style="display:none;" class="simulationok">
											<div class="form-group row">
												Simulation for Trails(100) has been scheduled. You can see the status in the project page.
											</div>	
											 
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer text-left">	
								<button type="button"  class="btn btn-primary runsimulation">Run</button>
								<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
							</div>
						</div>
					</form>
                </div>
            </div>
            <!-- ===========/Modal Run Simulation============== -->

	
@endsection

@section('script')
    <!-- DataTable -->
 <script>
 function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

 
 
	$(function () {
		$('[data-toggle="tooltip"]').tooltip();
	});
	
	$(document).ready(function () {
		$('.showDatatable').DataTable({
			responsive: true
		});
	});
	
	</script>
	<script>
$(document).ready(function(){
	$('.addModel').click(function(){
		$(".txttitle").show().text('Create Project');
		$(".edit_id").hide().val('');
		$(".txtname").val('');
		$('.showModel').modal({
			backdrop: 'static',
			keyboard: false
		});
	});
});
$(document).ready(function(){
	$('.editModel').on('click',function(){	
		$(".txttitle").show().text('Update Project');
		var data = $(this).data("id");		 
		var fields = data.split('xaqsis');

		var id = fields[0];
		var name = fields[1];
		var active = fields[2];
		//alert(active);
		$(".edit_id").show().val(id);
		if(active == 1){
		   //alert("You have selected\n");
			$('#isActive').attr('checked',true);
		  }
		  else{
			  $('#isActive').attr('checked',false);	
		  }
		$(".txtname").val(name);
		$('.showModel').modal({
			backdrop: 'static',
			keyboard: false
		});
		 
	});
});

</script>
<script>
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

$(document).ready(function () {
	$(".addSimulationModel").click(function() {
		 var project_uuid = $(this).data("id");		 
		 var name 		= $(this).data("name");
		 $(".projectuuid").val(project_uuid); 
		 $(".proName").text(name);
		 $(".simulationOpt").val('');	
		  $.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url : "{{ route('simulation.simulationbyprojectuuid') }}",
				data : {'project_uuid' : project_uuid},
				type : 'GET',
				dataType : 'json',
				success : function(response){
					
					$(".simulationOpt").empty();					 
					var items = "<option value=''>-- select simulation--</option>";
					$.each(response, function(index, item)
					{
						items += '<option value='+ item.uuid+'>'+ item.name +'</option>';
					});
					$(".simulationOpt").append(items); 
				}
			});
           /* Model Open Here*/
			$(".showSimulationModel").modal({
				backdrop: 'static',
				keyboard: false
			});
     });
		
	$(".runsimulation").click(function(){
		var uuid 			= $(".uuid").val();
		var project_uuid  	= $(".projectuuid").val();
		//alert(uuid+"=="+project_uuid);
		$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url : "{{ route('simulation.simulation_run') }}",
				data : {'uuid': uuid,'project_uuid' : project_uuid},
				type : 'GET',
				dataType : 'json',
				success : function(response){					
					 if(response==1)
					 {
						$(".simulationok").show();
						 /* Model Open Here*/
						$(".showSimulationModel").modal({
							backdrop: 'static',
							keyboard: false
						});
					 }
				}
			});
	});
});

</script>
    <!-- Prism -->
	  
    <script src="{{ url('public/vendors/prism/prism.js') }}"></script>
@endsection
