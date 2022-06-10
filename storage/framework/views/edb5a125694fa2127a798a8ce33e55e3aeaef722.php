<?php $__env->startSection('head'); ?>
   <!-- Prism -->
    <link rel="stylesheet" href="<?php echo e(url('public/vendors/prism/prism.css')); ?>" type="text/css"> 
	 <link rel="stylesheet" href="<?php echo e(url('public/vendors/datepicker/daterangepicker.css')); ?>" type="text/css">
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

</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- begin::page-header -->
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Projects</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="<?php echo e(asset('public/assets/media/image/icons/home.png')); ?>" alt="">
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
							<?php if($res): ?>
							<?php $__currentLoopData = $res; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php $item_id = Crypt::encrypt($item->uuid);
								$startdate = date('d-m-Y',$item->project_start_date);
							?>
							 
							
                            <tr>
                                <td>
								<div class="card">
									  <div class="card-body" style="padding: 0.5rem !important;">
										<!--start row -->
											<div class="row">											 
												<div class="col-8 form-group text-left">													 
													 <strong style="font-size:20px;"><?php echo e($item->name); ?></strong> &nbsp;&nbsp;														 
														<?php if($item->is_active==1): ?>
															<img style="height: 12px; margin-top: -3px;" src="<?php echo e(asset('public/assets/media/image/icons/online.png')); ?>" alt=""></span> <br>
														<?php else: ?>
														<img style="height: 12px; margin-top: -3px;" src="<?php echo e(asset('public/assets/media/image/icons/offline.png')); ?>" alt=""></span> <br>
														<?php endif; ?>
															<?php echo e($item->name); ?> - <?php echo e($item->name); ?></p>
													 
												</div>
												<div class="col-4 form-group text-center">
													<div class="row">
														<div class="col-12" style="padding: 0px 0px 1px 0px; !important;">
														<?php if($item->configs): ?>
														<?php $__currentLoopData = $item->configs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<a href="javascript: void(0); return false;" data-id="<?php echo e($item_id); ?>xaqsis<?php echo e($item->name); ?>xaqsis<?php echo e($item->is_active); ?>" data-startdate="<?php echo e($startdate); ?>" data-cost="<?php echo e($c->cost_trials); ?>" data-pertmin="<?php echo e($c->pert_desired_min_duration); ?>" data-pertmax="<?php echo e($c->pert_desired_max_duration); ?>" data-mcspath="<?php echo e($c->mcs_include_critical_path); ?>" data-mcstrials="<?php echo e($c->mcs_trials); ?>" class="editModel" data-toggle="tooltip" data-placement="top" title="Edit">
															<button type="button" class="btn btn-outline-secondary btn-xs" style="width: 50%;"> Edit Project</button></a> 																	 
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														<?php else: ?>
														<a href="javascript: void(0); return false;" data-id="<?php echo e($item_id); ?>xaqsis<?php echo e($item->name); ?>xaqsis<?php echo e($item->is_active); ?>" class="editModel" data-toggle="tooltip" data-placement="top" title="Edit">
															<button type="button" class="btn btn-outline-secondary btn-xs" style="width: 50%;"> Edit Project</button></a>	
														<?php endif; ?>
														</div> 
														<div class="col-12" style="padding: 0px 0px 1px 0px; !important;">
														<a href="javascript:void(0); return false;"  data-id="<?php echo e(route('projects.remove',$item_id)); ?>" class="confirmDelete"  data-toggle="tooltip" data-placement="top" title="Delete">
															<button type="button" class="btn btn-outline-secondary btn-xs" style="width: 50%;">Delete Project</button></a> <br/>
														</div> 
														<div class="col-12" style="padding: 0px 0px 1px 0px; !important;">
														<a href="<?php echo e(route('projectactivity.create', $item->uuid )); ?>">
															<button type="button" class="btn btn-outline-secondary btn-xs" style="width: 50%;">Add/Edit Activity</button>
															<!--<img style="height: 40px; margin-top: -3px;" src="<?php echo e(asset('public/assets/media/image/icons/option.png')); ?>" alt="">-->
														</a>
														</div> 
													</div>	  
													 
												</div>
											</div> 
											<!--end row -->
											<!--second row -->
											<div class="row">												
												<div class="col-8 form-group" style="padding: 12px 8px 7px 33px; !important;">
													<div class="row">
													<div class="col-12"> 
														<div class="row">
															<div class="4"><strong>Cost:</strong></div>
															<div class="8" style="padding:0px 0px 0px 84px; !important;">
																<span><strong>Mean</strong>: <?php if($simulaions): ?> <?php echo e($simulaions->mean); ?> <?php endif; ?> </span>
																<span><strong>Planned Cast</strong>: <?php if($simulaions): ?> <?php echo e($simulaions->planned_cost); ?> <?php endif; ?> </span>
																<span><strong>Std</strong>: <?php if($simulaions): ?> <?php echo e($simulaions->std); ?> <?php endif; ?> </span>
																<span><strong>Co-Var</strong>: <?php if($simulaions): ?> <?php echo e($simulaions->covar); ?> <?php endif; ?> </span>
																<span><strong>Z-Value</strong>: <?php if($simulaions): ?> <?php echo e($simulaions->zvalue); ?> <?php endif; ?> </span>
															</div>
														</div>
													</div>
													<!--<div class="col-12"> 
														<div class="row">
															<div class="4"><strong>Schedule(PERT):</strong></div>
															<div class="8" style="padding:0px 0px 0px 10px; !important;">
																<span><strong>Mean</strong>: 0 </span>
																<span><strong>Planned Cast</strong>: 0 </span>
																<span><strong>Std</strong>: 0 </span>
																<span><strong>Co-Var</strong>: 0 </span>
																<span><strong>Z-Value</strong>: 0 </span>
															</div>
														</div>
													</div>-->
													<div class="col-12"> 
														<div class="row">
															<div class="4"><strong>Schedule(MCS):</strong></div>
															<div class="8" style="padding:0px 0px 0px 16px; !important;">
																<span><strong>Mean</strong>: 0 </span>
																<span><strong>Planned Cast</strong>: 0 </span>
																<span><strong>Std</strong>: 0 </span>
																<span><strong>Co-Var</strong>: 0 </span>
																<span><strong>Z-Value</strong>: 0 </span>
															</div> 
														</div>
													</div>
													</div> 
												</div>
												<div class="col-4 form-group text-center">
													<div class="row">
														<div class="col-12" style="padding: 0px 0px 1px 0px; !important;">
															<div class="row">
															<div class="col-2"></div>															
															 <div class="col-5" style="padding: 0px 0px 0px 10px; !important;"> 
															 <a href="<?php echo e(route('summary.create', $item->uuid )); ?>&simulation_type=C&activity_name=">
																<button type="button" class="btn btn-outline-secondary btn-xs"> Cost Analysis </button>
															 </a>
															 </div>
															 <div class="col-2" style="padding: 0px 0px 0px 0px; !important;"> 
																<a href="javascript:void(0);" class="addSimulationModel" data-id="<?php echo e($item->uuid); ?>" data-name="<?php echo e($item->name); ?>" data-type="C"> 														
																<button type="button" class="btn btn-outline-secondary btn-xs">Simulation</button>	
																</a>															 
															 </div>
															  <div class="col-3"></div>
															</div>
														</div> 
														<!-- <div class="col-12" style="padding: 1px 35px 1px 20px;!important;">
														 <div class="row">
															<div class="col-2"></div>															
															 <div class="col-6" style="padding: 0px 17px 1px 0px; !important;"> 
															 <a href="<?php echo e(route('pert-analysis.create',['project_uuid'=>$item->uuid,'simulation_type'=>'P'])); ?>">
																<button type="button" class="btn btn-outline-secondary btn-xs">Pert Analysis</button>
															 </a>
															 </div>
															 <div class="col-2" style="padding: 0px 0px 0px 0px; !important;"> 
																<a href="javascript:void(0);" class="addSimulationModel" data-id="<?php echo e($item->uuid); ?>" data-name="<?php echo e($item->name); ?>" data-type="P"> 														
																<button type="button" class="btn btn-outline-secondary btn-xs">Simulation</button>	
																</a>															 
															 </div>
															  <div class="col-2"></div>
															</div>
														</div> -->
														<div class="col-12" style="padding: 0px 0px 1px 0px; !important;">
														 <div class="row">
															<div class="col-2"></div>															
															 <div class="col-5" style="padding: 0px 0px 0px 10px; !important;"> 
															 <a href="<?php echo e(route('mcs-analysis.create',['project_uuid'=>$item->uuid,'simulation_type'=>'M'])); ?>">
																<button type="button" class="btn btn-outline-secondary btn-xs"> MCS Analysis </button>
															 </a>
															 </div>
															 <div class="col-2" style="padding: 0px 0px 0px 0px; !important;"> 
																<a href="javascript:void(0);" class="addSimulationModel" data-id="<?php echo e($item->uuid); ?>" data-name="<?php echo e($item->name); ?>" data-type="M"> 														
																<button type="button" class="btn btn-outline-secondary btn-xs">Simulation</button>	
																</a>															 
															 </div>
															  <div class="col-2"></div>															  
															</div>
															<div class="col-12" style="padding: 0px 0px 1px 0px; !important;">
															<a href="<?php echo e(route('projectevents', ['project_uuid' => $item->uuid])); ?>">
																<button type="button" class="btn btn-outline-secondary btn-xs" style="width: 50%;">Projects Events </button>															
															</a>
														</div>
														</div> 
													</div>	  
													 
												</div>
											</div> 
											<!--end second row -->
											
										</div>	
									</div>
                                </td>
                            </tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
							<?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<!-- .modal -->
	<div class="modal fade showModel" id="modelDatePicker">
		<div class="modal-dialog modal-xl">
			<form name="frmProjects" method="post" action="<?php echo e(route('projects.save')); ?>" class="needs-validation" novalidate>
			<!-- CROSS Site Request Forgery Protection -->
			<?php echo csrf_field(); ?>	
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
								<input type="text" name="name" class="form-control txtname" style="width: 70%" placeholder="Enter Project" required >								 
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-4"><strong>Start Date</strong>:</div>							 
							<div class="col-sm-8">								 
								<input type="text" name="project_start_date" class="form-control txtstartdate" value=""  placeholder="dd-mm-yyyy" style="width: 70%" required >								 
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
											   <input type="text" name="trials"  class="form-control trials" value="">
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
												<input type="checkbox" name="include_critical_path" value="1" class="custom-control-input mcspath" id="customSwitches4" checked>
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
					<form name="frmProjects" method="post" action="" class="needs-validation" novalidate>
						<!-- CROSS Site Request Forgery Protection -->
						<?php echo csrf_field(); ?>	
						<div class="modal-content">
							<div class="modal-header">
								<h4>Run Simulation	</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-12">
										<div class="form-group row">
											<div class="col-sm-4"><strong>Project</strong>:</div>
												<input type="hidden" name="simulation_type" class="form-control simulationtype" value="">
												<input type="hidden" name="project_uuid" class="form-control projectuuid" value=""> 										
												<div class="col-sm-8"><strong><span class="proName"></span></strong></div>
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
										
								</div>
								<div class="row">
									<div class="col-12">
									<div class="modal-footer text-left">	
										<button type="button"  class="btn btn-primary runsimulation">Run</button>
										<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
									</div></div>
								</div>
							</div>
							
						</div>
					</form>
                </div>
            </div>
            <!-- ===========/Modal Run Simulation============== -->
		<!-- .modal-sm -->
		<div class="modal fade runOkSimulation" tabindex="-1" role="dialog" aria-hidden="true">
		  <div class="modal-dialog">
		  <form id="runoksimulatios" method="post" action="">
			<div class="modal-content">
			  <div class="modal-header">
				<h6 class="modal-title">Run</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <i class="ti-close"></i>
				</button>
			  </div>
			  <div class="modal-body">
				<div class="row">
					<div class="col-12">							 
							<div class="form-group row">
							<input type="hidden" name="simulation_uuid" class="simulationuuid">
							<input type="hidden" name="projectuuid" class="projectuuid">
								Simulation for Trails(100) has been scheduled. You can see the status in the project page.
							</div> 
					</div>
				</div>
			  </div>
			  <div class="modal-footer">				
				<a href="<?php echo e(route('projects')); ?>"><button type="button" class="btn btn-primary oksubmitbttn">OK</button></a>
			  </div>
			</div>
			</form>
		  </div>
		</div>
	
<?php $__env->stopSection(); ?>
<!-- Javascript -->
 <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
 <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="<?php echo e(url('vendors/datepicker/daterangepicker.js')); ?>"></script>
<?php $__env->startSection('script'); ?>
    <!-- DataTable -->


 <script>
 $( function() {
    //$( ".txtstartdate" ).datepicker();
  });
  $(function() {
    $(".txtstartdate")
        .datepicker({            
            dateFormat: "dd-mm-yy",            
            regional: "it"                      
        })
        .on('blur', function() { // This check is for dd/mm/yyyy format but can be easily adapted to any other
            if(this.value.match(/\d{1,2}[^\d]\d{1,2}[^\d]\d{4,4}/gi) == null){
                //alert('Invalid date format');
				$(".txtstartdate").focus();
				return false;
			
            }else {
                var t = this.value.split(/[^\d]/);
                var dd = parseInt(t[0], 10);
                var m0 = parseInt(t[1], 10) - 1; // Month in JavaScript Date object is 0-based
                var yyyy = parseInt(t[2], 10);
                var d = new Date(yyyy, m0, dd); // new Date(2017, 13, 32) is still valid
				if(d.getDate() != dd || d.getMonth() != m0 || (d.getFullYear() != yyyy || d.getFullYear()!=4 ))
                    alert('Invalid date format value');
					return false;
            }
        });
});
  
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
		$(".txtstartdate").val('');
		$(".trials").val(100);
		$(".desired_min").val(10);
		$(".desired_max").val(112);
		$(".mcstrials").val(10000);
		$('.showModel').modal({
			backdrop: 'static',
			keyboard: false
		});
	});
});
$(document).ready(function(){
	$('.editModel').on('click',function(){	
		$(".txttitle").show().text('Update Project');
		var cost = $(this).data('cost');
		var desired_min_duration = $(this).data('pertmin');
		var desired_max_duration = $(this).data('pertmax');
		var mcspath = $(this).data('mcspath');
		var mcstrials = $(this).data('mcstrials');
		var startdate = $(this).data("startdate");
		alert(startdate);
		var data = $(this).data("id");		 
		var fields = data.split('xaqsis');

		var id = fields[0];
		var name = fields[1];
		var active = fields[2];
		 
		//alert(cost);
		$(".edit_id").show().val(id);
		$(".trials").val(cost);
		$(".desired_min").val(desired_min_duration);
		$(".desired_max").val(desired_max_duration);		 
		$(".pert_trials").val(mcstrials);
		if(mcspath == 1){
		   //alert("You have selected\n");
			$('.mcspath').attr('checked',true);
		  }
		  else{
			  $('.mcspath').attr('checked',false);	
		  }
		
		if(active == 1){
		   //alert("You have selected\n");
			$('#isActive').attr('checked',true);
		  }
		  else{
			  $('#isActive').attr('checked',false);	
		  }
		$(".txtname").val(name);
		$(".txtstartdate").val(startdate);
		$('.showModel').modal({
			backdrop: 'static',
			keyboard: false
		});
		 
	});
});

</script>
<script>
  <?php if(Session::has('success')): ?>
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
	"positionClass": 'toast-top-center'
  }
  		toastr.success("<?php echo e(Session::get('success')); ?>");
  <?php endif; ?>

  <?php if(Session::has('error')): ?>
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
	"positionClass": 'toast-top-center'
  }
  		toastr.error("<?php echo e(Session::get('error')); ?>");
  <?php endif; ?>  
  
  
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
		 var type 		= $(this).data("type");
		 $(".projectuuid").val(project_uuid); 
		 $(".simulationtype").val(type); 
		 $(".proName").text(name);
		 $(".simulationOpt").val('');	
		  $.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url : "<?php echo e(route('simulation.simulationbyprojectuuid')); ?>",
				data : {'project_uuid' : project_uuid,'simulation_type':type},
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
		var type		  	= $(".simulationtype").val();
		//alert(uuid+"=="+project_uuid);
		$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url : "<?php echo e(route('simulation.simulation_run')); ?>",
				data : {'uuid': uuid,'project_uuid' : project_uuid,'simulation_type':type},
				type : 'GET',
				dataType : 'json',
				success : function(response){					
					 if(response==1)
					 {
						$(".simulationuuid").val(uuid);
						$(".projectuuid").val(project_uuid);
						$(".showSimulationModel").hide();
						 /* Model Open Here*/						 
						$(".runOkSimulation").modal({
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
	  
    <script src="<?php echo e(url('public/vendors/prism/prism.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_demo_app\resources\views/projects/index.blade.php ENDPATH**/ ?>