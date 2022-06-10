@extends('layouts.app')

@section('content')

    <!-- begin::page-header -->
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Update Profile</h4>
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
                    <div class="card-body">
                        <div class="accordion custom-accordion">
                            <div class="accordion-row open">
                              <a href="#" class="accordion-header">
                                <span>Personal Detail</span>
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon close" src="{{asset('assets/media/image/icons/arrow-up.png')}}" alt="">
                                <img style="height: 12px; margin-top: -3px;" class="accordion-status-icon open fa fa-chevron-down" src="{{asset('assets/media/image/icons/down-arrow.png')}}" alt="">
                             
                              </a>
                              <div class="accordion-body">										 

										<form method="post" action="{{route('updateprofile')}}" class="needs-validation" novalidate>
											@csrf
											<div class="form-row">
											  <div class="form-group col-md-6">												
												<input type="hidden"  name="org_uuid" value="{{$result->data->org_uuid}}">											  
												<input type="hidden" name="account_uuid" value="{{$result->data->uuid}}">
											</div></div>
										  <div class="form-row">
											<div class="form-group col-md-4">
											  <label for="firstname">First Name</label>
											  <input type="text" name="first_name" value="{{$result->data->first_name}}" class="form-control" id="txtFirstName" placeholder="First Name" required>
											</div>
											<div class="form-group col-md-4">
											  <label for="lastname">Last Name</label>
											  <input type="text" name="last_name" value="{{$result->data->last_name}}" class="form-control" id="txtLastname" placeholder="Last Name" required>
											</div>
											<div class="form-group col-md-4">
											  <label for="middle_name">Middle Name</label>
											  <input type="text" name="middle_name" value="{{$result->data->middle_name}}" class="form-control" id="middle_name" placeholder="Manager" required>
											</div>
										  </div>
										   <div class="form-row">
											  <div class="form-group col-md-6">
												<label for="email">Email</label>
												<input type="email" value="{{$result->data->email}}" name="email" class="form-control" id="txtEmail" placeholder="Email" required>
											  </div>
											  <div class="form-group col-md-6">
											  <label for="otp">OTP</label>
											  <input type="text" name="otp" value="{{$result->data->otp}}" class="form-control" id="otp" placeholder="OTP" required>
											</div>
											  
											</div>
										 <div class="form-row">
											<div class="form-group col-md-3">
												<label for="country">Country</label>
												<input type="text" name="country" value="{{$result->data->country}}" class="form-control" id="txtCountry" placeholder="country" required>
											  </div>
											<div class="form-group col-md-3">
											  <label for="txtCity">City</label>
											  <input type="text" name="city" value="{{$result->data->city}}" class="form-control" id="txtCity" placeholder="city" required>
											</div>
											<div class="form-group col-md-3">
											  <label for="txtState">State</label>
											  <input type="text" name="state" value="{{$result->data->state}}" class="form-control" id="txtState" placeholder="State" required>
											</div>											
											<div class="form-group col-md-3"> 
											  <label for="postal_code">Postal Code</label>
											  <input type="text" name="postal_code" value="{{$result->data->postal_code}}"class="form-control" id="postal_code" placeholder="Postal Code" required>
											</div>
										  </div>
										  
										   <div class="form-row">
												<div class="form-group col-md-6">
												  <label for="address_line1">Address  Line1</label>
												  <input type="text" name="address_line1" value="{{$result->data->address_line1}}" class="form-control" id="address_line1" placeholder="Address  Line1" required>
												</div>
												<div class="form-group col-md-6">
												  <label for="address_line2">Address  Line2</label>
												  <input type="text" name="address_line2" value="{{$result->data->address_line2}}" class="form-control" id="address_line2" placeholder="Address  Line2" required>
												</div>
												
											</div>
											
											<div class="form-row">
												<div class="form-group col-md-4">
												  <label for="mobile_phone">Mobile Phone</label>
												  <input type="text" name="mobile_phone" value="{{$result->data->mobile_phone}}" class="form-control" id="mobile_phone" placeholder="Mobile Phone" required>
												</div>
												<div class="form-group col-md-4">
													  <label for="work_phone">Work Phone</label>
													  <input type="text" name="work_phone" value="{{$result->data->work_phone}}" class="form-control" id="work_phone" placeholder="Work Phone" required>
													</div>	
												<div class="form-group col-md-4">
												  <label for="home_phone">Home Phone</label>
												  <input type="text" name="home_phone" value="{{$result->data->home_phone}}" class="form-control" id="home_phone" placeholder="Home Phone" required>
												</div>
												
										  </div>
										    <div class="form-row">
											
											<div class="form-group col-md-4">
											  <label for="position_title">Position  Title</label>
											  <input type="text" name="position_title" value="{{$result->data->position_title}}" class="form-control" id="position_title" placeholder="Position  Title" required>
											</div>
										   
												<div class="form-group col-md-4">
											  <label for="manager">Manager</label>
											  <input type="text" name="manager" value="{{$result->data->manager}}" class="form-control" id="manager" placeholder="Manager" required>
											</div>								
											<div class="form-group col-md-4">
											  <label for="dob">DOB</label>
											  <input type="text" name="dob" value="{{$result->data->dob}}" class="form-control" id="dob" placeholder="DOB" required>
											</div>
										  </div>
										   <div class="form-row">
												<div class="form-group col-md-4">
											  <label for="manager">Employment Code</label>
											  <input type="text" name="employment_code" value="{{$result->data->employment_code}}" class="form-control" id="employment_code" placeholder="Employment Code" required>
											</div>								
											<div class="form-group col-md-4">
											  <label for="employment_type">Employment Type</label>
											  <input type="text" name="employment_type" value="{{$result->data->employment_type}}" class="form-control" id="employment_type" placeholder="Employment Type" required>
											</div>
											<div class="form-group col-md-4">
											  <label for="doj">Date Of Join</label>
											  <input type="text" name="doj" value="{{$result->data->doj}}" class="form-control" id="doj" placeholder="Date Of Join" required>
											</div>
										  </div>
										  
										   <div class="form-row">
												<div class="form-group col-md-4">
													<div class="form-check">
													  <input class="form-check-input" name="is_primary" value="1" type="checkbox" id="gridCheck" required {{ ($result->data->is_primary == 1 ? ' checked' : '') }}>
													  <label class="form-check-label" for="gridCheck">
														is Primary
													  </label>
													</div>
											  </div>
											  <div class="form-group col-md-4">
													<div class="form-check">
													  <input class="form-check-input" name="is_active" value="1" type="checkbox" id="gridCheck" required {{ ($result->data->is_active == 1 ? ' checked' : '') }}>
													  <label class="form-check-label" for="gridCheck">
														Is Active
													  </label>
													</div>
											  </div>
											  <div class="form-group col-md-4">
													<div class="form-check">
													  <input class="form-check-input" name="is_support" value="1" type="checkbox" id="gridCheck" required {{ ($result->data->is_support == 1 ? ' checked' : '') }}>
													  <label class="form-check-label" for="gridCheck">
														Is Support
													  </label>
													</div>
											  </div>
											</div>
										  <button type="submit" class="btn btn-primary">Sign in</button>
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
<script type="text/javascript">
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
@endsection