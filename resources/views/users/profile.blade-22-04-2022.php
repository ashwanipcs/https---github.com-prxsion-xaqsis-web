@extends('layouts.app')
@section('head')
<!-- Prism -->
<link rel="stylesheet" href="{{ url('public/vendors/prism/prism.css') }}" type="text/css"> 
@endsection
@section('content')

    <!-- begin::page-header -->
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Profile</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="{{url('public/assets/media/image/icons/home.png')}}" alt="">
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
                           @if(file_exists(public_path().'/storage/users/'.Session::get('account_uuid').'/'.Session::get('account_uuid').'.jpg' ))
								<img src="{{url('public/storage/users/'.Session::get('account_uuid').'/'.Session::get('account_uuid').'.jpg' )}}" class="rounded-circle" alt="...">
									 
							@else
								<img src="{{ url('public/assets/media/image/user/women_avatar1.jpg') }}" class="rounded-circle" alt="...">
							@endif
						</figure>
                        <h5 class="mb-1">Roxana Roussell </h5>
                        <p class="text-muted small">Web Developer</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus repudiandae eveniet
                            harum.</p>
                        <!--<a href="{{route('editprofile')}}" class="btn btn-outline-primary">
                            <i data-feather="edit-2" class="mr-2"></i> </a> -->
							<button type="button" id="formButton" class="btn btn-outline-primary">Edit Profile</button>
						<a href="javascript:void(0);" class="btn btn-outline-primary profileImg">						 
						 <i data-feather="edit-2" class="mr-2"></i>Upload</a>
						<a href="{{route('changeaccountpassword')}}" class="btn btn-outline-primary">
                            <i data-feather="edit-2" class="mr-2"></i> Update Password</a>
                    </div>
                </div>
				<div class="personalData">
				<div class="card">
                    <div class="card-body">
                        <div class="accordion custom-accordion">
                            <div class="accordion-row open">
                              <a href="#" class="accordion-header">
                                <span>Personal Detail</span>
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon close" src="{{asset('assets/media/image/icons/arrow-up.png')}}" alt="">
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon open fa fa-chevron-down" src="{{asset('assets/media/image/icons/down-arrow.png')}}" alt="">
                             
                              </a>
                              <div class="accordion-body">
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">First Name:</div>
                                            <div class="col-6">{{ $result->data->first_name }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Last Name:</div>
                                            <div class="col-6">{{ $result->data->last_name }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Middle Name:</div>
                                            <div class="col-6">@if($result->data->middle_name){{ $result->data->middle_name }} @else N/A @endif</div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Email:</div>
                                            <div class="col-6">@if($result->data->email){{ $result->data->email }} @else N/A @endif</div>
                                        <!--</div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">OTP:</div>
                                            <div class="col-6">@if($result->data->otp){{ $result->data->otp }} @else N/A @endif</div>
                                        </div>-->
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Position:</div>
                                            <div class="col-6">@if($result->data->position_title){{ $result->data->position_title }} @else N/A @endif </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Country:</div>
                                            <div class="col-6">@if($result->data->country){{ $result->data->country }} @else N/A @endif</div>
                                        </div> 
										<div class="row mb-2">
                                            <div class="col-6 text-muted">State:</div>
                                            <div class="col-6">@if($result->data->state){{ $result->data->state }} @else N/A @endif</div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">City:</div>
                                            <div class="col-6">@if($result->data->city){{ $result->data->city }} @else N/A @endif</div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Postal Code:</div>
                                            <div class="col-6">@if($result->data->postal_code){{ $result->data->postal_code }} @else N/A @endif</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Address Line1:</div>
                                            <div class="col-6">@if($result->data->address_line1){{ $result->data->address_line1 }} @else N/A @endif</div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Address Line2:</div>
                                            <div class="col-6">@if($result->data->address_line2){{ $result->data->address_line2 }} @else N/A @endif</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Mobile Phone:</div>
                                            <div class="col-6">@if($result->data->mobile_phone){{ $result->data->mobile_phone }} @else N/A @endif</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Work Phone:</div>
                                            <div class="col-6">@if($result->data->work_phone){{ $result->data->work_phone }} @else N/A @endif</div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Home Phone:</div>
                                            <div class="col-6">@if($result->data->home_phone){{ $result->data->home_phone }} @else N/A @endif</div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Date Of Brith:</div>
                                            <div class="col-6">@if($result->data->dob){{ $result->data->dob }} @else N/A @endif</div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Date Of Joining:</div>
                                            <div class="col-6">@if($result->data->doj){{ $result->data->doj }} @else N/A @endif</div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Employment Type:</div>
                                            <div class="col-6">@if($result->data->employment_type){{ $result->data->employment_type }} @else N/A @endif</div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Employment Code:</div>
                                            <div class="col-6">@if($result->data->employment_code){{ $result->data->employment_code }} @else N/A @endif</div>
                                        </div>
                                   
                                
                              </div>
                            </div>
                            <div class="accordion-row">
                              <a href="#" class="accordion-header">
                                <span>Organization Detail</span>
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon close" src="{{asset('assets/media/image/icons/arrow-up.png')}}" alt="">
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon open fa fa-chevron-down" src="{{asset('assets/media/image/icons/down-arrow.png')}}" alt="">
                             
                              </a>
                              <div class="accordion-body">
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Manager:</div>
                                    <div class="col-6">@if($result->data->manager) {{$result->data->manager}} @else N/A @endif</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Billing Manager:</div>
                                    <div class="col-6">@if($result->data->is_billing_manager) {{$result->data->is_billing_manager}} @else False @endif</div>
                                </div>
                               
                              </div>
                            </div>
                            <div class="accordion-row">
                              <a href="#" class="accordion-header">
                                <span>Role Detail</span>
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon close" src="{{asset('assets/media/image/icons/arrow-up.png')}}" alt="">
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon open fa fa-chevron-down" src="{{asset('assets/media/image/icons/down-arrow.png')}}" alt="">
                             
                              </a>
                              <div class="accordion-body">
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Administrator:</div>
                                    <div class="col-6">@if($result->data->is_administrator) {{$result->data->is_administrator}} @else N/A @endif</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Primary:</div>
                                    <div class="col-6">@if($result->data->is_primary) {{$result->data->is_primary}} @else N/A @endif</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Active:</div>
                                    <div class="col-6">@if($result->data->is_active) {{$result->data->is_active}} @else N/A @endif</div>
                                </div>
                                
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
			</div>

				<form id="form1" name="frmPersonal" method="post" action="{{route('updateprofile')}}" class="needs-validation" novalidate>
					 @csrf
                <div class="card">
				
                    <div class="card-body">
                        <div class="accordion custom-accordion">
                            <div class="accordion-row open">
                              <a href="#" class="accordion-header">
                                <span>Personal Detail</span>
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon close" src="{{asset('assets/media/image/icons/arrow-up.png')}}" alt="">
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon open fa fa-chevron-down" src="{{asset('assets/media/image/icons/down-arrow.png')}}" alt="">
                             
                              </a>
							 
								<div class="form-row">
								  <div class="form-group col-md-6">												
									<input type="hidden"  name="org_uuid" value="{{$result->data->org_uuid}}">							  
									<input type="hidden" name="account_uuid" value="{{$result->data->uuid}}">
								</div></div>
                              <div class="accordion-body">
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">First Name:</div>
                                            <div class="col-6">
											 <input type="text" name="first_name" value="{{$result->data->first_name}}" class="form-control" id="txtFirstName" placeholder="First Name" required>
											</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Last Name:</div>
                                            <div class="col-6">
											<input type="text" name="last_name" value="{{$result->data->last_name}}" class="form-control" id="txtLastname" placeholder="Last Name" required>
											</div>
                                        </div> 
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Middle Name:</div>
                                            <div class="col-6"><input type="text" name="middle_name" value="{{$result->data->middle_name}}" class="form-control" id="middle_name" placeholder="Manager"></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Email:</div>
                                            <div class="col-6"><input type="email" value="{{$result->data->email}}" name="email" class="form-control" id="txtEmail" placeholder="Email" required></div>
                                        </div>	
										<div class="row mb-2">
                                            <div class="col-6 text-muted">OTP:</div>
                                            <div class="col-6"><input type="text" name="otp" value="{{$result->data->otp}}"class="form-control" id="otp" placeholder="OTP"></div>
                                        </div>										 
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Position:</div>
                                            <div class="col-6"><input type="text" name="position_title" value="{{$result->data->position_title}}" class="form-control" id="position_title" placeholder="Position  Title"></div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Country:</div>
                                            <div class="col-6"><input type="text" name="country" value="{{$result->data->country}}" class="form-control" id="txtCountry" placeholder="country"></div>
                                        </div> 
										<div class="row mb-2">
                                            <div class="col-6 text-muted">State:</div>
                                            <div class="col-6"><input type="text" name="state" value="{{$result->data->state}}" class="form-control" id="txtState" placeholder="State"></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">City:</div>
                                            <div class="col-6"><input type="text" name="city" value="{{$result->data->city}}" class="form-control" id="txtCity" placeholder="city"></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Postal Code:</div>
                                            <div class="col-6"><input type="text" name="postal_code" value="{{$result->data->postal_code}}" class="form-control" id="postal_code" placeholder="Postal Code"></div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Address Line1:</div>
                                            <div class="col-6"><input type="text" name="address_line1" value="{{$result->data->address_line1}}" class="form-control" id="address_line1" placeholder="Address  Line1"></div>
                                        </div>  
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Address Line2:</div>
                                            <div class="col-6"><input type="text" name="address_line2" value="{{$result->data->address_line2}}" class="form-control" id="address_line2" placeholder="Address  Line2"></div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Mobile Phone:</div>
                                            <div class="col-6"><input type="text" name="mobile_phone"  value="{{$result->data->mobile_phone}}" class="form-control" id="mobile_phone" placeholder="Mobile Phone"></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Work Phone:</div>
                                            <div class="col-6"><input type="text" name="work_phone" value="{{$result->data->work_phone}}" class="form-control" id="work_phone" placeholder="Work Phone"></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Home Phone:</div>
                                            <div class="col-6"> <input type="text" name="home_phone" value="{{$result->data->home_phone}}" class="form-control" id="home_phone" placeholder="Home Phone"></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">DOB:</div>
                                            <div class="col-6"><input type="text" name="dob" value="{{$result->data->dob}}" class="form-control" id="dob" placeholder="DOB"></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">DOJ:</div>
                                            <div class="col-6"><input type="text" name="doj" value="{{$result->data->doj}}" class="form-control" id="doj" placeholder="DOJ"></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Employment Type:</div>
                                            <div class="col-6"><input type="text" name="employment_type" value="{{$result->data->employment_type}}" class="form-control" id="employment_type" placeholder="Employment Code"></div>
                                        </div>
										<div class="row mb-2">
                                            <div class="col-6 text-muted">Employment Code:</div>
                                            <div class="col-6"><input type="text" name="employment_code" value="{{$result->data->employment_code}}" class="form-control" id="employment_code" placeholder="Employment Code"></div>
                                        </div>                                        
                              </div>
							 
                            </div>
                            <div class="accordion-row">
                              <a href="#" class="accordion-header">
                                <span>Organization Detail</span>
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon close" src="{{asset('assets/media/image/icons/arrow-up.png')}}" alt="">
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon open fa fa-chevron-down" src="{{asset('assets/media/image/icons/down-arrow.png')}}" alt="">
                             
                              </a>
                              <div class="accordion-body">
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Manager:</div>
                                    <div class="col-6"><input type="text" name="manager" value="{{$result->data->manager}}" class="form-control" id="manager" placeholder="Manager"></div>
                                </div>
                                 <div class="row mb-2">
                                    <div class="col-6 text-muted">Billing Manager:</div>
                                    <div class="col-6">
									<input class="form-check-input" name="is_billing_manager" type="checkbox" id="gridCheck">
									</div>
                                </div>
                                
                              </div>
                            </div>
                            <div class="accordion-row">
                              <a href="#" class="accordion-header">
                                <span>Role Detail</span>
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon close" src="{{asset('assets/media/image/icons/arrow-up.png')}}" alt="">
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon open fa fa-chevron-down" src="{{asset('assets/media/image/icons/down-arrow.png')}}" alt="">
                             
                              </a>
                              <div class="accordion-body">
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Administrator:</div>
                                    <div class="col-6">
									<input class="form-check-input" name="is_administrator" type="checkbox" id="gridCheck">
									</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Primary:</div>
                                    <div class="col-6"> <input class="form-check-input" name="is_primary" type="checkbox" id="gridCheck"></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Active:</div>
                                    <div class="col-6"><input class="form-check-input" name="is_active" type="checkbox" id="gridCheck"></div>
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
            </div>
        </div>
    </div>
	
	<!-- .modal -->
	<div class="modal fade showModel">
		<div class="modal-dialog">
			<form name="profileFrm" method="post" action="{{route('uploads')}}" enctype="multipart/form-data">
			<!-- CROSS Site Request Forgery Protection -->
			{{ csrf_field() }}
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
@endsection
@section('script')
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
<script src="{{ url('public/vendors/prism/prism.js') }}"></script>
@endsection