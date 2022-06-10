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
 /* table */
table { font-size: 75%; table-layout: fixed; width: 100%; }
table { border-collapse: separate; border-spacing: 2px; }
th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
th, td { border-radius: 0.25em; border-style: solid; }
th { background: #EEE; border-color: #BBB; }
td { border-color: #DDD; }
/* article */
article, article address, table.meta, table.inventory { margin: 0 0 3em; }
article:after { clear: both; content: ""; display: table; }
article h1 { clip: rect(0 0 0 0); position: absolute; }

article address { float: left; font-size: 125%; font-weight: bold; }

/* table meta & balance */
table.meta, table.balance { float: right; width: 36%; }
table.meta:after, table.balance:after { clear: both; content: ""; display: table; }



/* table items */
table.inventory { clear: both; width: 100%; }
table.inventory th { font-weight: bold; text-align: center; }
table.inventory td:nth-child(1) { width: 26%; }
table.inventory td:nth-child(2) { width: 38%; }
table.inventory td:nth-child(3) { text-align: right; width: 12%; }
table.inventory td:nth-child(4) { text-align: right; width: 12%; }
table.inventory td:nth-child(5) { text-align: right; width: 12%; }

/* table balance */
table.balance th, table.balance td { width: 50%; }
table.balance td { text-align: right; }

/* aside */
aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
aside h1 { border-color: #999; border-bottom-style: solid; }
@media print {
	* { -webkit-print-color-adjust: exact; }
	html { background: none; padding: 0; }
	body { box-shadow: none; margin: 0; }
	span:empty { display: none; }
	.add, .cut { display: none; }
}

@page { margin: 0; }
	</style>
	
	<style>
        #footer {
            position: fixed;
            padding: 10px 10px 0px 10px;
            bottom: 0;
            width: 100%;
            /* Height of the footer*/ 
            height: 40px;
            background: grey;
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
                <div class="card">
					<div class="invoice" id="invoice">
					@if($res)	
						<div class="card-header"><header style="background: #2C509E;border-radius: 0.25em;color: #FFF; margin: 0 0 1em;padding: 0.5em 0;">
						<h1 style="font: bold 100% sans-serif;letter-spacing: 0.5em; text-align: center; text-transform: uppercase;">TAX Invoice</h1>					
						
						</header></div>						
                        <div class="card-body p-50">                            
                                <div class="row">                                    
                                    <div class="col-md-9">                                         
                                        <p class="text-left"><strong>{{$res->bill_from->org_full_name}}</strong>,<br> {{$res->bill_from->address_line_2}}, 
										{{$res->bill_from->state}}-{{$res->bill_from->pin}},
										<br> {{$res->bill_from->country}}, {{$res->bill_from->phone}},<br>
										 {{$res->bill_from->gst}}</p>
                                    </div>									 
									<div class="col-md-3">
										<img class="m-r-20" src="{{asset('public/assets/media/image/logo.png')}}" alt="image">
                                    </div>
                                </div>
								<article>
								<h1>Recipient</h1>
								<address>
									<p>ABC Construction Pvt. Ltd<br>Kalina, Santacruz(W)<br>Mumbai</p>
								</address>
								<table class="meta">
									<tr>
										<th><span>Invoice #</span></th>
										<td><span>@if($res) {{$res->id}} @else 01 @endif</span></td>
									</tr>
									<tr>
										<th><span>Invoice Date  </span></th>
										<td><span>@php echo date('d-M-Y',$invoiceDate); @endphp</span></td>
									</tr>
									<tr>
										<th><span>Amount (Rs.)</span></th>
										<td><span data-prefix></span><span>{{$res->unit_price}}</span></td>
									</tr>
								</table>
								<table class="inventory">
									<thead>
										<tr>
											<th width="60%"><span>Description</span></th>						
											<th><span>Rate</span></th>
											<th><span>Quantity</span></th>
											<th><span>Price</span></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td width="60%"><span>{{$res->bill_from->org_full_name}} @ Rs. {{$res->unit_price}}/credit</span></td>					
											<td><span data-prefix></span><span>{{$res->unit_price}}</span></td>
											<td><span data-prefix></span><span>{{$res->quantity}}</span></td>
											<td><span data-prefix></span><span>{{$res->total_amount}}</span></td>
										</tr>
									</tbody>
								</table>
								
								<table class="balance">
									<tr>
										<th><span>Subtotal</span></th>
										<td><span data-prefix></span><span>@if($res) {{$res->net_amount}} @else 0 @endif</span></td>
									</tr>
									<tr>
										<th><span>GST(18%)</span></th>
										<td><span data-prefix></span><span>@if($res) {{$res->tax_amount}} @else 0 @endif</span></td>
									</tr>
									<tr>
										<th><span>Total</span></th>
										<td><span data-prefix></span><span>@if($res) {{$res->total_amount}} @else 0 @endif</span></td>
									</tr>
								</table>
							</article>
							<aside>
								<h1><span>Additional Notes</span></h1>
								<div>
									<p>This is a computer generated invoice, no signature required.</p>
								</div>
							</aside>							
                            </div>
							@endif
						</div>	
						
                            <div class="text-center d-print-none">
                                <hr class="mb-5 mt-5">								  
								<button class="btn btn-primary" id="downloadPDF">Download PDF</button>
                              	<button class="btn btn-primary sendemailbttn">
								<i data-feather="send" class="mr-2"></i> Send Invoice</button>
								<button class="btn btn-primary printme"> 
										<i data-feather="printer" class="mr-2"></i> Print</button>
                                <!--<a href="javascript:window.print()" class="btn btn-success m-l-5">
                                    <i data-feather="printer" class="mr-2"></i> Print
                                </a>-->
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

$( document ).ready(function() {
    $('.printme').click(function()
     {
         window.print();
     });
});

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
