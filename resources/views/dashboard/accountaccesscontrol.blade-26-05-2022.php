@extends('layouts.app')

@section('head')
   <!-- Prism -->
<link rel="stylesheet" href="{{ url('public/vendors/prism/prism.css') }}" type="text/css"> 	
<!-- Style -->
<link rel="stylesheet" href="{{ url('public/vendors/select2/css/select2.min.css') }}" type="text/css">
<style>
		body {
		  background: #dd5e89;
		  background: -webkit-linear-gradient(to left, #dd5e89, #f7bb97);
		  background: linear-gradient(to left, #dd5e89, #f7bb97);
		  min-height: 100vh;
		}
</style>
@endsection
@section('content')
    <!-- begin::page-header -->
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Access Control</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="{{asset('public/assets/media/image/icons/home.png')}}" alt="">
                        <a href="#">Manage</a>
                    </li>                    
                    <li class="breadcrumb-item active" aria-current="page">Access Control</li>
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
					<form name="frmACL"  id="frmAclValidatetion" method="post" action="{{route('addroles')}}">
						@csrf
					 <div class="form-row">
						 <div class="col-md-12 mb-12">						 
						  <label for="validationCustomUsername">Select Account Access Control</label><br/>
								@if($res)
									 @foreach($res as $index => $val)						 
										<input type="text" name="accountuuid" value="{{$val->uuid}}">{{$val->first_name}} {{$val->last_name}} 							 
									@endforeach
								@endif
							<!--<select name="accountuuid[]" class="select-parent-activity" multiple required>
								  <option value="">Select Account Access Control</option>
								  <optgroup label="Account Access Control">	
								@if($acRes)
									@foreach($acRes as $ackey => $acroles)																				
											@foreach($res as $index => $val)
											<option value="{{$val->uuid}}" @if ($val->uuid ==$acroles->account_uuid) selected="selected" @endif>{{$val->first_name}} {{$val->last_name}}</option>							 
											@endforeach										 
									@endforeach
								@else
									@if($res)
										 @foreach($res as $index => $val)						 
											<option value="{{$val->uuid}}">{{$val->first_name}} {{$val->last_name}}</option>							 
										@endforeach
									@endif
								@endif
							 </optgroup>								 
						</select>-->
						</div>
						</div>	
						<div class="col-12"></div><br/>						
							@if($acRes)
								@foreach($acRes as $ackey => $acroles)	
									@if($acroles->roles)									
										@foreach($acroles->roles as $r)
										<div class="form-check">
											<input type="hidden" name="role_uuid[]" value="{{$r->role_uuid}}" />
										  <input name="roleuuid[{{$r->role_uuid}}]" class="form-check-input" type="checkbox" value="1" @if($r->is_active) checked @endif>
										  <label class="form-check-label" for="flexCheckDefault">{{$r->role_name}}</label>
										</div>								 
										@endforeach
									@else
										@if($userRoles)
											 @foreach($userRoles as $key => $roles)							 
												<div class="form-check">
												  <input name="roleuuid[{{$roles->uuid}}]" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault">
												  <label class="form-check-label" for="flexCheckDefault">{{$roles->name}}</label>
												</div>								 
											@endforeach
										@endif
									@endif
								@endforeach
							@else
								@if($userRoles)
									 @foreach($userRoles as $key => $roles)							 
										<div class="form-check">
										  <input name="roleuuid[{{$roles->uuid}}]" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault">
										  <label class="form-check-label" for="flexCheckDefault">{{$roles->name}}</label>
										</div>								 
									@endforeach
								@endif
						@endif
						<!-- Button (Double) -->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="submit"></label>
						  <div class="col-md-8">
							<button type="submit" name="submit" class="btn btn-primary" value="">Save</button>
							<a href="#" id="cancel" name="cancel" class="btn btn-primary"><span style="color:white;">Cancel</span></a>
						  </div>
						</div>
					</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	 

@endsection

@section('script')
<!-- Prism -->	  
<script src="{{ url('public/vendors/prism/prism.js') }}"></script>
<script src="{{ url('public/vendors/select2/js/select2.min.js') }}"></script>  
<!-- DataTable -->
<script type="text/javascript">

$(function () {
	$('[data-toggle="tooltip"]').tooltip();
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
  
$('.select-parent-activity').select2({
	placeholder: 'Select', width:'100%'
});
</script>
@endsection
