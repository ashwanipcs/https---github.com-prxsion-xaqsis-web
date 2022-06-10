@extends('layouts.app')
@section('head')
   <!-- Prism -->
    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css"> 
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
<link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet"/>
	<style>
	.toggle-password-eye {
		float: right;
		top: -25px;
		right: 30px;
		position: relative;
		cursor: pointer;
	}
	</style>
@endsection
@section('content')

    <!-- begin::page-header -->
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Update Account Password</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="{{url('public/assets/media/image/icons/home.png')}}" alt="">
                        <a href="#">Settings</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Update Account Password</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- end::page-header -->

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="accordion custom-accordion">
                            <div class="accordion-row open"> 
                              <div class="accordion-body">	
									<form name="frmProjects" method="post" action="{{ route('updateaccountpassword') }}" class="needs-validation" novalidate>
									<!-- CROSS Site Request Forgery Protection -->
									@csrf	
									  <div class="form-row">
										<div class="form-group col-md-6">
										  <label for="firstname"><strong>Old Password</strong></label>
										  <input type="password" name="old_password_hash" value="" class="form-control" id="txtOldPassword" placeholder="Old Password" required>
										</div>
										<div class="form-group col-md-6">
										  <label for="lastname"><strong>New Password</strong></label>
										  <input type="password" name="new_password_hash" value="" class="form-control" id="txtNewPassword" placeholder="New Password" required>
										</div> 
										<div class="form-group col-md-12 text-center">
											<button type="submit" class="btn btn-primary btn-rounded">Save</button>
										</div>
									</form>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- DataTable -->
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
    <!-- Prism -->
	  
    <script src="{{ url('vendors/prism/prism.js') }}"></script>
@endsection
