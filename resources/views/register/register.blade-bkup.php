<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>XAQSIS - Register</title>
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
{{-- @foreach ($response as $key => $val)
		{{ $key }} - {{ $val['title'] }}
	 @endforeach 
@foreach ($register as $key => $val)
	{{ $key }} - {{ $val['title'] }}
@endforeach --}}

<!-- end::preloader -->
<div class="row">
    <div class="col-md-6">
        <img class="logo" width="100%" style="margin: 15px auto;" src="{{ url('public/assets/media/image/user/auth_image.jpg') }}" alt="image">
    </div>
    <div class="col-md-6">
        <div class="form-wrapper" style="margin: 14px auto;">
            <!-- logo -->
            <div id="logo" style="margin: -1rem 0 1rem;">
                <img class="logo" src="{{ url('public/assets/media/image/logo.png') }}" alt="image">
                <img class="logo-dark" src="{{ url('public/assets/media/image/logo-dark.png') }}" alt="image">
            </div>
            <!-- ./ logo -->
            <h5>Create account</h5>
            <!-- form -->
            <form method="post" action="{{route('register.save')}}">
			@csrf
                <div class="form-group">
				 @if ($errors->has('firstname'))
						<span class="text-danger">{{ $errors->first('firstname') }}</span>
					@endif
                    <input name="firstname" id="txtFirstname" type="text" class="form-control" placeholder="Firstname">
                </div>
                <div class="form-group">
				@if ($errors->has('lastname'))
						<span class="text-danger">{{ $errors->first('lastname') }}</span>
					@endif
                    <input name="lastname" id="txtLastname" type="text" class="form-control" placeholder="Lastname">
                </div>
                <div class="form-group">
					@if ($errors->has('email'))
						<span class="text-danger">{{ $errors->first('email') }}</span>
					@endif
                    <input name="email" id="txtEmail" type="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
				@if ($errors->has('password'))
						<span class="text-danger">{{ $errors->first('password') }}</span>
					@endif
                    <input name="password" id="txtPassword" type="password" class="form-control" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
                <hr>
                <p class="text-muted">Already have an account?</p>
                <a href="{{route('login')}}" class="btn btn-outline-light btn-sm">Sign in!</a>
            </form>
            <!-- ./ form -->

        </div>
    </div>
</div>

<!-- Plugin scripts -->
<script src="{{ url('public/vendors/bundle.js') }}"></script>

<!-- App scripts -->
<script src="{{ url('public/assets/js/app.min.js') }}"></script>
</body>
</html>
