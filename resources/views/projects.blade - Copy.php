@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Projects</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="{{asset('assets/media/image/icons/home.png')}}" alt="">
                        <a href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Projects</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row app-block">
            <div class="col-md-12 app-content">
                <div class="app-content-overlay"></div>
                
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a  href="{{url('dashboard/project/project_edit')}}"><img style="height:36px; margin-bottom:10px;" src="{{asset('assets/media/image/icons/add.png')}}" alt="logo"></a>
                    </div>
                </div>
                <div class="app-action">
                    <div class="action-left">
                        <ul class="list-inline">
                            <li class="list-inline-item mb-0 mt-10" style="margin-top: 13px;">
                                <p> All active(26) &nbsp; Active(24) &nbsp; Inactive(6) </p>
    
                            </li>
    
                        </ul>
                    </div>
                    <div class="action-right">
                        <form class="d-flex mr-3">
                            <a href="#" class="app-sidebar-menu-button btn btn-outline-light">
                                <i data-feather="menu" class="width-15 height-15"></i>
                            </a>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="search"
                                    aria-describedby="button-addon1">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-light" type="button" id="button-addon1">
                                        <img style="height: 15px; margin-top: -3px;" src="{{asset('assets/media/image/icons/search.png')}}" alt="">
                                    </button>
                                </div>
                            </div>
    
                        </form>
                        <div class="app-pager d-flex align-items-center">
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                  Sort by
                                </button>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item" href="#">Date</a>
                                  <a class="dropdown-item" href="#">Lowest</a>
                                  <a class="dropdown-item" href="#">Highest</a>
                                </div>
                              </div>
                        </div>
                    </div>
    
                </div>
                
                {{-- lopp --}}
                <div class="row"  style="border-radius: 0.5rem;margin-bottom: 1.875rem;position: relative;background: white;border: none; box-shadow: 0 3px 10px rgb(62 85 120 / 5%);display: flex;-webkit-box-pack: justify;justify-content: space-between;padding: 1.5rem;margin-right:0px; margin-left:0px;">
                    <div class="col-md-4 text-left">
                        <ul class="list-inline">
                            <li class="list-inline-item mb-0">
                                <p><strong style="font-size:20px;">Runwal Green(Mulund)</strong> &nbsp;&nbsp; 
                                    <img style="height: 12px; margin-top: -3px;" src="{{asset('assets/media/image/icons/online.png')}}" alt=""> Active</span> <br>
                                    Runwal Green(Mulund) - Vendor estimate only</p>
    
    
                            </li>
    
                        </ul>
                    </div>
                    <div class="col-md-4 text-center">
    
                    </div>
                    <div class="col-md-4 text-right">
    
                       <a href="#"> <p style="text-align: right;">
                        <strong>
                            <img style="height: 40px; margin-top: -3px;" src="{{asset('assets/media/image/icons/option.png')}}" alt="">
                                </strong></a><br>
                            Planned Cost : 3,76,32,673.00</p>
    
                    </div>
                    <div class="col-md-2 mt-20 text-left" style="margin-top:20px;">
    
                        <a href="#" data-toggle="modal" data-target="#pop_1">
                            <img style="height:20px;" src="{{ url('assets/media/image/icons/media.png') }}" alt="logo">
                        </a>
                        Run Simulation
    
    
    
                    </div>
                    <div class="col-md-8 mt-20 text-left" style="margin-top:20px;">
                        <p><strong> Mean</strong>: 3,74,67,392.00 &nbsp;&nbsp;&nbsp;<strong>Planned Cost</strong>: 3,74,67,392.00 &nbsp;&nbsp;&nbsp;<strong>Std</strong>: 3,74,6.00 &nbsp;&nbsp;&nbsp;<strong>Co-Var</strong>: 3,74,6.00 &nbsp;&nbsp;&nbsp;<strong>Z-Value</strong>: .34
                        </p>
                    </div>
                    <div class="col-md-2 mt-20 text-right" style="margin-top:20px;">
                        <a href="{{ url('dashboard/project/summary') }}">
                            <img style="height:20px;" src="{{ url('assets/media/image/icons/contract.png') }}" alt="logo">
                        </a>
                        Summary
                    </div>
    
                </div>
                {{-- /lopp --}}
              

                {{-- lopp --}}
                <div class="row"  style="border-radius: 0.5rem;margin-bottom: 1.875rem;position: relative;background: white;border: none; box-shadow: 0 3px 10px rgb(62 85 120 / 5%);display: flex;-webkit-box-pack: justify;justify-content: space-between;padding: 1.5rem;margin-right:0px; margin-left:0px;">
                    <div class="col-md-4 text-left">
                        <ul class="list-inline">
                            <li class="list-inline-item mb-0">
                                <p><strong style="font-size:20px;">Runwal Green(Mulund)</strong> &nbsp;&nbsp; 
                                    <img style="height: 12px; margin-top: -3px;" src="{{asset('assets/media/image/icons/online.png')}}" alt=""> Active</span> <br>
                                    Runwal Green(Mulund) - Vendor estimate only</p>
    
    
                            </li>
    
                        </ul>
                    </div>
                    <div class="col-md-4 text-center">
    
                    </div>
                    <div class="col-md-4 text-right">
    
                       <a href="#"> <p style="text-align: right;">
                        <strong>
                            <img style="height: 40px; margin-top: -3px;" src="{{asset('assets/media/image/icons/option.png')}}" alt="">
                                </strong></a><br>
                            Planned Cost : 3,76,32,673.00</p>
    
                    </div>
                    <div class="col-md-2 mt-20 text-left" style="margin-top:20px;">
    
                        <a href="#" data-toggle="modal" data-target="#pop_1">
                            <img style="height:20px;" src="{{ url('assets/media/image/icons/media.png') }}" alt="logo">
                        </a>
                        Run Simulation
    
    
    
                    </div>
                    <div class="col-md-8 mt-20 text-left" style="margin-top:20px;">
                        <p><strong> Mean</strong>: 3,74,67,392.00 &nbsp;&nbsp;&nbsp;<strong>Planned Cost</strong>: 3,74,67,392.00 &nbsp;&nbsp;&nbsp;<strong>Std</strong>: 3,74,6.00 &nbsp;&nbsp;&nbsp;<strong>Co-Var</strong>: 3,74,6.00 &nbsp;&nbsp;&nbsp;<strong>Z-Value</strong>: .34
                        </p>
                    </div>
                    <div class="col-md-2 mt-20 text-right" style="margin-top:20px;">
                        <a href="{{ url('dashboard/project/summary') }}">
                            <img style="height:20px;" src="{{ url('assets/media/image/icons/contract.png') }}" alt="logo">
                        </a>
                        Summary
                    </div>
    
                </div>
                {{-- /lopp --}}
              

                {{-- lopp --}}
                <div class="row"  style="border-radius: 0.5rem;margin-bottom: 1.875rem;position: relative;background: white;border: none; box-shadow: 0 3px 10px rgb(62 85 120 / 5%);display: flex;-webkit-box-pack: justify;justify-content: space-between;padding: 1.5rem;margin-right:0px; margin-left:0px;">
                    <div class="col-md-4 text-left">
                        <ul class="list-inline">
                            <li class="list-inline-item mb-0">
                                <p><strong style="font-size:20px;">Runwal Green(Mulund)</strong> &nbsp;&nbsp; 
                                    <img style="height: 12px; margin-top: -3px;" src="{{asset('assets/media/image/icons/offline.png')}}" alt=""> Active</span> <br>
                                    Runwal Green(Mulund) - Vendor estimate only</p>
    
    
                            </li>
    
                        </ul>
                    </div>
                    <div class="col-md-4 text-center">
    
                    </div>
                    <div class="col-md-4 text-right">
    
                       <a href="#"> <p style="text-align: right;">
                        <strong>
                            <img style="height: 40px; margin-top: -3px;" src="{{asset('assets/media/image/icons/option.png')}}" alt="">
                                </strong></a><br>
                            Planned Cost : 3,76,32,673.00</p>
    
                    </div>
                    <div class="col-md-2 mt-20 text-left" style="margin-top:20px;">
    
                        <a href="#" data-toggle="modal" data-target="#pop_1">
                            <img style="height:20px;" src="{{ url('assets/media/image/icons/media.png') }}" alt="logo">
                        </a>
                        Run Simulation
    
    
    
                    </div>
                    <div class="col-md-8 mt-20 text-left" style="margin-top:20px;">
                        <p><strong> Mean</strong>: 3,74,67,392.00 &nbsp;&nbsp;&nbsp;<strong>Planned Cost</strong>: 3,74,67,392.00 &nbsp;&nbsp;&nbsp;<strong>Std</strong>: 3,74,6.00 &nbsp;&nbsp;&nbsp;<strong>Co-Var</strong>: 3,74,6.00 &nbsp;&nbsp;&nbsp;<strong>Z-Value</strong>: .34
                        </p>
                    </div>
                    <div class="col-md-2 mt-20 text-right" style="margin-top:20px;">
                        <a href="{{ url('dashboard/project/summary') }}">
                            <img style="height:20px;" src="{{ url('assets/media/image/icons/contract.png') }}" alt="logo">
                        </a>
                        Summary
                    </div>
    
                </div>
                {{-- /lopp --}}
              

               
            </div>

    
        </div>

    </div>

@endsection

@section('script')

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
