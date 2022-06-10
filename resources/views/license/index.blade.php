@extends('layouts.app')
@section('head')
 <!-- Prism -->
    <link rel="stylesheet" href="{{ url('public/vendors/prism/prism.css') }}" type="text/css">
<style>
body {
  background: #dd5e89;
  background: -webkit-linear-gradient(to left, #dd5e89, #f7bb97);
  background: linear-gradient(to left, #dd5e89, #f7bb97);
  min-height: 100vh;
}
/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}

</style>
@endsection

@section('content')
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>License</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="{{asset('assets/media/image/icons/home.png')}}" alt="">
                        <a href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('license')}}">License</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">License</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
					 <div class="row">
                    <div class="col-md-12 text-right mb-3" >                        
                    </div>
                </div>
                <div class="card">
				  <div class="form-group row">										
							<div class="col-sm-12">
								  <div class="tab">
								  <button type="button" class="tablinks" onclick="openCity(event, 'License')">License Deatils</button>
								  <button type="button" class="tablinks" onclick="openCity(event, 'Upload')">License Upload</button>
								  <button type="button" class="tablinks" onclick="openCity(event, 'Purchase')">Purchase History</button>
								</div>
							</div>
						</div>
						<div class="form-group row">										
							<div class="col-sm-12">
								<div id="License" class="tabcontent" style="display:block;">									 											 												  
									 <div class="row">
											<div class="col-6"> <h3>Credits</h3></div>
											<div class="col-6 text-right"> 
												 <a href="{{route('license.create')}}"> 
												  <button type="button" class="btn btn-primary">Buy Online</button>
												 </a>
											</div>
											<div class="col-12"><p>Credits Under Administration are listing below:</p></div> 
											 <div class="col-12"> Trail Credits: <span> @if($summary){{ $summary->trial_credits}} @else N/A @endif</span></div> 
											 <div class="col-12"> Premium Credits: <span> @if($summary) {{ $summary->premium_credits}} @else N/A @endif</span></div>
											 <div class="col-12"> Credits Used : <span> @if($summary) {{ $summary->credit_used}} @else N/A @endif</span></div>
											 <div class="col-12">Credits Balance : <span> @if($summary) {{ $summary->credit_balance}} @else N/A @endif</span></div>
											 
									  </div>									  
									</div>
									<div id="Upload" class="tabcontent">
										<form method="post" enctype="multipart/form-data" action="{{route('license.uploads')}}" class="form-inline needs-validation" novalidate>
										@csrf
										<div class="row">										  
											<div class="col-12"><p>Uploas XAQSIS License File:</p></div> 
											 <div class="col-12  text-center"> 
												  <div class="form-group  text-center">
													<!--<label for="filename text-center">Upload license file:</label>
													<input  class="form-control text-center" id="filename" required>-->
													<label for="formFileSmformFileSm" class="form-label">Upload license file</label><br><br>
													<br><input  name="licenseFile" class="form-control form-control-lg" id="formFileSm" type="file" required />
												  </div> 												
											</div><br><br>
											<div class="col-12 text-center"> 
												  <button type="submit" class="btn btn-primary">Upload</button>
											</div>
										</div>
										</form>
									 </div>
									<div id="Purchase" class="tabcontent">																  
										<div class="row">												 
											<div class="col-12">
												<table id="myTable" class="table table-striped table-bordered">
													  <thead>
														<tr>
														  <th>S.No.</th>
														  <th>Org Name</th>
														  <th>License Type</th>
														  <th>License Credits</th>
														  <th>License Description</th>														 	
														  <th>Is Active</th>
														   <th>Invoice</th>
														</tr>
													  </thead>
													  <tbody>
													  @if($licensehistory)
														 @foreach($licensehistory as $key=>$items)
														<tr>
														  <td>{{$key+1}}</td>
														  <td>{{$items->org_name}}</td>
														  <td>{{$items->license_type}}</td>
														  <td>{{$items->license_credits}}</td> 
														  <td>{{$items->license_status_description}}</td>														  
														  <td>@if($items->is_active==1) Activited @else Activited Now @endif</td>
														   <td><a href="{{route('license.invoice',$items->uuid)}}">View Details</a></td>
														</tr> 
														@endforeach
														@endif
													  </tbody>
													</table>
											</div> 
											 
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

<script>
$(document).ready(function (){
    $('#myTable').DataTable();
});

 function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

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
  
$(document).ready(function(){
	 $("body").on("click", ".confirmDelete", function(event){
		 var url = $(this).data("id");	
		 //alert(url);
		  toastr.success("<button type='button' class='confirmationRevertYes btn clear'>Yes</button><button type='button' class='confirmationRevertNo btn clear'>No</button>",'Are you sure you want to delete this item?',
		{
			  closeButton: true,
			  allowHtml: true,
			  onShown: function (toast) {
				  $(".confirmationRevertYes").click(function(){
					location.replace(url); 
				  });
				}
		});
	 }); 
  });
 
</script>

<script src="{{ url('public/vendors/prism/prism.js') }}"></script>
@endsection
