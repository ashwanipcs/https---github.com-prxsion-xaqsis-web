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
* {
  box-sizing: border-box;
}
#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #04AA6D;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}
</style>
@endsection

@section('content')
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Create License</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="{{asset('assets/media/image/icons/home.png')}}" alt="">
                        <a href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('license')}}">License</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Create License</li>
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
						<div class="row">										
							<div class="col-sm-12">	
							 <form id="regForm" action="">								 
								  <!-- One "tab" for each step in the form: -->
								  <div class="tab"> 
									<div class="form-group row">
										<div class="col-sm-4"><strong>License Type</strong>:</div>
										<div class="col-sm-8">
											<select name="license_type" class="form-control licensetype" required>
												<option value="">-- select License Type--</option>
												<option value="TRIAL" selected>TRIAL</option>
												<option value="BASIC">BASIC</option>									
											</select>
										</div>
									</div>
									<div class="form-group row licensecredits">
										<div class="col-sm-4"><strong>Credits Points</strong>:</div>
										<div class="col-sm-8">
											<input type="text" name="license_credits" value="5" class="form-control txtlicensecredits" style="width: 100%" required>								
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-4"><strong>License Status</strong>:</div>
										<div class="col-sm-8">
											<input  type="checkbox" name="license_status" class="form-check-input" value="false" id="license_status">
																			
										</div>
									</div> 
									<div class="form-group row">
										<div class="col-sm-4"><strong>Description</strong>:</div>
										<div class="col-sm-8">
											<input type="text" name="description" class="form-control txtdescription" style="width: 100%" required >								
										</div>
									</div> 
									<div class="form-group row">
										<div class="col-sm-4"><strong>Is Active</strong>:</div>
										<div class="col-sm-8">
											<input  type="checkbox" name="is_active" class="form-check-input" value="false" id="is_active1">
																			
										</div>
									</div> 
								  </div>
								  <div class="tab" >Credits Points:
										<div class="points"></div>
										<div class=="totalcal"></div>
								  </div>
								  <div class="tab">Payment:
									 
								  </div>
								   
								  <div style="overflow:auto;">
									<div style="float:right;">
									  <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
									  <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
									</div>
								  </div>
								  <!-- Circles which indicates the steps of the form: -->
								  <div style="text-align:center;margin-top:40px;">
									<span class="step"></span>
									<span class="step"></span>
									<span class="step"></span>
									<span class="step"></span>
								  </div>
								</form>
							</div>
						</div>	
                </div>
            </div>
        </div>
    </div>
	
	 
@endsection

@section('script')

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
	alert("ok");
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input", "select");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
 
$(document).ready(function() {
	$(".licensetype").change(function(){
		var type = $(".licensetype").val();
		if(type == 'TRIAL')
		{
			$(".txtlicensecredits").val(5);
		}else{
			$(".txtlicensecredits").val('');
		}	
		
	});
});

 
</script>

<script src="{{ url('public/vendors/prism/prism.js') }}"></script>
@endsection
