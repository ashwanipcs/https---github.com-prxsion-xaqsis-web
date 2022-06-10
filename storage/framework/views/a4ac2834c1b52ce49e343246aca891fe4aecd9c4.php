<?php $__env->startSection('head'); ?>
   <!-- Prism -->
<link rel="stylesheet" href="<?php echo e(url('public/vendors/prism/prism.css')); ?>" type="text/css"> 	
 <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css" />
 
<style>
		body {
		  background: #dd5e89;
		  background: -webkit-linear-gradient(to left, #dd5e89, #f7bb97);
		  background: linear-gradient(to left, #dd5e89, #f7bb97);
		  min-height: 100vh;
		}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- begin::page-header -->
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Events</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="<?php echo e(asset('public/assets/media/image/icons/home.png')); ?>" alt="">
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
							<?php if($res): ?>
								<?php $__currentLoopData = $res; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						 
								<?php  $start_date = date('m/d/Y H:i', $items->start_date); $end_date = date('m/d/Y H:i', $items->end_date);
									$item_id = Crypt::encrypt($items->uuid);
								?>
								<tr>
									<td><?php echo e($key+1); ?></td>
									<td><?php echo e($items->name); ?></td>
									<td><?php echo e($items->description); ?></td> 								 
									<td><?php echo e($items->event_type); ?></td>                                 
									<td><div class="form-check">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input class="form-check-input"  type="checkbox" id="gridCheck1" disabled="disabled" ></div></td>
									<td><?php echo e($start_date); ?></td>
									<td><?php echo e($end_date); ?></td>
									<td><div class="form-check">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input class="form-check-input"  type="checkbox" id="gridCheck1" disabled="disabled" ></div></td>									
									<td> 
										 <a href="javascript:void(0);" data-id="<?php echo e($items->uuid); ?>" data-name="<?php echo e($items->name); ?>" data-desc="<?php echo e($items->description); ?>"  data-type="<?php echo e($items->event_type); ?>" data-sdate="<?php echo e($start_date); ?>" data-edate="<?php echo e($end_date); ?>" data-active="<?php echo e($items->is_active); ?>" data-productive="<?php echo e($items->is_productive); ?>" class="editModel btn btn-success btn-floating" data-toggle="tooltip" data-placement="top" title="Edit">
										 <i class="fa fa-edit"></i></a>
											
										<a href="javascript:void(0);"  data-url="<?php echo e(route('events.remove', $items->uuid)); ?>" class="confirmDelete btn btn-danger btn-floating"  data-toggle="tooltip" data-placement="top" title="Delete">
										<i class="fa fa-trash"></i></a> 
									</td>
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
									
								<?php else: ?>
									No record found..
								<?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<!-- .modal -->
	<div class="modal fade showModel">
		<div class="modal-dialog modal-lg">
			<form name="modelFrm" method="post" action="" class="frmAction needs-validation" novalidate>
			<!-- CROSS Site Request Forgery Protection -->
			<?php echo csrf_field(); ?>	
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
									<option value="0">-- Select Event Type --</option>
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
								<input type="text" name="start_date" class="form-control txtsdate" id="sdatepicker" style="width: 100%" required >
							</div>						
							<div class="col-sm-2"><strong>End Date</strong>:</div>
							<div class="col-sm-4">
								<input type="text" name="end_date" class="form-control txtedate" id="edatepicker" style="width: 100%" required >								
							</div>
						</div> 						
						<div class="form-group row">
							<div class="col-sm-2"><strong>Active</strong>:</div>
							<div class="col-sm-4">
								<input  type="checkbox" name="is_active" class="form-check-input" value="false" id="active">
							</div>
							<div class="col-sm-2"><strong>Productive</strong>:</div>
							<div class="col-sm-4">
								<input  type="checkbox" name="is_productive" class="form-check-input" value="false" id="productive">
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


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>
<script>
jQuery(function($) {
    $("#sdatepicker").datetimepicker({ format: 'YYYY-MM-DD hh:mm:ss'});
	$("#edatepicker").datetimepicker({ format: 'YYYY-MM-DD hh:mm:ss'});
});
</script>
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
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){	 
	$("body").on("click", ".addModel", function(event){ 		
		$(".txttitle").show().text('Create Events');
		$('.frmAction').attr('action', "<?php echo e(route('events.save')); ?>");
		
		$(".uuid").hide().val('');
		$(".txtname").val('');	
		$(".txtdescription").val('');
		$(".txtsdate").val('');
		$(".txtedate").val('');
		$(".txttype").val('0');	
		$('input[name=is_active]').attr('checked', false);
		$('input[name=is_productive]').attr('checked', false);		
		
		$('.showModel').modal({
			backdrop: 'static',
			keyboard: false
		});
	});
});
$(document).ready(function(){
	$("body").on("click", ".editModel", function(event){ 		 
		$(".txttitle").show().text('Update Events');	
		$('.frmAction').attr('action', "<?php echo e(route('events.update')); ?>");	
	 	
		var uuid 			= $(this).data("id"); 
		var name 			= $(this).data("name"); 
		var description 	= $(this).data("desc");
		var sdate 			= $(this).data("sdate"); 
		var edate 			= $(this).data("edate"); 
		var active 			= $(this).data("active"); 
		 
		var productive 		= $(this).data("productive"); 
		var type 			= $(this).data("type"); 
		
		$(".txttype option").each(function()
		{
			var selOptVal = $(this).val();
			if(selOptVal == type)
			{
				$(this).attr('selected', true);
			}
		});
		
		if(active == 1){		 
			$('#active').attr('checked',true);
		}		 
		if(productive == 1){		 
			$('#productive').attr('checked',true);
		}
		  
		$(".uuid").show().val(uuid);
		$(".txtname").val(name);	
		$(".txtdescription").val(description);
		$(".txtsdate").val(sdate);
		$(".txtedate").val(edate);

		
		$('.showModel').modal({
			backdrop: 'static',
			keyboard: false
		});
		 
	});
});

</script>
<script type="text/javascript">
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
		 var url = $(this).data("url");	
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
<script src="<?php echo e(url('public/vendors/prism/prism.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_demo_app\resources\views/events/index.blade.php ENDPATH**/ ?>