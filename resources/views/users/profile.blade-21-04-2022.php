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
                        <a href="{{route('editprofile')}}" class="btn btn-outline-primary">
                            <i data-feather="edit-2" class="mr-2"></i> Edit Profile</a>
						<a href="javascript:void(0);" class="btn btn-outline-primary profileImg">						 
						 <i data-feather="edit-2" class="mr-2"></i>Upload</a>
						<a href="{{route('changeaccountpassword')}}" class="btn btn-outline-primary">
                            <i data-feather="edit-2" class="mr-2"></i> Update Password</a>
                    </div>
                </div>



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
                                            <div class="col-6 text-muted">Age:</div>
                                            <div class="col-6">@if($result->data->dob){{ $result->data->dob }} @else N/A @endif</div>
                                        </div>
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
                                            <div class="col-6 text-muted">Address:</div>
                                            <div class="col-6">@if($result->data->address_line1){{ $result->data->address_line1 }} @else N/A @endif</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Phone:</div>
                                            <div class="col-6">@if($result->data->mobile_phone){{ $result->data->mobile_phone }} @else N/A @endif</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6 text-muted">Email:</div>
                                            <div class="col-6">{{ $result->data->email }}</div>
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
                                    <div class="col-6 text-muted">First Name:</div>
                                    <div class="col-6">Johnatan</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Last Name:</div>
                                    <div class="col-6">Due</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Age:</div>
                                    <div class="col-6">26</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Position:</div>
                                    <div class="col-6">Web Designer</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">City:</div>
                                    <div class="col-6">New York, USA</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Address:</div>
                                    <div class="col-6">228 Park Ave Str.</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Phone:</div>
                                    <div class="col-6">+1-202-555-0134</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Email:</div>
                                    <div class="col-6">johndue@gmail.com</div>
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
                                    <div class="col-6 text-muted">First Name:</div>
                                    <div class="col-6">Johnatan</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Last Name:</div>
                                    <div class="col-6">Due</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Age:</div>
                                    <div class="col-6">26</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Position:</div>
                                    <div class="col-6">Web Designer</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">City:</div>
                                    <div class="col-6">New York, USA</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Address:</div>
                                    <div class="col-6">228 Park Ave Str.</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Phone:</div>
                                    <div class="col-6">+1-202-555-0134</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-muted">Email:</div>
                                    <div class="col-6">johndue@gmail.com</div>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<!-- .modal -->
	<div class="modal fade showModel">
		<div class="modal-dialog">
			<form name="profileFrm" method="post" action="{{route('uploads')}}" enctype="multipart/form-data" class="needs-validation" novalidate>
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