@extends('layouts.app')
@section('head')
<!-- Prism -->
    <link rel="stylesheet" href="{{ url('public/vendors/prism/prism.css') }}" type="text/css"> 
	<link rel="stylesheet" href="{{ url('public/assets/css/styles.css') }}" type="text/css">
	<link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" type="text/css" rel="stylesheet" />
	<link href="{{ url('public/assets/dist/styles/focus.min.css') }}" rel='stylesheet'/>
<style>
body {
	background: #dd5e89;
	background: -webkit-linear-gradient(to left, #dd5e89, #f7bb97);
	background: linear-gradient(to left, #dd5e89, #f7bb97);
	min-height: 100vh;
	font-family: Roboto Condensed, Helvetica Neue, sans-serif;
	font-size: 8pt;
	margin: 8px 10px 8px 10px;
}

.tab-content {
  padding:10px;
  border-left:1px solid #DDD;
  border-bottom:1px solid #DDD;
  border-right:1px solid #DDD;
}
    
         div.defaultSection {
			 border: 1px solid #bbbeee;
			 padding-bottom: 0px;
			 /* display: inline-block; */
			 margin: 5px;
			 width: calc(100% - 10px);
			 overflow: hidden;
			 /* NEW */
			 overflow-x: hidden;
			 overflow-y: hidden;
			 /*
			 box-sizing: border-box;
			 float: left;
			 */
         }

 .defaultContainer {
	 display: flex;
	 justify-content: space-between;
	 padding: 2px;
	 border: 2px solid #eee;
	 overflow: hidden;
	 overflow-x: hidden;
	 overflow-y: hidden;
 }
 .defaultContainerOther {
	 display: flex;
	 justify-content: space-between;
	 overflow: hidden;
	 overflow-x: hidden;
	 overflow-y: hidden;
 }
 .defaultPanelOther {
	 flex-basis: 100%;
	 overflow: hidden;
	 overflow-x: hidden;
	 overflow-y: hidden;
 }

</style>
 
@endsection

@section('content')
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>PERT Analysis Summary</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="{{asset('assets/media/image/icons/home.png')}}" alt="">
                        <a href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('pert-analysis')}}">PERT Analysis</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">PERT Summary</li>
                </ol>
            </nav>
        </div>
    </div>

     <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="padding: 28px;">
				 <form name="frmSummary" method="get" action="" id="frmsummary">
                    <div class="row">
                        <div class="col-md-12" style="padding: 0 !important;">
								<div class="form-group">
                                    <select name="project_uuid" class="form-control projectuuid" id="exampleFormControlSelect1 " required>
                                        <option value="">-- select Project--</option>
										@if($peojectsArr)											
											@foreach($peojectsArr as $key => $items)											 
											<option value="{{$items->uuid}}">{{$items->name}}</option>
											@endforeach
										@endif
                                      </select>
                                   
                                </div>
								<input type="hidden" name="simulation_type" value="P" class="form-control" />
                                <div class="form-group">
                                    <select name="simulation_uuid" class="form-control simulation" id="exampleFormControlSelect2 " required>
                                        <option value="">-- Select Simulation--</option> 
                                      </select> 
                                </div>
                        </div>
                        
                    </div>
					</form>
                    <div class="row">                        
                        <div class="col-md-12" >                            
                            <div class="table-responsive">
                                <table class="table">
                                  <thead class="thead-dark">
                                     <tr>
                                      
                                      <th scope="col">Idx</th>
                                      <th scope="col">Desired Duration</th>
                                      <th scope="col">Critical Path Duration</th>
									  <th scope="col">Cumulative Probability</th>
                                 
                                    </tr>
                                  </thead>
                                  <tbody>
								  
                                    <tr>                                      
                                      <td>0</td>
                                      <td>0</td>
									 <td>0</td>
									<td>0</td> 
                                    </tr>
                                   
                                  </tbody>
                                </table>
                              </div>
                        </div>               
                    </div>
					<hr/>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
								  
								  <div class="d-flex">
									<div class="title pt-3 pb-4">
									  <h3>Summary Details:</h3>
									</div>
								  </div>
								  
								  <!-- START TABS DIV -->
								  <div class="tabbable-responsive">
									<div class="tabbable">
									  <ul class="nav nav-tabs" id="myTab" role="tablist">
										<li class="nav-item">
										  <a class="nav-link active" id="first-tab" data-toggle="tab" href="#chart" role="tab" aria-controls="first" aria-selected="true">Summary</a>
										</li>
										<li class="nav-item">
										  <a class="nav-link" id="second-tab" data-toggle="tab" href="#datatable" role="tab" aria-controls="second" aria-selected="false">Cost Summary</a>
										</li>
									  </ul>
									</div>
								  </div>
								</div>
								<div class="card-body">
								  <div class="tab-content">
									<div class="tab-pane fade show active" id="chart" role="tabpanel" aria-labelledby="first-tab">
									  <h5 class="card-title">Chart Summary</h5>
									  <p class="card-text">
										  <div class="col-md-12">
											<div class="row">
												<div class="col-md-12">                                    
													 <div class="defaultContainerOther" >
														<div class="defaultContainer defaultPanelOther collapsable" >
														   <div class="defaultPanel defaultCard" style="width: calc(100% / 1 - 10px); ;">
															  <div id="pertchartsummary"></div>
														   </div>
														</div>
													 </div>
												</div>
											</div>                              
										</div>									  
									  </p>
									  <div id="myvideo">														
											<!--<div id="picture-frame">
												 <img src="{{url('public/assets/media/image/cat_low_res.jpg') }}" data-src="{{url('public/assets/media/image/cat_high_res.jpg') }}" /> 
												<img src="{{url('public/assets/media/image/CriticalPath_Image.png') }}" data-src="{{url('public/assets/media/image/CriticalPath_Image.png') }}" />
											</div>
											<script>
												$(function() {
													$("#picture-frame").zoomToo({
														magnify: 1
													});
												});
											</script>-->														 
											<div class="r">
												<button onclick="openFullscreen();">Fullscreen Mode</button>
												<!--<figure class='focus-img smoother' style='background-image: url("https://images.unsplash.com/photo-1502899576159-f224dc2349fa?auto=format&fit=crop&w=2560&q=100"); height: 500px'></figure>-->
												<figure class='focus-img smoother' style='background-image: 
												url("{{url("public/assets/media/image/CriticalPath_Image.png") }}?auto=format&fit=crop&w=2560&q=100"); height: 500px'></figure> 
												
											</div>														
											 <script>
												Focus.init({
													elementID: '',
													zoomFactor: '250%'
												});
											</script>
										</div>
									  
									</div>
									<div class="tab-pane fade" id="datatable" role="tabpanel" aria-labelledby="second-tab">
									  <h5 class="card-title">Cost Summary</h5>
									  <p class="card-text">
										<table class="showDatatable table table-striped table-bordered nowrap" style="width:100%">
											<thead>
												<tr>
													<th>S.No.</th>
													<th>Planned Cast</th>
													<th>Mean</th>
													<th>Standard Deviation</th>
													<th>Co-efficient of variance</th>
													<th>Z-value</th>
												</tr>
											</thead>
											 
											<tbody>
												 
												<tr>
													<td>1</td>
													<td>1</td>
													<td>1 </td>
													<td>1</td>
													<td>1</td>
													<td>1</td>													
												</tr>
																						
											</tbody>
											 
										</table>										
									  </p>
									</div>

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
 <script src="{{ url('public/assets/dist/vanilla/focus.min.js') }}"></script>
@section('script')
<script src="{{ url('public/vendors/prism/prism.js') }}"></script>
<script src="{{ url('public/assets/js/apexcharts.min.js') }}"></script>
<script>
var elem = document.getElementById("myvideo");

function openFullscreen() {
	$("#myvideo").show();
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.webkitRequestFullscreen) { /* Safari */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE11 */
    elem.msRequestFullscreen();
  }
  
}

</script>

<script>
	  
        var options = {
          series: [{
          name: 'Frequency',
          type: 'column',
          data: [2, 0, 2, 1, 4, 5, 3, 8, 10, 12, 13, 12, 15, 22, 19, 23, 17, 19, 36, 27, 32, 35, 29, 26, 28, 20, 28, 32, 21, 24, 22, 21, 13, 19, 25, 29, 15, 19, 8, 19, 12, 20, 14, 15, 12, 13, 17, 6, 18, 10, 13, 7, 11, 7, 10, 8, 12, 8, 9, 7, 5, 5, 8, 5, 5, 3, 3, 1, 2, 1, 6, 1, 1, 0, 0, 2, 1, 1, 1, 0, 0, 1, 1, 0, 1, 0, 1, 0, 1]
        }, {
          name: 'CDF',
          type: 'line',
          data: [0.0, 0.0, 0.0, 0.0, 0.01, 0.01, 0.02, 0.02, 0.04, 0.05, 0.06, 0.07, 0.09, 0.11, 0.13, 0.15, 0.17, 0.19, 0.22, 0.25, 0.28, 0.32, 0.35, 0.37, 0.4, 0.42, 0.45, 0.48, 0.5, 0.53, 0.55, 0.57, 0.58, 0.6, 0.63, 0.65, 0.67, 0.69, 0.7, 0.72, 0.73, 0.75, 0.76, 0.78, 0.79, 0.8, 0.82, 0.82, 0.84, 0.85, 0.87, 0.87, 0.88, 0.89, 0.9, 0.91, 0.92, 0.93, 0.94, 0.94, 0.95, 0.95, 0.96, 0.97, 0.97, 0.98, 0.98, 0.98, 0.98, 0.98, 0.99, 0.99, 0.99, 0.99, 0.99, 0.99, 0.99, 0.99, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0]
        }],
          chart: {
          height: '600px',
		   width: '100%',
          type: 'line',
        },
        stroke: {
          width: [0, 4]
        },
        title: {
          text: 'Construction Cost Probability'
        },
        dataLabels: {
          enabled: true,
          enabledOnSeries: [1]
        },
        labels: [2939436, 2949436, 2959436, 2969436, 2979436, 2989436, 2999436, 3009436, 3019436, 3029436, 3039436, 3049436, 3059436, 3069436, 3079436, 3089436, 3099436, 3109436, 3119436, 3129436, 3139436, 3149436, 3159436, 3169436, 3179436, 3189436, 3199436, 3209436, 3219436, 3229436, 3239436, 3249436, 3259436, 3269436, 3279436, 3289436, 3299436, 3309436, 3319436, 3329436, 3339436, 3349436, 3359436, 3369436, 3379436, 3389436, 3399436, 3409436, 3419436, 3429436, 3439436, 3449436, 3459436, 3469436, 3479436, 3489436, 3499436, 3509436, 3519436, 3529436, 3539436, 3549436, 3559436, 3569436, 3579436, 3589436, 3599436, 3609436, 3619436, 3629436, 3639436, 3649436, 3659436, 3669436, 3679436, 3689436, 3699436, 3709436, 3719436, 3729436, 3739436, 3749436, 3759436, 3769436, 3779436, 3789436, 3799436, 3809436, 3819436],
        xaxis: {
          type: 'numeric'
        },
        yaxis: [{
          title: {
            text: 'Frequency',
          },
        
        }, {
          opposite: true,
          title: {
            text: 'Prbability'
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#pertchartsummary"), options);
        chart.render();
 </script>

<script>
$(document).ready(function() {
	var table = $('.showDatatable').DataTable( { 
		processing: true,
		select: true,
		paging: true,
		lengthChange: true,
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		searching: true,
		"order": [],
		info: false,
		responsive: true,
		autoWidth: false
    });
});

$(document).ready(function() {	 
	$('.simulation').on('change', function() {			
		var simulation_uuid = $(".simulation").val();
		var project_uuid = $(".projectuuid").val();		 
		//alert("simulation uuid "+simulation_uuid);
		var url = "{{url('')}}/pert-analysis/create?"+project_uuid+"&simulation_type=P&simulation_uuid="+simulation_uuid;
		//var url = "{{url('')}}/pert-analysis/create/"+project_uuid;
		$('#frmsummary').attr('action',url);
		$("#frmsummary").submit();		 		
		e.preventDefault();
		return true;		
	});
});
$(document).ready(function () {
	$(".projectuuid").change(function() {
		 var project_uuid = $(".projectuuid").val();
		 $.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url : "{{ route('simulation.simulationbyprojectuuid') }}",
				data : {'project_uuid' : project_uuid,'simulation_type':'P'},
				type : 'GET',
				dataType : 'json',
				success : function(response){
					
					$(".simulation").empty();					 
					var items = "<option value=''>-- select Simulation--</option>";
					$.each(response, function(index, item)
					{
						items += '<option value='+ item.uuid+'>'+ item.name +'</option>';
					});
					$(".simulation").append(items); 
				}
			});
            
     });
});
</script>
@endsection
