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
	</style>
@endsection

@section('content')
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Projects</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="{{asset('assets/media/image/icons/home.png')}}" alt="">
                        <a href="/dashboard/analytics">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="/dashboard/project">Project</a>
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
                    <div class="row">
                        <div class="col-md-11" style="padding: 0 !important;">
                            <form>
								<div class="form-group">
                                    <select name="simulation_uuid" class="form-control" id="exampleFormControlSelect1" required>
                                        <option value="">-- select Simulation--</option>
										@if($simulation)											
											@foreach($simulation as $kx => $item)											 
											<option value="{{$item->uuid}}" @if($item->project_uuid == $projectUuid) selected="selected" @endif>{{$item->name}}</option>
											@endforeach
										@endif
                                      </select>
                                   
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="exampleFormControlSelect1" required>
                                        <option value="">-- Select Project Activity--</option>
										@if($activityProjects)
											@foreach($activityProjects as $idx => $val)
											<option value="{{$val->uuid}}">{{$val->name}}</option>
											@endforeach
										@endif
                                      </select>
                                   
                                </div>
                            </form>
                        </div>
                       <!-- <div class="col-md-1">
                            <a href="#" class="mr-3" style="font-size:25px;">
                                <img style="height:20px;" src="{{ url('assets/media/image/icons/return.png') }}" alt="logo">
                            </a>
                        </div>-->
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <h5>Summary</h5>
                            </p>
                            <p> <strong>Planned Cost </strong> : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @if($summary->planned_cost){{$summary->planned_cost}} @endif<br>  <strong>Mean </strong>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @if($summary->mean){{$summary->mean}} @endif <br>  <strong>Standard Deviation </strong>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if($summary->std){{$summary->std}} @endif 
                            <br>  <strong>Co-efficient of variance </strong>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @if($summary->covar){{$summary->covar}} @endif  <br>  <strong>Z-value </strong>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-@if($summary->zvalue){{$summary->zvalue}} @endif</p>
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
								  @if( $summary->confidence )
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
												<div class="col-md-6">                                    
													<div id="apex_chart_four" style="height: 300px"></div>
												</div>
												<div class="col-md-6">
													<div id="apex_chart_two" style="height: 300px"></div>
												</div>
											</div>                              
										</div>									  
									  </p>
									</div>
									<div class="tab-pane fade" id="datatable" role="tabpanel" aria-labelledby="second-tab">
									  <h5 class="card-title">Cost Summary</h5>
									  <p class="card-text">
										<table class="showDatatable table table-striped table-bordered dt-responsive nowrap" style="width:100%">
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
											@if($summaryArr)
											<tbody>
												@foreach($summaryArr as $ks => $sum)
												<tr>
													<td>{{$ks+1}}</td>
													<td>{{$sum->summary->planned_cost}}</td>
													<td>{{$sum->summary->mean}} </td>
													<td>{{$sum->summary->std}}</td>
													<td>{{$sum->summary->covar}}</td>
													<td>{{$sum->summary->zvalue}}</td>													
												</tr>
																						
											</tbody>
											@endforeach
											@endif
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
<script type="javascript">
$(function () {
	$('[data-toggle="tooltip"]').tooltip();
});
$(document).ready(function() {
		var table = $('.showDatatable').DataTable( {       
				destroy: true,
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
    } );
} );

</script>

<!-- Javascript -->
<script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
<script src="{{ url('public/vendors/charts/apex/apexcharts.min.js') }}"></script>
<script src="{{ url('public/assets/js/examples/charts/apex.js') }}"></script>
<!-- Apex chart -->
<script src="{{ url('public/vendors/charts/apex/apexcharts.min.js') }}"></script>
<!-- Chartjs -->
<script src="{{ url('public/vendors/charts/chartjs/chart.min.js') }}"></script>

<script src="{{ url('public/vendors/prism/prism.js') }}"></script>
@endsection
