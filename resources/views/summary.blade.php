@extends('layouts.app')

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
                                    <select class="form-control" id="exampleFormControlSelect1" >
                                        <option>Overall Project</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
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
                            <a href="{{route('dashboard.project')}}" style="color:#fff;" class="btn btn-primary btn-uppercase">Close</a>
                            {{-- <button type="button" class="btn btn-primary btn-uppercase">Close</button> --}}
                        </div>
                        
                    </div>

                </div>
            </div>
        </div>


    </div>

@endsection

@section('script')

<script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
<script src="{{ url('vendors/charts/apex/apexcharts.min.js') }}"></script>
<script src="{{ url('assets/js/examples/charts/apex.js') }}"></script>

    <!-- Apex chart -->
    <script src="{{ url('/vendors/charts/apex/apexcharts.min.js') }}"></script>

    <!-- Chartjs -->
    <script src="{{ url('/vendors/charts/chartjs/chart.min.js') }}"></script>

    <!-- Circle progress -->
    <script src="{{ url('/vendors/circle-progress/circle-progress.min.js') }}"></script>

    <!-- Datepicker -->
    <script src="{{ url('/vendors/datepicker/daterangepicker.js') }}"></script>

    <!-- Peity -->
    <script src="{{ url('/vendors/charts/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ url('/assets/js/examples/charts/peity.js') }}"></script>

    <!-- Dashboard scripts -->
    <script src="{{ url('/assets/js/examples/dashboard.js') }}"></script>
    <div class="colors"> <!-- To use theme colors with Javascript -->
        <div class="bg-primary"></div>
        <div class="bg-primary-bright"></div>
        <div class="bg-secondary"></div>
        <div class="bg-secondary-bright"></div>
        <div class="bg-info"></div>
        <div class="bg-info-bright"></div>
        <div class="bg-success"></div>
        <div class="bg-success-bright"></div>
        <div class="bg-danger"></div>
        <div class="bg-danger-bright"></div>
        <div class="bg-warning"></div>
        <div class="bg-warning-bright"></div>
    </div>

@endsection
