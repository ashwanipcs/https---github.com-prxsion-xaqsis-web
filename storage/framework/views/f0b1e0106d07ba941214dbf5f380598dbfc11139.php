<?php $__env->startSection('head'); ?>
<!-- Prism -->
<link rel="stylesheet" href="<?php echo e(url('vendors/prism/prism.css')); ?>" type="text/css"> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <!-- begin::page-header -->
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Profile</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="<?php echo e(url('assets/media/image/icons/home.png')); ?>" alt="">
                        <a href="#">Settings</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- end::page-header -->

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body text-center">
                        <figure class="avatar avatar-lg m-b-20">
                           <?php if(file_exists(public_path().'/storage/users/'.Session::get('account_uuid').'/'.Session::get('account_uuid').'.jpg' )): ?>
								<img src="<?php echo e(url('storage/users/'.Session::get('account_uuid').'/'.Session::get('account_uuid').'.jpg' )); ?>" class="rounded-circle" alt="...">
									 
							<?php else: ?>
								<img src="<?php echo e(url('assets/media/image/user/women_avatar1.jpg')); ?>" class="rounded-circle" alt="...">
							<?php endif; ?>
						</figure>
                        <h5 class="mb-1">Roxana Roussell </h5>
                        <p class="text-muted small">Web Developer</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus repudiandae eveniet
                            harum.</p>
                        <!--<a href="<?php echo e(route('editprofile')); ?>" class="btn btn-outline-primary">
                            <i data-feather="edit-2" class="mr-2"></i> </a> -->
							<button type="button" id="formButton" class="btn btn-outline-primary">Edit Profile</button>
						<a href="javascript:void(0);" class="btn btn-outline-primary profileImg">						 
						 <i data-feather="edit-2" class="mr-2"></i>Upload</a>
						<a href="<?php echo e(route('changeaccountpassword')); ?>" class="btn btn-outline-primary">
                            <i data-feather="edit-2" class="mr-2"></i> Update Password</a>
                    </div>
                </div>
				 <?php if($result): ?>
				<div class="personalData">
				<div class="card">
                    <div class="card-body">
                        <div class="accordion custom-accordion">
                            <div class="accordion-row open">
                              <a href="#" class="accordion-header">
                                <span>Personal Details</span>
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon close" src="<?php echo e(asset('assets/media/image/icons/arrow-up.png')); ?>" alt="">
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon open fa fa-chevron-down" src="<?php echo e(asset('assets/media/image/icons/down-arrow.png')); ?>" alt="">
                             
                              </a>
							 
                              <div class="accordion-body">
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">First Name:</div>
                                            <div class="col-6"><?php echo e($result->data->first_name); ?></div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Last Name:</div>
                                            <div class="col-6"><?php echo e($result->data->last_name); ?></div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Middle Name:</div>
                                            <div class="col-6"><?php if($result->data->middle_name): ?><?php echo e($result->data->middle_name); ?> <?php else: ?> N/A <?php endif; ?></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Email:</div>
                                            <div class="col-6"><?php if($result->data->email): ?><?php echo e($result->data->email); ?> <?php else: ?> N/A <?php endif; ?></div>
                                        </div>
										<!--<div class="row mb-2">
                                            <div class="col-6 text-muted">OTP:</div>
                                            <div class="col-6"><?php if($result->data->otp): ?><?php echo e($result->data->otp); ?> <?php else: ?> N/A <?php endif; ?></div>
                                        </div>-->
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Position:</div>
                                            <div class="col-6"><?php if($result->data->position_title): ?><?php echo e($result->data->position_title); ?> <?php else: ?> N/A <?php endif; ?> </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Country:</div>
                                            <div class="col-6"><?php if($result->data->country): ?><?php echo e($result->data->country); ?> <?php else: ?> N/A <?php endif; ?></div>
                                        </div> 
										<div class="row mb-2">
                                            <div class="col-6 text-muted">State:</div>
                                            <div class="col-6"><?php if($result->data->state): ?><?php echo e($result->data->state); ?> <?php else: ?> N/A <?php endif; ?></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">City:</div>
                                            <div class="col-6"><?php if($result->data->city): ?><?php echo e($result->data->city); ?> <?php else: ?> N/A <?php endif; ?></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Postal Code:</div>
                                            <div class="col-6"><?php if($result->data->postal_code): ?><?php echo e($result->data->postal_code); ?> <?php else: ?> N/A <?php endif; ?></div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Address Line1:</div>
                                            <div class="col-6"><?php if($result->data->address_line1): ?><?php echo e($result->data->address_line1); ?> <?php else: ?> N/A <?php endif; ?></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Address Line2:</div>
                                            <div class="col-6"><?php if($result->data->address_line2): ?><?php echo e($result->data->address_line2); ?> <?php else: ?> N/A <?php endif; ?></div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Mobile Phone:</div>
                                            <div class="col-6"><?php if($result->data->mobile_phone): ?><?php echo e($result->data->mobile_phone); ?> <?php else: ?> N/A <?php endif; ?></div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Work Phone:</div>
                                            <div class="col-6"><?php if($result->data->work_phone): ?><?php echo e($result->data->work_phone); ?> <?php else: ?> N/A <?php endif; ?></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Home Phone:</div>
                                            <div class="col-6"><?php if($result->data->home_phone): ?><?php echo e($result->data->home_phone); ?> <?php else: ?> N/A <?php endif; ?></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Date Of Brith:</div>
                                            <div class="col-6"><?php if($result->data->dob): ?><?php echo e($result->data->dob); ?> <?php else: ?> N/A <?php endif; ?></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Date Of Joining:</div>
                                            <div class="col-6"><?php if($result->data->doj): ?><?php echo e($result->data->doj); ?> <?php else: ?> N/A <?php endif; ?></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Employment Type:</div>
                                            <div class="col-6"><?php if($result->data->employment_type): ?><?php echo e($result->data->employment_type); ?> <?php else: ?> N/A <?php endif; ?></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Employment Code:</div>
                                            <div class="col-6"><?php if($result->data->employment_code): ?><?php echo e($result->data->employment_code); ?> <?php else: ?> N/A <?php endif; ?></div>
                                        </div>									
                             
                              </div>
                            </div>
                            <div class="accordion-row">
                              <a href="#" class="accordion-header">
                                <span>Organization Details</span>
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon close" src="<?php echo e(asset('assets/media/image/icons/arrow-up.png')); ?>" alt="">
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon open fa fa-chevron-down" src="<?php echo e(asset('assets/media/image/icons/down-arrow.png')); ?>" alt="">
                             
                              </a>
                              <div class="accordion-body">
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Manager:</div>
                                    <div class="col-6"><?php if($result->data->manager): ?> <?php echo e($result->data->manager); ?> <?php else: ?> N/A <?php endif; ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Billing Manager:</div>
                                    <div class="col-6"><?php if($result->data->is_billing_manager): ?> True <?php else: ?> False <?php endif; ?></div>
                                </div>
                               
                              </div>
                            </div>
                            <div class="accordion-row">
                              <a href="#" class="accordion-header">
                                <span>Role Details</span>
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon close" src="<?php echo e(asset('assets/media/image/icons/arrow-up.png')); ?>" alt="">
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon open fa fa-chevron-down" src="<?php echo e(asset('assets/media/image/icons/down-arrow.png')); ?>" alt="">
                             
                              </a>
                              <div class="accordion-body">
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Administrator:</div>
                                    <div class="col-6"><?php if($result->data->is_administrator): ?> True <?php else: ?> False <?php endif; ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Primary:</div>
                                    <div class="col-6"><?php if($result->data->is_primary): ?> True <?php else: ?> False <?php endif; ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Active:</div>
                                    <div class="col-6"><?php if($result->data->is_active): ?> True <?php else: ?> False <?php endif; ?></div>
                                </div>
                                
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
			</div>

				<form id="form1" name="frmPersonal" method="post" action="<?php echo e(route('updateprofile')); ?>" class="needs-validation" novalidate>
					 <?php echo csrf_field(); ?>
                <div class="card">
				
                    <div class="card-body">
                        <div class="accordion custom-accordion">
                            <div class="accordion-row open">
                              <a href="#" class="accordion-header">
                                <span>Personal Details</span>
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon close" src="<?php echo e(asset('assets/media/image/icons/arrow-up.png')); ?>" alt="">
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon open fa fa-chevron-down" src="<?php echo e(asset('assets/media/image/icons/down-arrow.png')); ?>" alt="">
                             
                              </a>
							 
								<div class="form-row">
								  <div class="form-group col-md-6">												
									<input type="hidden"  name="org_uuid" value="<?php echo e($result->data->org_uuid); ?>">							  
									<input type="hidden" name="uuid" value="<?php echo e($result->data->uuid); ?>">
								</div></div>
                              <div class="accordion-body">
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">First Name:</div>
                                            <div class="col-6">
											 <input type="text" name="first_name" value="<?php echo e($result->data->first_name); ?>" class="form-control" id="txtFirstName" placeholder="First Name" required>
											</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Last Name:</div>
                                            <div class="col-6">
											<input type="text" name="last_name" value="<?php echo e($result->data->last_name); ?>" class="form-control" id="txtLastname" placeholder="Last Name" required>
											</div>
                                        </div> 
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Middle Name:</div>
                                            <div class="col-6"><input type="text" name="middle_name" value="<?php echo e($result->data->middle_name); ?>" class="form-control" id="middle_name" placeholder="Manager"></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Email:</div>
                                            <div class="col-6"><input type="email" value="<?php echo e($result->data->email); ?>" name="email" class="form-control" id="txtEmail" placeholder="Email" required></div>
                                        </div>	
										<!--div class="row mb-2">
                                            <div class="col-6 text-muted">OTP:</div>
                                            <div class="col-6"><input type="text" name="otp" value="<?php echo e($result->data->otp); ?>"class="form-control" id="otp" placeholder="OTP"></div>
                                        </div>-->										 
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Position:</div>
                                            <div class="col-6"><input type="text" name="position_title" value="<?php echo e($result->data->position_title); ?>" class="form-control" id="position_title" placeholder="Position  Title"></div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Country:</div>
                                            <div class="col-6"><input type="text" name="country" value="<?php echo e($result->data->country); ?>" class="form-control" id="txtCountry" placeholder="country"></div>
                                        </div> 
										<div class="row mb-2">
                                            <div class="col-6 text-muted">State:</div>
                                            <div class="col-6"><input type="text" name="state" value="<?php echo e($result->data->state); ?>" class="form-control" id="txtState" placeholder="State"></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">City:</div>
                                            <div class="col-6"><input type="text" name="city" value="<?php echo e($result->data->city); ?>" class="form-control" id="txtCity" placeholder="city"></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Postal Code:</div>
                                            <div class="col-6"><input type="text" name="postal_code" value="<?php echo e($result->data->postal_code); ?>" class="form-control" id="postal_code" placeholder="Postal Code"></div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Address Line1:</div>
                                            <div class="col-6"><input type="text" name="address_line1" value="<?php echo e($result->data->address_line1); ?>" class="form-control" id="address_line1" placeholder="Address  Line1"></div>
                                        </div>  
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Address Line2:</div>
                                            <div class="col-6"><input type="text" name="address_line2" value="<?php echo e($result->data->address_line2); ?>" class="form-control" id="address_line2" placeholder="Address  Line2"></div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Mobile Phone:</div>
                                            <div class="col-6"><input type="text" name="mobile_phone"  value="<?php echo e($result->data->mobile_phone); ?>" class="form-control" id="mobile_phone" placeholder="Mobile Phone"></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Work Phone:</div>
                                            <div class="col-6"><input type="text" name="work_phone" value="<?php echo e($result->data->work_phone); ?>" class="form-control" id="work_phone" placeholder="Work Phone"></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Home Phone:</div>
                                            <div class="col-6"> <input type="text" name="home_phone" value="<?php echo e($result->data->home_phone); ?>" class="form-control" id="home_phone" placeholder="Home Phone"></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">DOB:</div>
                                            <div class="col-6"><input type="text" name="dob" value="<?php echo e($result->data->dob); ?>" class="form-control" id="dob" placeholder="DOB"></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">DOJ:</div>
                                            <div class="col-6"><input type="text" name="doj" value="<?php echo e($result->data->doj); ?>" class="form-control" id="doj" placeholder="DOJ"></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Employment Type:</div>
                                            <div class="col-6"><input type="text" name="employment_type" value="<?php echo e($result->data->employment_type); ?>" class="form-control" id="employment_type" placeholder="Employment Code"></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Employment Code:</div>
                                            <div class="col-6"><input type="text" name="employment_code" value="<?php echo e($result->data->employment_code); ?>" class="form-control" id="employment_code" placeholder="Employment Code"></div>
                                        </div>                                        
                              </div>
							 
                            </div>
                            <div class="accordion-row">
                              <a href="#" class="accordion-header">
                                <span>Organization Details</span>
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon close" src="<?php echo e(asset('assets/media/image/icons/arrow-up.png')); ?>" alt="">
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon open fa fa-chevron-down" src="<?php echo e(asset('assets/media/image/icons/down-arrow.png')); ?>" alt="">
                             
                              </a>
                              <div class="accordion-body">
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Manager:</div>
                                    <div class="col-6"><input type="text" name="manager" value="<?php echo e($result->data->manager); ?>" class="form-control" id="manager" placeholder="Manager"></div>
                                </div>
                                 <div class="row mb-2">
                                    <div class="col-6 text-muted">Billing Manager:</div>
                                    <div class="col-6">
									<input class="form-check-input" name="is_billing_manager" value="1"   type="checkbox" id="gridCheck" <?php if($result->data->is_billing_manager): ?> checked <?php endif; ?>>
									</div>
                                </div>
                                
                              </div>
                            </div>
                            <div class="accordion-row">
                              <a href="#" class="accordion-header">
                                <span>Role Details</span>
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon close" src="<?php echo e(asset('assets/media/image/icons/arrow-up.png')); ?>" alt="">
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon open fa fa-chevron-down" src="<?php echo e(asset('assets/media/image/icons/down-arrow.png')); ?>" alt="">
                             
                              </a>
                              <div class="accordion-body">
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Administrator:</div>
                                    <div class="col-6">
									<input class="form-check-input" name="is_administrator" value="1" type="checkbox" id="gridCheck" <?php if($result->data->is_administrator): ?> checked <?php endif; ?>>
									</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Primary:</div>
                                    <div class="col-6"> <input class="form-check-input" name="is_primary" value="1" type="checkbox" id="gridCheck" <?php if($result->data->is_primary): ?> checked <?php endif; ?>></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Active:</div>
                                    <div class="col-6"><input class="form-check-input" name="is_active" value="1" type="checkbox" id="gridCheck" <?php if($result->data->is_active): ?> checked <?php endif; ?>></div>
                                </div>
                                 
                              </div>
                            </div>
                          </div>
                    </div>					
					<div class="form-actions">
						<center>
						<button type="submit" class="submit btn btn-primary ">
							Save Change <i class="icon-angle-right"></i>
						</button>
						</center>
					</div>
                </div>
				</form>
			<?php endif; ?>
            </div>
        </div>
    </div>
	
	<!-- .modal -->
	<div class="modal fade showModel">
		<div class="modal-dialog">
			<form name="profileFrm" method="post" action="<?php echo e(route('uploads')); ?>" enctype="multipart/form-data">
			<!-- CROSS Site Request Forgery Protection -->
			<?php echo e(csrf_field()); ?>

				<div class="modal-content">
					<div class="modal-header">					 
						<h4 class="modal-title"><span class="txttitle"></span></h4> 
						<button type="button" class="close" data-dismiss="modal">×</button>								
					</div> 
					<div class="modal-body">
						<div class="form-group row">
							<div class="col-sm-4"><strong>Image</strong>:</div>							 
							<div class="col-sm-8">								
								<input type="file" name="filename" class="form-control" style="width: 70%" required >								 
							</div>
						</div>						  
					<!-- end Setting section-->							
					</div>   
					<div class="modal-footer">
						<button type="submit"  class="btn btn-primary btn-rounded">Upload</button>
						<button type="button" class="btn btn-primary btn-rounded" data-dismiss="modal">Close</button>								                              
					</div>
				</div> 
			</form>
		</div>                                          
	</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
$(document).ready(function() {
	$("#form1").hide();
  $("#formButton").click(function() {
	  $(".personalData").hide();
    $("#form1").toggle();
  });
});

$(document).ready(function(){
	$('.profileImg').click(function(){
		$(".txttitle").show().text('Upload Profile Image');		 
		$('.showModel').modal({
			backdrop: 'static',
			keyboard: false
		});
	});
});

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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_demo_app\resources\views/users/profile.blade.php ENDPATH**/ ?>