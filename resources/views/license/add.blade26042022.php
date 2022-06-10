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
.tabs {
    width:100%;
    display:inline-block;
   }

   .tabs h4 {
    color: #00447c;
    margin: 5px 0 15px 0;
    display: inline-block;
   }
 
  .tab-links:after {
    display:block;
    clear:both;
    content:'';
  }

  .tab-links {
    padding: 0;
    margin: 10px 0 0 0;
    position: relative;
    top: 2px;
  }

  .tab-links li {
    margin:0px 5px 0 0;
    float:left;
    padding-top: 2px;
    list-style:none;
  }

  .tab-links a {
    padding:9px 8px 6px;
    display:inline-block;
    background: #c7d8e8;
    border: 2px solid #c7d8e8;
    border-bottom: 3px solid #c7d8e8;
    font-size: 10.5px;
    font-weight:600;
    color:#00447c;
    transition:all linear 0.15s;
  }

  .tab-links a:hover {
    background: #a7cce5;
    text-decoration:none;
    border: 2px solid #a7cce5;
    border-bottom: 3px solid #a7cce5;  
    color: #ee3124;
  }

  li.active a, li.active a:hover {
    background:#fff;
    height: 16px;
    border-bottom: none;
    color: #ee3124;
  }

  .tab-content, .uploaded-documents-container {
    padding:15px;
    border-radius:3px;
    border: 2px solid #c7d8e8;
    background:#fff;
    font-size: .95em;
  }

  .tab-content-scroll {
    max-height: 375px;
    min-height: 375px;
    max-width: 1100px;
    min-width: 450px;
    overflow: auto;
    clear:both;
  }

  .tab-content-scroll-home {
    min-height: 135px;
  }

  .button-bar-scroll {
    min-height: 235px;
  }

  .tab-content-scroll>p {
    margin-top: 0;
    padding-right: 12px;
  }

  .tab-content a {
    margin-top: 10px;
    color: #00447c;
  }

  .tab {
    display:none;
  }

  .tab.active {
    display:block;
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
                        <img style="height: 12px; margin-top: -3px;" src="{{asset('public/assets/media/image/icons/home.png')}}" alt="">
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
                    <div class="col-md-12 text-right mb-3" ></div>
                </div>
                <div class="card">				  
						<div class="row">										
							<div class="col-sm-12">
								<div class="tabs">
									<ul class="tab-links">
										<li class="active"><a href="#tab1">Create License</a></li>
										<li><a href="#tab2">License Calculate</a></li>
										<!--<li><a href="#tab3">Payments</a></li>
										<li><a href="#tab4">Final</a></li>-->
									</ul>
										
									<form name="frmTab" id="licenseFrm" method="post" action="{{route('license.save')}}">
										@csrf
										<div class="tab-content">
											<div id="tab1" class="tab active">
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
														<input type="text" name="license_credits" value="5" class="form-control txtlicensecredits">								
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
														<input type="text" name="description" class="form-control txtdescription">								
													</div>
												</div> 
												<div class="form-group row">
													<div class="col-sm-4"><strong>Is Active</strong>:</div>
													<div class="col-sm-8">
														<input  type="checkbox" name="is_active" class="form-check-input" value="false" id="is_active1">
																						
													</div>
												</div>
												<!--<ul class="tab-links">
													 <li>
													  <a href="#next_tab2" class="nextButton">Next</a>
													</li>
												</ul>-->
												<div class="text-center">													
													<button type="button" class="btn btn-primary prevButton">Previous</button>
													<button type="button" class="btn btn-primary nextButton">Next</button>
												</div>
											</div>								 
											<div id="tab2" class="tab">											
												
												 <div class="form-group row">
													<div class="col-sm-4"><strong>Credits Points</strong>:</div>
													<div class="col-sm-8">
														 <input type="text" name="points" value="" class="form-control points" readonly>
													</div>
												</div>
												<div class="form-group row">
													<div class="col-sm-4"><strong>Total Amount</strong>:</div>
													<div class="col-sm-8">
														 <input type="text" name="totalsum" value="" class="form-control totalsum" readonly>					
													</div>
												</div>	
												<div class="text-center">													
													<button type="button" class="btn btn-primary prevButton">Previous</button>
													<button type="button" id="licenseBttnSmt" name="sbumitBttn" class="btn btn-primary">Save</button>
												</div>	
												<!--<ul class="tab-links">
													<li>
													  <a href="#back_tab1" class="prevButton">Prev</a>
													  <a href="#next_tab2" class="nextButton">Next</a>
													</li>
												</ul>
												<div class="text-center">													
													<button type="button" class="btn btn-primary prevButton">Previous</button>
													<button type="button" class="btn btn-primary nextButton">Next</button>
												</div>-->
											</div>								 
											<!-- <div id="tab3" class="tab">
												<h4>Payment Method</h4>
												<div class="text-center">													
													<button type="button" class="btn btn-primary prevButton">Previous</button>
													<button type="button" class="btn btn-primary nextButton">Next</button>
												</div>
												
											</div>								 
											<div id="tab4" class="tab">
												<h4>Final</h4>												
												<div class="text-center">													
													<button type="button" class="btn btn-primary prevButton">Previous</button>
													<button type="submit" name="sbumitBttn" class="btn btn-primary">Save</button>
												</div>												
											</div>-->
										</div>
									</form>									
								</div>
							</div>
						</div>	
                </div>
            </div>
        </div>
    </div>	
	
<div class="modal fade showModel">
	<div class="modal-dialog modal-lg">	
		<div class="modal-content">					 
			<div class="modal-body">
				 <div id="dvCountDown" style="display: none">  
					You will be redirected after <span id="lblCount"></span>&nbsp;seconds.  
				</div> 
			</div> 			
		</div> 
	</div>                                          
</div>

@endsection

@section('script')

<script>
jQuery(document).ready(function() {
    jQuery('.tabs .tab-links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');		 
		var credits =$(".txtlicensecredits").val();
		var sum = credits*5000;
		//alert("text1 "+credits+" sum"+sum);
		$(".points").val(credits);
		$(".totalsum").val(sum); 		 
        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).show().siblings().hide(); 
        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active'); 
        e.preventDefault();
    });
   
     
	jQuery('.nextButton').on('click', function() {        
		var $activeTab = $('.tab-links li.active');	 
		var $wrapper = jQuery(this).closest('.tabs');
		var indexActive = $wrapper.find('li.active').index();
		$wrapper.find('li').eq(indexActive + 1).find('a').click();
	});

	jQuery('.prevButton').on('click', function() {        
		var $activeTab = $('.tab-links li.active');
		var $wrapper = jQuery(this).closest('.tabs');
		var indexActive = $wrapper.find('li.active').index();
		$wrapper.find('li').eq(indexActive - 1).find('a').click();
	});
    
});

$("#licenseBttnSmt").on("click", function(event) {	 
    event.preventDefault();	 
	var seconds = 5;  
	$("#dvCountDown").show(); 
	$('.showModel').modal({
		backdrop: 'static',
		keyboard: false
	});	
	$("#lblCount").html(seconds);  
	setInterval(function () {  
		seconds--;  
		$("#lblCount").html(seconds);  
		if (seconds == 0) {  
			$("#dvCountDown").hide();  
			 $("#licenseFrm").submit();
		}  
	}, 5000);  	
});


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
