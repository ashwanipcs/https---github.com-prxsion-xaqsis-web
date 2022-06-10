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
.bar{
    fill: steelblue;
  }

.bar:hover{
	fill: brown;
}

.axis {
  font: 10px sans-serif;
}

.axis path,
.axis line {
  fill: none;
  stroke: #000;
  shape-rendering: crispEdges;
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
				 <form name="frmSummary" method="get" action="" id="frmsummary" class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-md-12" style="padding: 0 !important;">
								<div class="form-group">
                                    <select class="form-control projectuuid" id="exampleFormControlSelect1 " required>
                                        <option value="">-- select Project--</option>
										@if($projects)											
											@foreach($projects as $kp => $p)											 
											<option value="{{$p->uuid}}">{{$p->name}}</option>
											@endforeach
										@endif
                                      </select>
                                   
                                </div>
                                <div class="form-group">
                                    <select name="simulation_uuid" class="form-control simulation" id="exampleFormControlSelect2 " required>
                                        <option value="">-- Select Simulation--</option> 
                                      </select> 
                                </div>
                        </div>
                        <input type="hidden" name="activity_name" value=""/>
                    </div>
					</form>
                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <h5>Summary</h5>
                            </p>
							
                            <p> <strong>Planned Cost </strong> : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 0<br>  <strong>Mean </strong>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 0 <br>  <strong>Standard Deviation </strong>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0
                            <br>  <strong>Co-efficient of variance </strong>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 0 <br>  <strong>Z-value </strong>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-0</p>
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
								  
                                    <tr>                                      
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
										  <a class="nav-link active" id="first-tab" data-toggle="tab" href="#chart" role="tab" aria-controls="first" aria-selected="true">Charts</a>
										</li>
										<li class="nav-item">
										  <a class="nav-link" id="second-tab" data-toggle="tab" href="#datatable" role="tab" aria-controls="second" aria-selected="false">Summary</a>
										</li>
									  </ul>
									</div>
								  </div>
								</div>
								<div class="card-body">
								  <div class="tab-content">
									<div class="tab-pane fade show active" id="chart" role="tabpanel" aria-labelledby="first-tab">
									  <h5 class="card-title">Chart</h5>
									  <p class="card-text">
										  <div class="col-md-12">
											<div class="row">
												<div class="col-md-12">                                    
													<svg id="d3_demo"></svg>
												</div>
											</div>                              
										</div>									  
									  </p>
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

@section('script')

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
		var url = "{{url('')}}/summary/create/"+project_uuid+"&simulation_type=C?simulation_uuid="+simulation_uuid;
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
				data : {'project_uuid' : project_uuid,'simulation_type':'C'},
				type : 'GET',
				dataType : 'json',
				success : function(response){
					
					$(".simulation").empty();					 
					var items = "<option value=''>-- select simulation--</option>";
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

<script src="{{ url('public/vendors/prism/prism.js') }}"></script>
<script src="https://d3js.org/d3.v6.min.js"></script>
<script src="{{ url('public/assets/js/d3chart.js') }}"></script>
@endsection
