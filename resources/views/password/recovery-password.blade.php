<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Xaqsis - Admin Dashboard Template</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('public/assets/media/image/favicon.png') }}"/>
    <!-- Plugin styles -->
    <link rel="stylesheet" href="{{ url('public/vendors/bundle.css') }}" type="text/css">
    <!-- App styles -->
    <link rel="stylesheet" href="{{ url('public/assets/css/app.min.css') }}" type="text/css">
</head>
<body class="form-membership">
<!-- begin::preloader-->
<div class="preloader">
    <div class="preloader-icon"></div>
</div>
<!-- end::preloader -->
<div class="row" style="padding:30px;">
    <div class="col-md-12 text-center">
        <div id="logo">
            <img class="logo" src="{{ url('public/assets/media/image/logo.png') }}" alt="image">
        </div>
    </div>
	
    <div class="col-md-12 resetpassword">
        <div class="form-wrapper" style="width: 617px;">
            <h5>Reset password</h5>				 
         <!-- form -->
			<form method="post" id="frmEmailOTP" action="{{route('login.resetpassword')}}" class="needs-validation" novalidate>
			 @csrf          
                <div class="form-group">
					 @if ($errors->has('email'))
						<span class="text-danger">{{ $errors->first('email') }}</span>
					@endif
                    <input name="email" id="validationCustom01" type="email" class="form-control" placeholder="E-mail Address" required />
                </div>
                {{-- <hr style="background-color: #1E3E87 !important; margin:11px;"> --}}
				 					
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary submitEmailBttn">Submit</button>                    
                        <button type="button" class="btn btn-primary">Cancel</button>
                    </div>
                </div>
				 
			</form>
			<!-- ./ form -->
        </div>
    </div>
	
    <div class="col-md-12 updatepassword" style="display:none;">
        <div class="form-wrapper" style="width: 617px;">        
            <h5>Reset password</h5>
					
            <!-- form -->
             <form method="post" id="frmUpdatePassword" action="{{route('login.updatepassword')}}" class="needs-validation" novalidate>
				 @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-5 col-xs-3 col-sm-3 mt-10" style="margin-top:10px;">
                            <h5 style="text-align: start;">Email :</h5> 
                        </div>
                        <div class="col-md-7 col-xs-9 col-sm-9">
						 @if ($errors->has('username'))
							<span class="text-danger">{{ $errors->first('username') }}</span>
						@endif
                             <input name="username" type="text" class="form-control" id="validationCustom01" placeholder="Username or email" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-xs-3 col-sm-3 mt-10" style="margin-top:10px;">
                            <h5 style="text-align: start;">OTP :</h5> 
                        </div>
                        <div class="col-md-7 col-xs-9 col-sm-9">
						 @if ($errors->has('otp'))
						<span class="text-danger">{{ $errors->first('otp') }}</span>
					@endif
                             <input name="otp" type="number" class="form-control" id="validationCustom02" placeholder="OTP" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-xs-3 col-sm-3 mt-10" style="margin-top:10px;">
                            <h5 style="text-align: start;">New Password  :</h5> 
                        </div>
                        <div class="col-md-7 col-xs-9 col-sm-9">
						 @if ($errors->has('password'))
							<span class="text-danger">{{ $errors->first('password') }}</span>
						@endif
                             <input name="password" type="password" class="form-control" id="validationCustom03" placeholder="New Password" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-xs-3 col-sm-3 mt-10" style="margin-top:6px;">
                            <h5 style="text-align: start;">Retype Password :</h5> 
                        </div>
                        <div class="col-md-7 col-xs-9 col-sm-9">
						 @if ($errors->has('confirm_password'))
							<span class="text-danger">{{ $errors->first('confirm_password') }}</span>
						@endif
                             <input name="confirm_password" type="password" class="form-control" id="validationCustom04" placeholder="Retype Password" required />
                        </div>
                    </div>                   
                </div>                
				 <div class="row">
					<div class="col-md-12 text-center">
						<button type="submit" class="btn btn-primary submitUpdateBttn">Submit</button>
						<button class="btn btn-primary">Cancel</button>
					</div>
				</div>
				              
            </form>
            <!-- ./ form -->
        
        </div>
    </div>
</div>
<!-- Plugin scripts -->
<script src="{{ url('public/vendors/bundle.js') }}"></script>
<!-- App scripts -->
<script src="{{ url('public/assets/js/app.min.js') }}"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function(e) {	 
	 e.preventDefault();
    $(".submitEmailBttn").click(function(){			
		//$('.frmEmailOTP').attr('action', "{{route('login.resetpassword')}}");
		$('.frmEmailOTP').submit();
		
	});
});

$(document).ready(function(e) {
	 e.preventDefault();
    $(".submitUpdateBttn").click(function(){		 
		//$('.frmUpdatePassword').attr('action', "{{route('login.updatepassword')}}");
		$('.frmUpdatePassword').submit();
		$(".updatepassword").show();
	});
});

@if(Session::has('success1'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
	"positionClass": 'toast-top-center'
  }
  		toastr.success("{{Session::get('success1')}}");
		$(".resetpassword").hide();
		$(".updatepassword").show();
  @endif

  @if(Session::has('error1'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
	"positionClass": 'toast-top-center'
  }
  		toastr.error("{{Session::get('error1')}}");
		$(".resetpassword").show();
		$(".updatepassword").hide();
  @endif 

@if(Session::has('success'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
	"positionClass": 'toast-top-center'
  }
  		toastr.success("{{Session::get('success')}}");
		$(".resetpassword").show();
		$(".updatepassword").hide();
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
	"positionClass": 'toast-top-center'
  }
  		toastr.error("{{Session::get('error')}}");
		$(".resetpassword").hide();
		$(".updatepassword").show();
  @endif    

 </script>

</body>
</html>
