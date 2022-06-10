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
            <h4>Project->Summary</h4>
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
                                    <select class="form-control" id="exampleFormControlSelect1" >
                                        <option>-- select project activity --</option>
										@if($projectActivity)
											@foreach($projectActivity as $index => $val)
											<option value="{{$val->uuid}}">{{$val->name}}</option>
											 @endforeach
										@endif 
                                      </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-1">
                            <a href="#" class="mr-3" style="font-size:25px;">
                                <img style="height:20px;" src="{{ url('assets/media/image/icons/return.png') }}" alt="logo">
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <h5>Summary</h5>
                            </p>
                            <p> <strong>Planned Cost </strong> : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3346342.00 <br>  <strong>Mean </strong>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3392932.00 <br>  <strong>Standard Deviation </strong>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;23920.00
                            <br>  <strong>Co-efficient of variance </strong>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 0.132 <br>  <strong>Z-value </strong>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-0.67</p>
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
                                      
                                      <td>10%</td>
                                      <td>445401.00</td>
                                      <td>445401.00</td>
                                    </tr>
                                    <tr>
                                     
                                        <td>10%</td>
                                        <td>445401.00</td>
                                        <td>445401.00</td>
                                    </tr>
                                    <tr>
                                        <td>10%</td>
                                        <td>445401.00</td>
                                        <td>445401.00</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                              
                        </div>
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
                    </div>
                    <div class="row" style="margin-top:10px;">
                        <div class="col-md-12 text-right">
                            <a href="" style="color:#fff;" class="btn btn-primary btn-uppercase">Close</a>
                            {{-- <button type="button" class="btn btn-primary btn-uppercase">Close</button> --}}
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
</script>
<script type="javascript">	
$(document).ready(function () {
	$('.datatableTbl').DataTable({
		responsive: true
	});
});
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
