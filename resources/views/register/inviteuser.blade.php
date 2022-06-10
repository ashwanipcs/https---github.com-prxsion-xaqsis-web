<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>XAQSIS - Register</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('assets/media/image/favicon.png') }}"/>
    <!-- Plugin styles -->
    <link rel="stylesheet" href="{{ url('vendors/bundle.css') }}" type="text/css">
    <!-- App styles -->
    <link rel="stylesheet" href="{{ url('assets/css/app.min.css') }}" type="text/css">
</head>
<body class="form-membership" style="padding: 0px;">
<!-- begin::preloader-->
<div class="preloader">
    <div class="preloader-icon"></div>
</div>
<!-- end::preloader -->
<div class="row">
    <div class="col-md-6">
        <img class="logo" width="100%" style="margin: 15px auto;" src="{{ url('assets/media/image/user/auth_image.jpg') }}" alt="image">
    </div>
    <div class="col-md-6">
        <div class="form-wrapper" style="margin: 14px auto;">
            <!-- logo -->
            <div id="logo" style="margin: -1rem 0 1rem;">
                <img class="logo" src="{{ url('assets/media/image/logo.png') }}" alt="image">
                <img class="logo-dark" src="{{ url('assets/media/image/logo-dark.png') }}" alt="image">
            </div>
            <!-- ./ logo -->
            <h5>Create account</h5>
				@if(Session::has('error'))
				<div class="alert alert-danger">
					{{ Session::get('error') }}
					@php
						Session::forget('error');
					@endphp
				</div>
				@endif
            <!-- form -->
            <form method="post" action="{{route('createaccountinvite')}}" class="needs-validation" novalidate>
			@csrf 
				<input name="org_uuid" type="hidden" class="form-control" value="{{$org_uuid}}" />
                <div class="form-group">
				 @if ($errors->has('firstname'))
						<span class="text-danger">{{ $errors->first('firstname') }}</span>
					@endif
                    <input name="firstname" id="validationCustom01" type="text" value="{{$name}}" class="form-control" placeholder="Firstname" required />
                </div>
                <div class="form-group">
				@if ($errors->has('lastname'))
						<span class="text-danger">{{ $errors->first('lastname') }}</span>
					@endif
                    <input name="lastname" id="validationCustom02" type="text" value="{{$name}}" class="form-control" placeholder="Lastname" required />
                </div>
                <div class="form-group">
					@if ($errors->has('email'))
						<span class="text-danger">{{ $errors->first('email') }}</span>
					@endif
                    <input name="email" id="validationCustom03" type="email" value="{{$email}}" class="form-control" placeholder="Email" required />
                </div>
                <div class="form-group">
				@if ($errors->has('password'))
						<span class="text-danger">{{ $errors->first('password') }}</span>
					@endif
                    <input name="password" id="validationCustom04" type="password" class="form-control" placeholder="Password"  required />
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
                <hr>
                 
            </form>
            <!-- ./ form -->

        </div>
    </div>
</div>

<!-- Plugin scripts -->
<script src="{{ url('vendors/bundle.js') }}"></script>

<!-- App scripts -->
<script src="{{ url('assets/js/app.min.js') }}"></script>
</body>
</html>
