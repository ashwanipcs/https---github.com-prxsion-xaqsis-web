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

    <!-- App styles -->
    <link rel="stylesheet" href="{{ url('public/assets/css/app.min.css') }}" type="text/css">
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
				@if(Session::has('error'))
				<div class="alert alert-danger">
					{{ Session::get('error') }}
					@php
						Session::forget('error');
					@endphp
				</div>
				@endif
                <!-- form -->
                 <form method="post" action="{{ route('login.save') }}">
				 @csrf
                    <div class="form-group">
					 @if ($errors->has('email'))
						<span class="text-danger">{{ $errors->first('email') }}</span>
					@endif
                        <input name="email" id="txtEmail" type="text" class="form-control" placeholder="Username or email">
                    </div>
                    <div class="form-group">
					 @if ($errors->has('password'))
						<span class="text-danger">{{ $errors->first('password') }}</span>
					@endif
                        <input name="password" id="txtPassword" type="password" class="form-control" placeholder="Password">
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
<!-- App scripts -->
<script src="{{ url('public/assets/js/app.min.js') }}"></script>
</body>
</html>
