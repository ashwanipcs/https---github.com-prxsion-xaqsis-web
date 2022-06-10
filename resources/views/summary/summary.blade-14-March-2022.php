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
svg {
    font: 10px sans-serif;
  }
  .bar rect {
    fill: steelblue;
    shape-rendering: crispEdges;
  }
  .axis path, .axis line {
    fill: none;
    stroke: #000;
    shape-rendering: crispEdges;
  }
  .line {
    fill: none;
    stroke: purple;
    stroke-width: 1.5px;
  }
.tab-content {
  padding:10px;
  border-left:1px solid #DDD;
  border-bottom:1px solid #DDD;
  border-right:1px solid #DDD;
}
</style>
 
@endsection

@section('content')
     <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Summary</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="{{asset('public/assets/media/image/icons/home.png')}}" alt="">
                        <a href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('projects')}}">Project</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Summary</li>
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
                                    <select class="form-control projectuuid" id="exampleFormControlSelect1 " required>
                                        <option value="">-- select Projects--</option>
										@if($projects)											
											@foreach($projects as $kp => $p)											 
											<option value="{{$p->uuid}}" {{($p->uuid == $projectUuid) ? 'selected' : '' }}>{{$p->name}}</option>
											@endforeach
										@endif
                                      </select>
                                   
                                </div>
								<div class="form-group">
                                    <select name="simulation_uuid" class="form-control simulations" id="exampleFormControlSelect1 " required>
                                        <option value="">-- select Simulation--</option>
										@if($simulation)											
											@foreach($simulation as $kx => $item)											 
											<option value="{{$item->uuid}}" {{($item->uuid == $simulation_uuid) ? 'selected' : '' }}>{{$item->name}}</option>
											@endforeach
										@endif
                                      </select>
                                   
                                </div>
                                <div class="form-group">
                                    <select name="activity_name" class="form-control projectActivity" id="exampleFormControlSelect2 " required>
                                        <option value="">-- Select Project Activity--</option>
										@if($activityProjects)
											@foreach($activityProjects as $idx => $val)
											<option value="{{$val->name}}" {{($val->name == $activityname) ? 'selected' : '' }}>{{$val->name}}</option>
											@endforeach
										@endif
                                      </select>
                                   
                                </div>
                           
                        </div>
                       <!--<div class="col-md-1">
                            <a href="#" class="mr-3 bttnSearch" style="font-size:25px;">
                                <img style="height:20px;" src="{{ url('assets/media/image/icons/return.png') }}" alt="logo">
                            </a>
							<button type="submit" name="searchBttn">Search </button>
                        </div>-->
                    </div>
					</form>
                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <h5>Summary</h5>
                            </p>
							
                            <p> <strong>Planned Cost </strong> : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @if($summary){{$summary->planned_cost}} @endif<br>  <strong>Mean </strong>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @if($summary){{$summary->mean}} @endif <br>  <strong>Standard Deviation </strong>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if($summary){{$summary->std}} @endif 
                            <br>  <strong>Co-efficient of variance </strong>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @if($summary){{$summary->covar}} @endif  <br>  <strong>Z-value </strong>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-@if($summary){{$summary->zvalue}} @endif</p>
                        </div>
                        <div class="col-md-6" >
                            <p class="text-left">
                                <h5>Confidence</h5>
                            </p>
                            <div class="table-responsive">
                                <table class="table">
                                  <thead class="thead-dark">
                                    <tr>
                                      
                                      <th scope="col">Probability</th>
                                      <th scope="col">Estimated Cost</th>
                                      <th scope="col">Contingency Reserve</th>
                                 
                                    </tr>
                                  </thead>
                                  <tbody>
								  @if( $summary)
									  @foreach( $summary->confidence as $key => $val )
                                    <tr>                                      
                                      <td>{{ $key }}</td>
                                      <td>{{ $val }}</td>
									   @if( $summary->contingency_reserve )
										    @foreach( $summary->contingency_reserve as $index => $items )
											@if($key == $index)
											<td>{{ $items }}</td>
											@endif
										 @endforeach
										@endif
                                    </tr>
                                   @endforeach
								   @endif
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
									<!-- Nav tabs -->
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active btn btn-default"><a href="#example2-tab1" aria-controls="example2-tab1" role="tab" data-toggle="tab">Summary </a></li>
										<li role="presentation" class="btn btn btn-default"><a href="#example2-tab2" aria-controls="example2-tab2" role="tab" data-toggle="tab">Cost Details</a></li>
									</ul>

												<!-- Tab panes -->
												<div class="tab-content">
													<div role="tabpanel" class="tab-pane fade in active" id="example2-tab1">
														<table id="example2-tab1-dt" class="table table-striped table-bordered table-condensed" cellspacing="0" width="100%">
															 <div class="col-md-12">                                    
																<div class="d3summary"></div>
															</div>
														</table>
													</div>
													<div role="tabpanel" class="tab-pane fade" id="example2-tab2">
														<table id="example2-tab2-dt" class="table table-striped table-bordered table-condensed" cellspacing="0" width="100%">
															<thead>
																<tr>
																	<th>Iteration</th>
																	<th>Mostlikely Cost</th>
																	<th>Optimistic Cost</th>
																	<th>Pessimistic Cost</th>
																	<th>Ca1</th>
																	<th>Ca2</th>
																</tr>
															</thead>
															<tbody>
																@if($costdetails)
																	@foreach($costdetails as $ks => $sum)
																	<tr>
																		<td>{{$sum->iteration}}</td>
																		<td>{{$sum->mostlikely_cost}}</td>
																		<td>{{$sum->optimistic_cost}} </td>
																		<td>{{$sum->pessimistic_cost}}</td>
																		<td>{{$sum->ca1}}</td>
																		<td>{{$sum->ca2}}</td>													
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
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="https://d3js.org/d3.v3.min.js"></script>
<script src="{{ url('public/assets/js/d3chart.js') }}"></script>
<script>

$(document).ready(function(){    
   $('#example2-tab2-dt').DataTable({
      responsive: true
   });
   
   $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
         .columns.adjust()
         .responsive.recalc();
   });   
   
});
$(document).ready(function (){
    $('#summaryTab').DataTable();
	 $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
         .columns.adjust()
         .responsive.recalc();
   });   
});

$(document).ready(function() {	 
	$('.simulations').on('change', function() {			
		var simulation_uuid = $(".simulations").val();
		//alert("simulation uuid "+simulation_uuid);
		$("#frmsummary").submit();
		e.preventDefault();
		return true;		
	});
});
$(document).ready(function() {	 
	$('.projectActivity').on('change', function() {			
		//var simulation_uuid = $(".simulations").val();
		//alert("simulation uuid "+simulation_uuid);
		$("#frmsummary").submit();
		e.preventDefault();
		return true;		
	});
});

</script>

<script src="{{ url('public/vendors/prism/prism.js') }}"></script>

@endsection
