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
            <h4>Invoice</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="{{asset('public/assets/media/image/icons/home.png')}}" alt="">
                        <a href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('license')}}">License History</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Invoice</li>
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
                        <div class="card-body p-50">
                            <div class="invoice" id="invoice">
								@if($res)	
                                <div class="d-md-flex justify-content-between align-items-center">
                                    <h2 class="font-weight-800 d-flex align-items-center">
                                        <img class="m-r-20" src="{{asset('public/assets/media/image/logo.png')}}" alt="image">
                                    </h2>
                                    <h3 class="text-xs-left m-b-0">Invoice #INV-@if($res) {{$res->id}} @else 01 @endif</h3>
                                </div>
                                <hr class="m-t-b-50">
                                <div class="row">
                                    <div class="col-md-6">
										<p>
                                            <h3>Biil To</h3>
                                        </p>                                         
                                        <p><strong>{{$res->bill_to->org_full_name}}</strong>, <br> {{$res->bill_to->address_line_1}},<br>{{$res->bill_to->address_line_2}} 
											{{$res->bill_to->city}},<br>{{$res->bill_to->state}}, {{$res->bill_to->country}} -{{$res->bill_to->pin}},<br>
											{{$res->bill_to->phone}},<br> {{$res->bill_to->gst}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-right">
                                            <b>Bill From</b>
                                        </p>
                                        <p class="text-right"><strong>{{$res->bill_from->org_full_name}}</strong>,<br> {{$res->bill_from->address_line_2}}, 
										{{$res->bill_from->state}}-{{$res->bill_from->pin}},
										<br> {{$res->bill_from->country}}, {{$res->bill_from->phone}},<br>
										 {{$res->bill_from->gst}}</p>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table mb-4 mt-4">
                                        <thead class="thead-light">
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>Description</strong></th>
                                            <th class="text-right"><strong>Quantity</strong></th>
                                            <th class="text-right"><strong>Unit cost</strong></th>
                                            <th class="text-right"><strong>Total</strong></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                       										 
                                        <tr class="text-right">
                                            <td class="text-left">{{$res->id}}</td>
											<td class="text-left">{{$res->bill_from->org_full_name}}</td>
                                            <td class="text-left"> {{$res->quantity}}</td>
                                            <td> {{$res->unit_price}}  </td>
                                            <td>{{$res->total_amount}}</td>                                            
                                        </tr>                                        
										
                                        </tbody>
                                    </table>
                                </div>								
                                <div class="text-right">
                                    <p>Sub - Total amount:  @if($res) {{$res->net_amount}} @else 0 @endif</p>
                                    <p>vat (18%) :  @if($res) {{$res->tax_amount}} @else 0 @endif</p>
                                    <h4 class="font-weight-800">Total :  @if($res) {{$res->total_amount}} @else 0 @endif</h4>
                                </div>
                                <p class="text-center small text-muted  m-t-50">
									<span class="row">
										<span class="col-md-6 offset-3">
										{{$res->bill_from->org_full_name}}
										</span>
									</span>
                                </p>
							@endif
                            </div>
							
                            <div class="text-right d-print-none">
                                <hr class="mb-5 mt-5">								  
								<button class="btn btn-primary" id="downloadPDF">Download PDF</button>
                              	<button class="btn btn-primary sendemailbttn">
								<i data-feather="send" class="mr-2"></i> Send Invoice</button>
								<button onclick="printDiv('invoice')" class="btn btn-primary"> 
										<i data-feather="printer" class="mr-2"></i> Print</button>
                                <!--<a href="javascript:window.print()" class="btn btn-success m-l-5">
                                    <i data-feather="printer" class="mr-2"></i> Print
                                </a>-->
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
	
	<!-- .modal -->
	<div class="modal fade showModel">
		<div class="modal-dialog">
			<form name="modelFrm" method="post" action="{{route('license.sendinvoice')}}" class="frmAction">
			<!-- CROSS Site Request Forgery Protection -->
			@csrf	
				<div class="modal-content">
					<div class="modal-header">	
						<input type="hidden" name="uuid" value="{{$res->license_uuid}}">
						<h4 class="modal-title"><span class="txttitle"></span></h4> 
						<button type="button" class="close" data-dismiss="modal">×</button>								
					</div>
					<div class="modal-body">						 
						<div class="form-group row licensecredits">
							<div class="col-sm-4"><strong>E-mail Address</strong>:</div>
							<div class="col-sm-8">
								<input type="email" name="email" class="form-control" pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" style="width: 100%" required>								
							</div>
						</div> 
						
					</div>   
					<div class="modal-footer">
						<button type="submit"  class="btn btn-primary btn-rounded">Send</button>
						<button type="button" class="btn btn-primary btn-rounded" data-dismiss="modal">Close</button>								                              
					</div>
				</div> 
			</form>
		</div>                                          
	</div>	
	
	
@endsection

@section('script')
<script>
function printDiv(divName){
	var printContents = document.getElementById(divName).innerHTML;
	var originalContents = document.body.innerHTML;
	document.body.innerHTML = printContents;
	window.print();
	document.body.innerHTML = originalContents;
}

$(document).ready(function() {
	$(".sendemailbttn").on("click", function(event){ 	
		$(".txttitle").show().text('Send Invoice');
		//$('.frmAction').attr('action', "{{route('activity.save')}}");		 
		$('.showModel').modal({
			backdrop: 'static',
			keyboard: false
		});
	});
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
<script>
$(document).ready(function() {
	$('#downloadPDF').click(function () {
		domtoimage.toPng(document.getElementById('invoice'))
			.then(function (blob) {
				var pdf = new jsPDF('l', 'pt', [$('#invoice').width(), $('#invoice').height()]);
				pdf.addImage(blob, 'PNG', 0, 0, $('#invoice').width(), $('#invoice').height());
				pdf.save("{{$res->id}}.pdf");
				that.options.api.optionsChanged();
			});
			
		
	});
});
</script>

<script src="{{ url('public/vendors/prism/prism.js') }}"></script>
@endsection
