<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>XAQSIS - Login</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('public/assets/media/image/favicon.png') }}"/>
    <!-- Plugin styles -->
    <link rel="stylesheet" href="{{ url('public/vendors/bundle.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ url('public/vendors/toastr/toastr.css') }}" type="text/css">
    <!-- App styles -->
    <link rel="stylesheet" href="{{ url('public/assets/css/app.min.css') }}" type="text/css">
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
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <img class="logo" width="100%" style="margin: 50px auto;" src="{{ url('public/assets/media/image/user/auth_image.jpg') }}" alt="image">
        </div>
        <div class="col-md-6">
            <div class="form-wrapper">

                <!-- logo -->
                <div id="logo" style="margin: -1rem 0 1rem;">
                    <img class="logo" src="{{ url('public/assets/media/image/logo.png') }}" alt="image">
                    <img class="logo-dark" src="{{ url('public/assets/media/image/logo-dark.png') }}" alt="image">
                </div>
                <!-- ./ logo -->            
                <h5>Sign in</h5>			 
                <!-- form -->
                 <form method="post" action="{{ route('login.save') }}" class="needs-validation" novalidate>
				 @csrf
                    <div class="form-group">
					 @if ($errors->has('email'))
						<span class="text-danger">{{ $errors->first('email') }}</span>
					@endif
                        <input name="email"  type="text" class="form-control" id="validationCustom01" placeholder="Username or email" required />
                    </div>
                    <div class="form-group">
					 @if ($errors->has('password'))
						<span class="text-danger">{{ $errors->first('password') }}</span>
					@endif
                        <input name="password" type="password" id="validationCustom02" class="form-control" placeholder="Password" required />
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" checked="" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Remember me</label>
                        </div>
                        <a href="{{route('forgotpassword')}}">Reset password</a>
                    </div>
                    <div class="d-grid mx-auto">
                       <button type="submit" class="btn btn-primary">Signin</button>
                    </div>
                    <hr>
                    
                    <p class="text-muted">Don't have an account?</p>
                    <a href="{{route('register')}}" class="btn btn-outline-light btn-sm">Register now!</a>
                </form>
                <!-- ./ form -->
            
            </div>
        </div>
    </div>
</div>

<!-- Plugin scripts -->
<script src="{{ url('public/vendors/bundle.js') }}"></script>
<script src="{{ url('public/vendors/toastr/toastr.js') }}"></script>
<!-- App scripts -->
<script src="{{ url('public/assets/js/app.min.js') }}"></script>
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
</script>
</body>
</html>
