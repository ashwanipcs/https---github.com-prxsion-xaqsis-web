<?php $__env->startSection('head'); ?>
   <!-- Prism -->
    <link rel="stylesheet" href="<?php echo e(url('vendors/prism/prism.css')); ?>" type="text/css"> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
	 
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
            <h4>Recipients</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="<?php echo e(asset('assets/media/image/icons/home.png')); ?>" alt="">
                        <a href="#">Manage</a>
                    </li>
                    
                    <li class="breadcrumb-item active" aria-current="page">Recipients</li>
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
								<th>Email</th>               
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
                                <td><?php echo e($item->name); ?></td>  
								<td><?php echo e($item->email); ?></td>                                 
                                <td><div class="form-check">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input class="form-check-input"  type="checkbox" id="gridCheck1"></div></td>
                                <td><?php echo e($item->modified_on); ?></td>
                                <td> 
									<a href="javascript:void(0); return false;" data-projectuuid="<?php echo e($item->project_uuid); ?>" data-id="<?php echo e($item->uuid); ?>/@ASVAY@/<?php echo e($item->name); ?>/@ASVAY@/<?php echo e($item->email); ?>" class="editModel btn btn-success btn-floating" data-toggle="tooltip" data-placement="top" title="Edit">
									 <i class="fa fa-edit"></i></a>
										
									<a href="javascript:void(0); return false;"  data-id="<?php echo e(route('recipients.remove',$item_id)); ?>" class="confirmDelete btn btn-danger btn-floating"  data-toggle="tooltip" data-placement="top" title="Delete">
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
			<form name="frmProjects" method="post" action="<?php echo e(route('recipients.save')); ?>" class="needs-validation" novalidate>
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
							<div class="col-sm-4"><strong>Name</strong>:</div>
							<div class="col-sm-8">
								<input type="text" name="name" class="form-control txtname" style="width: 70%" required >								
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-4"><strong>Email</strong>:</div>
							<div class="col-sm-8">
								<input type="text" name="email" class="form-control txtemail" style="width: 70%" required >								
							</div>
						</div>	
						<div class="form-group row">
							<div class="col-sm-4"><strong>Projects</strong>:</div>
							<div class="col-sm-8">
								<select name="project_uuid" id="project_uuid" class="txtProjects form-control custom-select custom-select-sm" style="width: 70%" required>
								  <option selected>-- select projects--</option>
								  <?php if($projects): ?>
									 <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										 <option value="<?php echo e($val->uuid); ?>"><?php echo e($val->name); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php endif; ?>;
								</select>						
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <!-- DataTable -->
    <script>
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
        { "width": "150px", "targets": [0,1] },       
        { "width": "40px", "targets": [4] }
      ]
    } );
} );
	</script>
	<script>
$(document).ready(function(){
	 	
	$("body").on("click", ".addModel", function(event){ 
		$(".txttitle").show().text('Create Recipient');
		
		$(".uuid").hide().val('');
		$(".txtname").val('');	
		$(".txtemail").val('');
		 
		$('.showModel').modal({
			backdrop: 'static',
			keyboard: false
		});
	});
});
$(document).ready(function(){
	 
	$("body").on("click", ".editModel", function(event){ 
		$(".txttitle").show().text('Update Recipient');		
		var data = $(this).data("id");		 
		var fields = data.split('/@ASVAY@/');
		
		var id = fields[0];
		//alert(id);
		var name = fields[1];
		var email = fields[2];
		var project_uuid = $(this).data('projectuuid');
		// Select the Option.
		//here is code for id
		//looping through options select with jQuery
		$(".txtProjects option").each(function()
		{
			var selOptVal = $(this).val();
			if(selOptVal == project_uuid)
			{
				$(this).attr('selected', true);
			}
		});
		$(".uuid").show().val(id);
		$(".txtname").val(name);	
		$(".txtemail").val(email);
		
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
 
</script>
    <!-- Prism -->
	  
    <script src="<?php echo e(url('vendors/prism/prism.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_demo_app\resources\views/recipients/list.blade.php ENDPATH**/ ?>