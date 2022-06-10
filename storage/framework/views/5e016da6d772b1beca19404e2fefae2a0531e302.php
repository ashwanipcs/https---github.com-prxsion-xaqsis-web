<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>XAQSIS - Register</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo e(url('public/assets/media/image/favicon.png')); ?>"/>
    <!-- Plugin styles -->
    <link rel="stylesheet" href="<?php echo e(url('public/vendors/bundle.css')); ?>" type="text/css">
    <!-- App styles -->
    <link rel="stylesheet" href="<?php echo e(url('public/assets/css/app.min.css')); ?>" type="text/css">
	<link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet"/>
	<style>
	.toggle-password-eye {
		float: right;
		top: -50px;
		right: 25px;
		position: relative;
		cursor: pointer;
	}
	</style>
</head>
<body class="form-membership" style="padding: 0px;">
<!-- begin::preloader-->
<div class="preloader">
    <div class="preloader-icon"></div>
</div>
<!-- end::preloader -->
<div class="row">
    <div class="col-md-6">
        <img class="logo" width="100%" style="margin: 15px auto;" src="<?php echo e(url('public/assets/media/image/user/auth_image.jpg')); ?>" alt="image">
    </div>
    <div class="col-md-6">
        <div class="form-wrapper" style="margin: 14px auto;">
            <!-- logo -->
            <div id="logo" style="margin: -1rem 0 1rem;">
                <img class="logo" src="<?php echo e(url('public/assets/media/image/logo.png')); ?>" alt="image">
                <img class="logo-dark" src="<?php echo e(url('public/assets/media/image/logo-dark.png')); ?>" alt="image">
            </div>
            <!-- ./ logo -->
            <h5>Create account</h5>
				<?php if(Session::has('error')): ?>
				<div class="alert alert-danger">
					<?php echo e(Session::get('error')); ?>

					<?php
						Session::forget('error');
					?>
				</div>
				<?php endif; ?>
            <!-- form -->
            <form method="post" action="<?php echo e(route('login.saveregister')); ?>" class="needs-validation" novalidate>
			<?php echo csrf_field(); ?>
                <div class="form-group">
				 <?php if($errors->has('firstname')): ?>
						<span class="text-danger"><?php echo e($errors->first('firstname')); ?></span>
					<?php endif; ?>
                    <input name="firstname" id="validationCustom01" type="text" class="form-control" placeholder="Firstname" required />
                </div>
                <div class="form-group">
				<?php if($errors->has('lastname')): ?>
						<span class="text-danger"><?php echo e($errors->first('lastname')); ?></span>
					<?php endif; ?>
                    <input name="lastname" id="validationCustom02" type="text" class="form-control" placeholder="Lastname" required />
                </div>
                <div class="form-group">
					<?php if($errors->has('email')): ?>
						<span class="text-danger"><?php echo e($errors->first('email')); ?></span>
					<?php endif; ?>
                    <input name="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" id="validationCustom03" type="email" class="form-control" placeholder="Email" required />
                </div>
                <div class="form-group">
				<?php if($errors->has('password')): ?>
						<span class="text-danger"><?php echo e($errors->first('password')); ?></span>
					<?php endif; ?>
                    <input name="password" id="validationCustom04" type="password" class="form-control" placeholder="Password"  required />
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
                <hr>
                <p class="text-muted">Already have an account?</p>
                <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-light btn-sm">Sign in!</a>
            </form>
            <!-- ./ form -->

        </div>
    </div>
</div>

<!-- Plugin scripts -->
<script src="<?php echo e(url('public/vendors/bundle.js')); ?>"></script>

<!-- App scripts -->
<script src="<?php echo e(url('public/assets/js/app.min.js')); ?>"></script>
<script>
/* Show and Hide Password Field Text*/
const togglePasswordEye = '<i class="fa fa-eye toggle-password-eye"></i>';
const togglePasswordEyeSlash = '<i class="fa fa-eye-slash toggle-password-eye"></i>';

$(togglePasswordEyeSlash).insertAfter('input[type=password]');
$('input[type=password]').addClass('hidden-pass-input')

$('body').on('click', '.toggle-password-eye', function (e) {
    let password = $(this).prev('.hidden-pass-input');

    if (password.attr('type') === 'password') {
        password.attr('type', 'text');
        $(this).addClass('fa-eye').removeClass('fa-eye-slash');
    } else {
        password.attr('type', 'password');
        $(this).addClass('fa-eye-slash').removeClass('fa-eye');
    }
});

</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\laravel_demo_app\resources\views/register/register.blade.php ENDPATH**/ ?>