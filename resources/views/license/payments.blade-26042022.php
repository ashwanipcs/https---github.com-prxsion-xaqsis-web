@extends('layouts.app')
@section('head')
 <!-- Prism 
 Route::post('license/success', [LicenseController::class, 'paymentSuccess'])->name('license.success');
Route::post('license/failure', [LicenseController::class, 'paymentFailure'])->name('license.failure');
 -->
<link rel="stylesheet" href="{{ url('public/vendors/prism/prism.css') }}" type="text/css">
@endsection

@section('content')
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Pay Now</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="{{asset('public/assets/media/image/icons/home.png')}}" alt="">
                        <a href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('license')}}">Payments</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Payments Now</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
				<div class="row">
                    <div class="col-md-12 text-right mb-3" ></div>
                </div>
                <div class="card">				  
						<div class="row">										
							<div class="col-sm-12">
								 								 
									<form name="frmTab" method="post" action="{{route('license')}}">
										@csrf
										<div class="form-group">
											  <label class="control-label col-sm-2" for="email">Order uuid:</label>
											  <div class="col-sm-6">
												<input  name="order_uuid" value="{{$order_uuid}}" id="order_uuid" type="text" class="form-control" placeholder="Enter Order uuid">
											  </div>
											  <label class="control-label col-sm-2" for="pwd">Order Amount:</label>
											  <div class="col-sm-6">          
												<input name="order_amount" value="{{$order_amount}}" type="text" class="form-control" id="order_amount" placeholder="Enter Amount">
											  </div>
											</div>
											<div class="form-group">
											  <label class="control-label col-sm-2" for="pwd">Order Currency:</label>
											  <div class="col-sm-6">          
												<input name="order_currency" value="{{$order_currency}}" type="text" class="form-control" id="order_currency" placeholder="Enter Currency">
											  </div>
											</div>
											<div class="form-group">
											  <label class="control-label col-sm-2" for="pwd">Order Receipt:</label>
											  <div class="col-sm-6">          
												<input name="order_receipt" value="{{$order_receipt}}" type="text" class="form-control" id="order_receipt" placeholder="Enter Receipt">
											  </div>
											</div>
											
											<div class="form-group">        
											  <div class="col-sm-offset-2 col-sm-10">
												<button type="submit" id="rzp-button1" class="btn btn-primary">Pay Now</button>
											  </div>
											</div>
									</form>
								</div>
							 <form name="frmFailure" id="frmFailure" method="post" action="{{route('license.failure')}}">
								@csrf								 
									<input  name="receipt" type="hidden" class="form-control" value="{{$order_receipt}}"/>
									<input  name="response_error_code" type="hidden" class="form-control response_error_code"/>											
									<input name="response_error_description"  type="hidden" class="form-control response_error_description"/>
									<input name="response_error_source"  type="hidden" class="form-control response_error_source" />
									<input name="response_error_step"  type="hidden" class="form-control response_error_step" />
									<input name="response_error_reason"  type="hidden" class="form-control response_error_reason" />
									<input name="response_error_metadata_order_uuid"  type="hidden" class="form-control response_error_metadata_order_uuid" />
									<input name="response_error_metadata_payment_uuid"  type="hidden" class="form-control response_error_metadata_payment_uuid" />
									   
							</form> 
							<form name="frmSuccess" id="frmSuccess" method="post" action="{{route('license.success')}}">
								@csrf								 
									<input  name="receipt" type="hidden" class="form-control" value="{{$order_receipt}}"/>
									<input  name="payment_uuid" type="hidden" class="form-control payment_uuid"/>											
									<input name="order_uuid"  type="hidden" class="form-control order_uuid"/>
									<input name="signature"  type="hidden" class="form-control signature" />
									
							</form>
						</div>	
                </div>
            </div>
        </div>
    </div>	
	 
@endsection

@section('script')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "rzp_test_wW0DMchmxJzAS6", // Enter the Key ID generated from the Dashboard
    "amount": "{{$order_amount}}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "{{$order_currency}}",
    "name": "Acme Corp",
    "description": "Test Transaction",
    "image": "https://example.com/your_logo",
    "order_id": "{{$order_uuid}}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "handler": function (response){
        /*
		alert(response.razorpay_payment_id);
        alert(response.razorpay_order_id);
        alert(response.razorpay_signature);
		*/
		
		var payment_uuid = response.razorpay_payment_id;
		var order_id = response.razorpay_order_id;
		var signature = response.razorpay_signature;
	 
		$(".payment_uuid").val(payment_uuid);
		$(".order_id").val(order_id);
		$(".signature").val(signature);
	
		$("#frmSuccess").submit();
	
    },
    "prefill": {
        "name": "Sarabjeet Singh",
        "email": "sarabjeet.singh@prxsion.com",
        "contact": "9930317670"
    },
    "notes": {
        "address": "Razorpay Corporate Office"
    },
    "theme": {
        "color": "#3399cc"
    }
};
var rzp1 = new Razorpay(options);
rzp1.on('payment.failed', function (response){
	
	 
	var response_error_code = response.error.code;
	var response_error_description = response.error.description;
	var response_error_source = response.error.source;
	var response_error_step = response.error.step;
	var response_error_reason = response.error.reason;
	var response_error_metadata_order_uuid = response.error.metadata.order_id;
	var response_error_metadata_payment_uuid = response.error.metadata.payment_id;
	
	$(".response_error_code").val(response_error_code);
	$(".response_error_description").val(response_error_description);
	$(".response_error_source").val(response_error_source);
	$(".response_error_step").val(response_error_step);
	$(".response_error_reason").val(response_error_reason);
	$(".response_error_metadata_order_uuid").val(response_error_metadata_order_uuid);
	$(".response_error_metadata_payment_uuid").val(response_error_metadata_payment_uuid);
	
	$("#frmFailure").submit();
	
      /*
		alert(response.error.code);
        alert(response.error.description);
        alert(response.error.source);
        alert(response.error.step);
        alert(response.error.reason);
        alert(response.error.metadata.order_id);
        alert(response.error.metadata.payment_id);
		 */
	
});
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
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

</script>

<script src="{{ url('public/vendors/prism/prism.js') }}"></script>
@endsection
