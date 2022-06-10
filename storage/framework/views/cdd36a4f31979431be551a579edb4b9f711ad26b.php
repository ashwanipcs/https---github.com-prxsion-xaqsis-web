<?php $__env->startSection('head'); ?>
   <!-- Prism -->
<link rel="stylesheet" href="<?php echo e(url('vendors/prism/prism.css')); ?>" type="text/css"> 	
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
            <h4>Accounts</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="<?php echo e(asset('assets/media/image/icons/home.png')); ?>" alt="">
                        <a href="#">Manage</a>
                    </li>                    
                    <li class="breadcrumb-item active" aria-current="page">Accounts</li>
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
                       <!-- <button type="button" class="addModel btn btn-secondary btn-floating" data-toggle="tooltip" data-placement="top" title="Add">
						 <i class="ti-plus"></i></button>-->
						<button type="button" class="btn btn-primary refresh" data-toggle="tooltip" data-placement="top" title="Refresh Access">
						 Refresh Access</button>
						<a href="javascript:void(0);" class="btn btn-primary frmAclValidatetion" data-toggle="tooltip" data-placement="top" title="Access Control">
							<span style="color:white;">Access Control </span></a>
						<?php if($res): ?>
						<a href="javascript:void(0);"  data-orguuid="<?php echo e($org_uuid); ?>" data-orgname="<?php echo e($org_name); ?>" data-url="<?php echo e($inviteurl); ?>" class="editModel btn btn-primary" data-toggle="tooltip" data-placement="top" title="Invite User">
							<span style="color:white;">Invite User </span></a>
						<?php endif; ?>
						
                    </div>
                </div>
                <div class="card">						
                    <div class="card-body">
					<table class="table table-striped table-bordered nowrap showDatatable" id="accountDataTabl" cellspacing="0" width="100%">
                        
                            <thead>
                            <tr>
                                <th>#</th> 
								<th>First Name</th>
								<th>Last Name</th> 	
								<th>Email</th> 
                                <th>Position</th>
								<?php if($userRoles): ?>
								<?php $__currentLoopData = $userRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roleIndex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>								 
								<th><?php echo e($roleIndex->name); ?></th>								 
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							    <?php endif; ?>
								<th>Is Active</th>
                            </tr>
                            </thead>
                          
						  	 <form name="frmAACL" id="frmAACLIds" method="post" action="<?php echo e(route('accesscontrol')); ?>">
							 <?php echo csrf_field(); ?>
							<?php if($res): ?> 
								 <tbody>
								<?php $__currentLoopData = $res; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $rs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							
								<tr>
									<td>										 
									<input type="radio" name="uuid" class="txtuuid" id="uuid_<?php echo e($key); ?>" value="<?php echo e($rs->account_uuid); ?>"/>										 									
									</td>
									<td><?php echo e($rs->first_name); ?>

									<input type="hidden" name="fname" class="txtfname" value="<?php echo e($rs->first_name); ?>" />
									</td>
									<td><?php echo e($rs->last_name); ?>									
									</td> 								 
									<td><?php echo e($rs->email); ?>

										<input type="hidden" name="email" class="txtemail" value="<?php echo e($rs->email); ?>" />
									</td> 								 		
									<td> <?php echo e($rs->position_title); ?></td>
									<?php if($rs->roles): ?>
										<?php $__currentLoopData = $rs->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roleIndex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<td> 
										<input type="checkbox" value="1" disabled name="role_name[]" <?php if($roleIndex->is_active): ?> checked <?php endif; ?>>
										</td>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php else: ?>
										<?php $__currentLoopData = $userRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roles): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<td> 
										<input type="checkbox" value="1" disabled name="role_name[]">
										</td>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endif; ?>
									<td> <input type="checkbox" value="1" disabled name="is_active[<?php echo e($rs->account_uuid); ?>]" <?php if($rs->is_active): ?> checked <?php endif; ?>></td> 
									</tr> 
								  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>								  
								<?php endif; ?>
                           </form>
                        </table>
                    </div>
                </div>
				
				
            </div>
        </div>
    </div>
	
	<div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">                                           
					  <div class="col-md-12 card">
						  <div class="card-body"><h4>Invite Users Listing</h4></div>
						</div>
                </div>
                <div class="card">						
                    <div class="card-body">
					<table class="table table-striped table-bordered nowrap showInviteDatatable" id="inviteUserDataTabl" cellspacing="0" width="100%">
                        
                            <thead>
                            <tr>
                                <th>#</th> 
								<th>First Name</th>
								<th>Last Name</th> 	
								<th>Email</th> 
                                <th>Org Name</th>								 
								<th>Action</th>
                            </tr>
                            </thead>
                          
						  	 
							<?php if($inviteUsers): ?> 
								<?php $__currentLoopData = $inviteUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $users): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							 <tbody>
								<tr>
									<td><?php echo e($index+1); ?></td>
									<td><?php echo e($users->first_name); ?>

									<input type="hidden" name="fname" class="txtfname" value="<?php echo e($users->first_name); ?>" />
									</td>
									<td><?php echo e($users->last_name); ?>									
									</td> 								 
									<td><?php echo e($users->email); ?>

										<input type="hidden" name="email" class="txtemail" value="<?php echo e($users->email); ?>" />
									</td> 
									<td> <?php echo e($users->org_name); ?>

										<input type="hidden" name="org_name" class="txtorgname" value="<?php echo e($users->org_name); ?>">
									</td>										 
									<td> Re-Invite User</td> 
								</tr> </tbody>
								  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
								<?php endif; ?>
                           
                        </table>
                    </div>
                </div>
				
				
            </div>
        </div>
    </div>
	
	
	<!-- .modal -->
	<div class="modal fade showModel">
		<div class="modal-dialog modal-lg">
			<form name="modelFrm" method="post" action="<?php echo e(route('invitation')); ?>" class="frmAction needs-validation" novalidate>
			<!-- CROSS Site Request Forgery Protection -->
			<?php echo csrf_field(); ?>	
				<div class="modal-content">
					<div class="modal-header">					 
						<h4 class="modal-title"><span class="txttitle"></span></h4> 
						<button type="button" class="close" data-dismiss="modal">×</button>								
					</div>
					<div class="modal-body">
						<input type="hidden" name="org_uuid" class="form-control orguuid">
						<input type="hidden" name="invite_url" class="form-control inviteurl">						
						<div class="form-group row">
							<div class="col-sm-3"><strong>New Account First Name</strong>:</div>
							<div class="col-sm-7">
								<input type="text" name="new_account_name" class="form-control" style="width: 100%" required />								
							</div>
							 
						</div>
						<div class="form-group row">
							<div class="col-sm-3"><strong>New Account Last Name</strong>:</div>
							<div class="col-sm-7">
								<input type="text" name="new_account_lname" class="form-control" style="width: 100%" required />								
							</div>
							 
						</div>
						<div class="form-group row">
							<div class="col-sm-3"><strong>New Account Email</strong>:</div>							 
							<div class="col-sm-7">
								<input type="text" name="new_account_email" class="form-control" style="width: 100%" required />								
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

<script type="text/javascript">
 $(function () {
		$('[data-toggle="tooltip"]').tooltip();
	});	
$(document).ready(function() {
		
	var table = $('#inviteUserDataTabl').DataTable( {       
        scrollX:        false,
        scrollCollapse: true,
        autoWidth:      true,  
        paging:         true, 
		searching: 		true,	     
        
    });	
});
$(document).ready(function() {
		var table = $('#accountDataTabl').DataTable( {       
        scrollX:        false,
        scrollCollapse: true,
        autoWidth:      true,  
        paging:         true, 
		 	
        
    });
});
	
$(document).ready(function() {
	/* Ajax method for refresh access */
	$(".refresh").click(function(e){
		 e.preventDefault();
		if($('.txtuuid').filter(':checked').length < 1){
                //alert("Please Check at least one");
				setTimeout(() => {
					  toastr.error("Please select at least one checkbox before Refresh Access?");
					  },1000) 
                 return false;
         }else{
			//alert('click on refresh button');
			var uuid = $('.txtuuid:checked').val();
			alert(uuid);
			var fname = $(".txtfname").val();
			var email = $(".txtemail").val();
			//alert(uuid+" f name: "+fname+" Email: "+email);
			var url ="<?php echo e(route('refreshaccess')); ?>";
			//alert(url);
				 $.ajaxSetup({
					  headers: {
						  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
					  }
				  });
				$.ajax({
						url:url,
						type:'GET',
						data:{uuid:uuid,fname:fname,email:email},
						success:function(rs)
						{
							 //alert(rs.status.response);
							 setTimeout(() => {
							  toastr.success(rs.status.message);
							  },1000) 
							 location.reload(true);
						},
						  error: function(rs) {
							setTimeout(() => {
							  toastr.success(rs.status.message);
							  },1000) 
							 location.reload(true);	  
						  }
						
				});
			}
		});
	/* End Refresh Access Ajax */
	
	/*Access Control */	  
	$(".frmAclValidatetion").click(function(e){
		 e.preventDefault();
		if($('.txtuuid').filter(':checked').length < 1){
                //alert("Please Check at least one");
				setTimeout(() => {
					  toastr.error("Please select at least one checkbox before Access Control Submit?");
					  },1000) 
                 return false;
         }else{
			 //var uuid = $(".txtuuid").val();
			var uuid = $('.txtuuid:checked').val();
			 alert(uuid);
			window.location.href="<?php echo e(route('accesscontrol')); ?>"+"?account_uuid="+uuid;			
			//$("#frmAACLIds").submit();
		 } 
    }); 
	/*End ACL */

});
</script>
<script type="text/javascript">
$(document).ready(function(){	 
	$("body").on("click", ".editModel", function(event){ 	
		 
			var org_uuid = $(this).data('orguuid');
			var org_name = $(this).data('orgname');
			var invite_url = $(this).data('url');		
			
			 $(".txttitle").show().text('Send an invitation -'+org_name);
			$(".txtname").val(org_name);	
			$(".orguuid").val(org_uuid);
			$(".inviteurl").val(invite_url);
			 
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
  
 
 
</script>
<!-- Prism -->	  
<script src="<?php echo e(url('vendors/prism/prism.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_demo_app\resources\views/dashboard/accounts.blade.php ENDPATH**/ ?>