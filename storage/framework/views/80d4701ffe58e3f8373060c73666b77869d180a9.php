<?php $__env->startSection('head'); ?>
   <!-- Prism -->
<link rel="stylesheet" href="<?php echo e(url('public/vendors/prism/prism.css')); ?>" type="text/css"> 	 
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
            <h4>Activity</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="<?php echo e(asset('public/assets/media/image/icons/home.png')); ?>" alt="">
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
                        <button type="button" class="addModel btn btn-secondary btn-floating" data-toggle="tooltip" data-placement="top" title="Add">
						 <i class="ti-plus"></i></button>
						  <button class="importBtn btn btn-secondary btn-floating" data-toggle="tooltip" data-placement="top" title="Import Activity"><i class="fa fa-home"></i></button>
                    </div>
                </div>
                <div class="card">						
                    <div class="card-body">
					<table class="table table-striped table-bordered nowrap showDatatable" cellspacing="0" width="100%">
                        
                            <thead>
                            <tr>
                                <th>S.No.</th>                                							
								<th>Org Name</th>
								<th>Name</th>
								<th>Description</th> 								
                                <th>Is Active</th>                                
                                <th>Modified On</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
							<?php if($res): ?>
							<?php $__currentLoopData = $res; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php $item_id = Crypt::encrypt($item->uuid); ?>
                            <tr>
                                <td><?php echo e($key+1); ?></td>
                                <td><?php echo e($item->org_name); ?></td>  
								<td><?php echo e($item->name); ?></td> 
								<td><?php echo e($item->description); ?></td>                                 
                                <td><div class="form-check">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input class="form-check-input"  type="checkbox" id="gridCheck1" disabled="disabled" <?php echo e(($item->is_active == true ? ' checked' : '')); ?>></div></td>
                                <td><?php echo e($item->modified_on); ?></td>
                                <td> 
									<!--<a href="javascript:void(0); return false;" data-id="<?php echo e($item->uuid); ?>/@ASVAY@/<?php echo e($item->name); ?>/@ASVAY@/<?php echo e($item->description); ?>" class="editModel btn btn-success btn-floating" data-toggle="tooltip" data-placement="top" title="Edit">
									 <i class="fa fa-edit"></i></a>-->
									 <a href="javascript:void(0);"  data-uuid="<?php echo e($item->uuid); ?>" data-name="<?php echo e($item->name); ?>" data-desc="<?php echo e($item->description); ?>" data-active="<?php echo e($item->is_active); ?>" class="editModel btn btn-success btn-floating" data-toggle="tooltip" data-placement="top" title="Edit">
									 <i class="fa fa-edit"></i></a>
										
									<a href="javascript:void(0);"  data-id="<?php echo e(route('activity.remove', $item_id)); ?>" class="confirmDelete btn btn-danger btn-floating"  data-toggle="tooltip" data-placement="top" title="Delete">
									<i class="fa fa-trash"></i></a> 
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
	<div class="modal fade showModel">
		<div class="modal-dialog">
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
							<div class="col-sm-4"><strong>Is Active</strong>:</div>
							<div class="col-sm-6">
								<input  type="checkbox" name="is_active" class="form-check-input" value="false" id="invalidCheck" required>
								<div class="invalid-feedback">
									You must check is active before submitting.
								  </div> 								
							</div>
						</div> 
					</div>   
					<div class="modal-footer">
						<button type="submit"  class="btn btn-primary btn-rounded">Save changes</button>
						<button type="button" class="btn btn-primary btn-rounded" data-dismiss="modal">Close</button>								                              
					</div>
				</div> 
			</form>
		</div>                                          
	</div>	

<!-- .modal for import  -->
	<div class="modal fade showImportModel">
		<div class="modal-dialog modal-xl">
			<form name="importFrm" method="post" action="" class="frmAction">
			<!-- CROSS Site Request Forgery Protection -->
			<?php echo csrf_field(); ?>	
				<div class="modal-content">
					<div class="modal-header">					 
						<h4 class="modal-title"><span class="txttitle"></span></h4> 
						<button type="button" class="close" data-dismiss="modal">×</button>								
					</div>
					<div class="modal-body">
						<table class="table table-striped table-bordered nowrap" cellspacing="0" border="1px;">                        
                            <thead>
                            <tr>
                                <th class="text-center"><strong>#</strong></th> 
								<th class="text-center"><strong>Name</strong></th>
								<th class="text-center"><strong>Description</strong></th> 								
                                <th class="text-center"><strong>Is Active</strong></th>  
                            </tr>
                            </thead>
                            <tbody>
							<?php if($activity): ?>
							<?php $__currentLoopData = $activity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $ac): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>							 
                            <tr>
                                <td class="text-center"><input name="chk[]" type="checkbox" value="<?php echo e($ac->uuid); ?>" class="chkInput form-check-input"></td>
								<td class="text-center"><input type="text" name="name[]" value="<?php echo e($ac->name); ?>" class="form-control"></td> 
								<td class="text-center"><input type="text" name="description[]" value="<?php echo e($ac->description); ?>" class="form-control"></td>                                 
                                <td class="text-center">
									<div class="form-check">
										<input name="is_active[]" type="checkbox" id="gridCheck1" class="form-check-input"  <?php echo e(($item->is_active == true ? ' checked' : '')); ?>>
									</div>
								</td>                                
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
							<?php endif; ?>
                            </tbody>
                        </table>
					</div>   
					<div class="modal-footer">
						 <div class="col-md-12 text-center">
							<button type="submit"  class="submitbtn btn btn-primary btn-rounded">Save changes</button>
							<button type="button" class="btn btn-primary btn-rounded" data-dismiss="modal">Close</button>								                              
						</div>
					</div>
				</div> 
			</form>
		</div>                                          
	</div>	 	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
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
	$('.addModel').click(function(){		
		$(".txttitle").show().text('Create Activity');
		$('.frmAction').attr('action', "<?php echo e(route('activity.save')); ?>");
		
		$(".uuid").hide().val('');
		$(".txtname").val('');	
		$(".txtdescription").val('');
		
		$('.showModel').modal({
			backdrop: 'static',
			keyboard: false
		});
	});
});
$(document).ready(function(){
	$("body").on("click", ".editModel", function(event){ 		 
		$(".txttitle").show().text('Update Activity');	
		$('.frmAction').attr('action', "<?php echo e(route('activity.update')); ?>");		 	
		var uuid = $(this).data("uuid"); 
		var name = $(this).data("name"); 
		var description = $(this).data("desc"); 
		var is_active = $(this).data("active"); 
		 if(is_active == 1){
		   //alert("You have selected\n");
			$('#invalidCheck').attr('checked',true);
		  }
		  else{
			  $('#invalidCheck').attr('checked',false);	
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
 
</script>
<script type="text/javascript">
$(document).ready(function(){
	$('.importBtn').click(function(){		
		$(".txttitle").show().text('Import Activity');
		$('.frmAction').attr('action', "<?php echo e(route('activity.syncActivity')); ?>");		
		$('.showImportModel').modal({
			backdrop: 'static',
			keyboard: false
		});
	});
    $(".submitbtn").click(function(){		
         if ($('.chkInput').filter(':checked').length < 1){
                alert("Please Check at least one Checked?");
                 return false;
         }else{
             alert("Proceed");
         }
    });
});
</script>

    <!-- Prism -->	  
    <script src="<?php echo e(url('public/vendors/prism/prism.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_demo_app\resources\views/activity/index.blade.php ENDPATH**/ ?>