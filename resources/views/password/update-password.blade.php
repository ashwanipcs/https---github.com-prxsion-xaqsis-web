<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bordash - Admin Dashboard Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('assets/media/image/favicon.png') }}"/>

    <!-- Plugin styles -->
    <link rel="stylesheet" href="{{ url('vendors/bundle.css') }}" type="text/css">

    <!-- App styles -->
    <link rel="stylesheet" href="{{ url('assets/css/app.min.css') }}" type="text/css">
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
            <img class="logo" src="{{ url('assets/media/image/logo.png') }}" alt="image">
        </div>
 
    <div class="col-md-12">
        <div class="form-wrapper" style="width: 617px;">
        
            <h5>Reset password</h5>
        
            <!-- form -->
            <form>
                <div class="form-group">
                   
                    <div class="row">
                        <div class="col-md-5 col-xs-3 col-sm-3 mt-10" style="margin-top:10px;">
                            <h5 style="text-align: start;">New Password  :</h5> 
                        </div>
                        <div class="col-md-7 col-xs-9 col-sm-9">
                             <input type="password" class="form-control" placeholder="New Password" required autofocus>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-xs-3 col-sm-3 mt-10" style="margin-top:6px;">
                            <h5 style="text-align: start;">Retype Password :</h5> 
                        </div>
                        <div class="col-md-7 col-xs-9 col-sm-9">
                             <input type="password" class="form-control" placeholder="Retype Password" required autofocus>
                        </div>
                    </div>
                   
                </div>

                {{-- <hr style="background-color: #1E3E87 !important; margin:11px;"> --}}
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-primary btn-block">Submit</button>
                    </div>
                    <div class="col-md-6" >
                        <button class="btn btn-primary btn-block">Cancel</button>
                    </div>
                </div>
               
             
                {{-- <p class="text-muted">Take a different action.</p>
                <a href="{{ route('pages.register') }}" class="btn btn-sm btn-outline-light mr-1">Register now!</a>
                or
                <a href="{{ route('pages.login') }}" class="btn btn-sm btn-outline-light ml-1">Login!</a> --}}
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
