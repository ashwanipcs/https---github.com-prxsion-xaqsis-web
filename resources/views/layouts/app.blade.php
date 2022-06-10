<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>XAQSIS</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('public/assets/media/image/favicon.png') }}" />
    <!-- Plugin styles -->
    <link rel="stylesheet" href="{{ url('public/vendors/bundle.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('public/vendors/k_style.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ url('public/vendors/toastr/toastr.css') }}" type="text/css">
    @yield('head')
    <!-- App styles -->
    <link rel="stylesheet" href="{{ url('public/assets/css/app.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('public/vendors/dataTable/dataTables.min.css')}}" type="text/css">
</head>
<style>
    .active_proj {
        border: 2px solid #1e3e87 !important;
    }
    .add_proj {
        width: 35px;
        height: 36px;
        border: 2px solid #898989;
        background: #898989;
        border-radius: 45px;
        color: white;
        margin-bottom: 5px;
    }
</style>
<body class="@yield('bodyClass')">
    <!-- begin::preloader-->
    <div class="preloader">
        <div class="preloader-icon"></div>
    </div>
    <!-- end::preloader -->
    <!-- begin::header -->
    <div class="header">
        <div>
            <ul class="navbar-nav">
                <!-- begin::navigation-toggler -->
                <li class="nav-item navigation-toggler">
                    <a href="#" class="nav-link" title="Hide navigation">
                        <i data-feather="arrow-left"></i>
                    </a>
                </li>
                <li class="nav-item navigation-toggler mobile-toggler">
                    <a href="#" class="nav-link" title="Show navigation">
                        <i data-feather="menu"></i>
                    </a>
                </li>
                <!-- end::navigation-toggler -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Apps</a>
                    <div class="dropdown-menu dropdown-menu-big">
                        <div class="p-3">
                            <div class="row row-xs">
                                <div class="col-6">
                                    <a href="{{route('projects')}}">
                                        <div class="p-3 border-radius-1 border text-center mb-3">
                                            <i class="width-23 height-23" data-feather="message-circle"></i>
                                            <div class="mt-2">Projects</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="{{route('summary.costanalysis')}}">
                                        <div class="p-3 border-radius-1 border text-center mb-3">
                                            <i class="width-23 height-23" data-feather="mail"></i>
                                            <div class="mt-2">Cost Analysis</div>
                                        </div>
                                    </a>
                                </div>
                                <!--<div class="col-6">
                                    <a href="{{route('pert-analysis')}}">
                                        <div class="p-3 border-radius-1 border text-center">
                                            <i class="width-23 height-23" data-feather="check-circle"></i>
                                            <div class="mt-2">PERT Analysis</div>
                                        </div>
                                    </a>
                                </div>-->
                                <div class="col-6">
                                    <a href="{{route('mcs-analysis')}}">
                                        <div class="p-3 border-radius-1 border text-center">
                                            <i class="width-23 height-23" data-feather="file"></i>
                                            <div class="mt-2">MCS Analysis</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div>
            <ul class="navbar-nav">
				<li class="dropdown">
                  <strong> Welcome: @if(Session::get('username')) {{Session::get('username')}} @endif
				  @if(Session::get('org_name')) ( {{Session::get('org_name')}} ) @endif
				  </strong>
                </li>
                <!-- begin::header minimize/maximize -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link" title="Fullscreen" data-toggle="fullscreen">
                        <i class="maximize" data-feather="maximize"></i>
                        <i class="minimize" data-feather="minimize"></i>
                    </a>
                </li>
                <!-- end::header minimize/maximize -->
                <!-- begin::header notification dropdown -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link nav-link-notify" title="Notifications" data-toggle="dropdown">
                        <i data-feather="bell"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                        <div class="p-4 text-center d-flex justify-content-between"
                            data-backround-image="{{ url('public/assets/media/image/image1.jpg') }}">
                            <h6 class="mb-0">Notifications</h6>
                            <small class="font-size-11 opacity-7">1 unread notifications</small>
                        </div>
                        <div>
                            <ul class="list-group list-group-flush">
                                <li>
                                    <a href="#" class="list-group-item d-flex hide-show-toggler">
                                        <div>
                                            <figure class="avatar avatar-sm m-r-15">
                                                <span
                                                    class="avatar-title bg-success-bright text-success rounded-circle">
                                                    <i class="ti-user"></i>
                                                </span>
                                            </figure>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="mb-0 line-height-20 d-flex justify-content-between">
                                                New customer registered
                                                <i title="Mark as read" data-toggle="tooltip"
                                                    class="hide-show-toggler-item fa fa-circle-o font-size-11"></i>
                                            </p>
                                            <span class="text-muted small">20 min ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="text-divider small pb-2 pl-3 pt-3">
                                    <span>Old notifications</span>
                                </li>
                                <li>
                                    <a href="#" class="list-group-item d-flex hide-show-toggler">
                                        <div>
                                            <figure class="avatar avatar-sm m-r-15">
                                                <span
                                                    class="avatar-title bg-warning-bright text-warning rounded-circle">
                                                    <i class="ti-package"></i>
                                                </span>
                                            </figure>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="mb-0 line-height-20 d-flex justify-content-between">
                                                New Order Recieved
                                                <i title="Mark as unread" data-toggle="tooltip"
                                                    class="hide-show-toggler-item fa fa-check font-size-11"></i>
                                            </p>
                                            <span class="text-muted small">45 sec ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="list-group-item d-flex align-items-center hide-show-toggler">
                                        <div>
                                            <figure class="avatar avatar-sm m-r-15">
                                                <span class="avatar-title bg-danger-bright text-danger rounded-circle">
                                                    <i class="ti-server"></i>
                                                </span>
                                            </figure>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="mb-0 line-height-20 d-flex justify-content-between">
                                                Server Limit Reached!
                                                <i title="Mark as unread" data-toggle="tooltip"
                                                    class="hide-show-toggler-item fa fa-check font-size-11"></i>
                                            </p>
                                            <span class="text-muted small">55 sec ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="list-group-item d-flex align-items-center hide-show-toggler">
                                        <div>
                                            <figure class="avatar avatar-sm m-r-15">
                                                <span class="avatar-title bg-info-bright text-info rounded-circle">
                                                    <i class="ti-layers"></i>
                                                </span>
                                            </figure>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="mb-0 line-height-20 d-flex justify-content-between">
                                                Apps are ready for update
                                                <i title="Mark as unread" data-toggle="tooltip"
                                                    class="hide-show-toggler-item fa fa-check font-size-11"></i>
                                            </p>
                                            <span class="text-muted small">Yesterday</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="p-2 text-right">
                            <ul class="list-inline small">
                                <li class="list-inline-item">
                                    <a href="#">Mark All Read</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <!-- end::header notification dropdown -->
            </ul>
            <!-- begin::mobile header toggler -->
            <ul class="navbar-nav d-flex align-items-center">
                <li class="nav-item header-toggler">
                    <a href="#" class="nav-link">
                        <i data-feather="arrow-down"></i>
                    </a>
                </li>
            </ul>
            <!-- end::mobile header toggler -->
        </div>
    </div>
    <!-- end::header -->
    <!-- begin::main -->
    <div id="main">
        <!-- begin::navigation -->
        <div class="navigation">
            <div class="navigation-menu-tab">                <div>
                    <div class="navigation-menu-tab-header" data-toggle="tooltip" title="@if(Session::get('username')) {{Session::get('username')}} @endif"
                        data-placement="right">
                        <a href="#" class="nav-link" data-toggle="dropdown" aria-expanded="false">
                            <figure class="avatar avatar-sm">
                                @if(file_exists(public_path().'/storage/users/'.Session::get('account_uuid').'/'.Session::get('account_uuid').'.jpg' ))
								<img src="{{url('public/storage/users/'.Session::get('account_uuid').'/'.Session::get('account_uuid').'.jpg' )}}" class="rounded-circle" alt="...">
								@else
								 <img src="{{ url('public/assets/media/image/user/women_avatar1.jpg') }}" class="rounded-circle"
                                    alt="avatar">
								@endif    
                            </figure>
                        </a>

                    </div>
                </div>
                <div class="flex-grow-1">
                    <ul>
                        <li>
                            <a @if(!request()->segment(1) || request()->segment(1) == 'dashboard') class="active"
                                @endif href="#" data-toggle="tooltip" data-placement="right" title="Dashboard"
                                data-nav-target="#dashboards">
                                <i data-feather="bar-chart-2"></i>
                            </a>
                        </li>
						<li>
                            <a @if(request()->segment(1) == 'projects') class="active" @endif href="#" data-toggle="tooltip"
                                data-placement="right" title="Projects" data-nav-target="#projects">
                                <i data-feather="layers"></i>
                            </a>
                        </li> 
                        <li>
                            <a @if(request()->segment(1) == 'recipients') class="active" @endif href="#" data-toggle="tooltip"
                                data-placement="right" title="Manage" data-nav-target="#manage">
                                <i data-feather="command"></i>
                            </a>
                        </li> 
                    </ul>
                </div>
                <div>
                    <ul>
                        <li>
                            <a @if(request()->segment(1) == 'pages') class="active" @endif href="#"
                                data-toggle="tooltip" data-placement="right" title="Settings" data-nav-target="#pages">
                                <i data-feather="settings"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" data-toggle="tooltip" data-placement="right" title="Logout">
                                <i data-feather="log-out"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- begin::navigation menu -->
            <div class="navigation-menu-body">
                <!-- begin::navigation-logo -->
                <div>
                    <div id="navigation-logo">
                        <a href="{{ url('/') }}">
                            <img class="logo" src="{{ url('public/assets/media/image/logo.png') }}" alt="logo">
                            <img class="logo-light" src="{{ url('public/assets/media/image/logo-light.png') }}" alt="light logo">
                        </a>
                    </div>
                </div>
                <!-- end::navigation-logo -->
                <div class="navigation-menu-group">
                    {{-- ==================DashBoard=========== --}}
                    <div id="dashboards">
                        <ul>
                            <li class="navigation-divider" style="padding: 0px 30px; !impirtant;">Dashboard</li>
							<li><a style="padding: 0px 30px; !impirtant;" @if(request()->segment(1) == 'dashboard') class="active" @endif href="{{ route('dashboard') }}">Dashboard</a></li>                            
							<li><a style="padding: 0px 30px; !impirtant;" @if(request()->segment(1) == 'summary') class="active" @endif href="{{route('summary.costanalysis')}}">Cost Analysis</a></li>                            
                            <li><a style="padding: 0px 30px; !impirtant;" @if(request()->segment(1) == 'mcs-analysis') class="active" @endif href="{{ route('mcs-analysis') }}">MCS Analysis</a></li>                            
                            
                        </ul>
                    </div>
                    {{-- ==================/DashBoard=========== --}}
					{{-- ==================Manage Projects=========== --}}
                    <div @if(request()->segment(1) == 'projects') class="open" @endif id="projects">
                        <ul>
                            <li class="navigation-divider" style="padding: 0px 30px; !impirtant;">Projects</li>
                             <li><a  style="padding: 0px 30px; !impirtant;" @if(request()->segment(1) == 'projects') class="active" @endif href="{{ route('projects') }}">Projects</a></li>
							
                        </ul>
                    </div>
                    {{-- ==================/Manage Peoject=========== --}}
					
                    {{-- ==================Manage=========== --}}
                    <div @if(request()->segment(1) == 'recipients') class="open" @endif id="manage">
                        <ul>
                            <li class="navigation-divider" style="padding: 0px 30px; !impirtant;">Manage</li>
                            <li><a style="padding: 0px 30px; !impirtant;" @if(request()->segment(1) == 'recipients') class="active" @endif href="{{ route('recipients') }}">&nbsp;&nbsp;&nbsp;Recipients</a></li>
							<li><a style="padding: 0px 30px; !impirtant;" @if(request()->segment(1) == 'activity') class="active" @endif href="{{ route('activity') }}">&nbsp;&nbsp;&nbsp;Activity</a></li>
							<li><a  style="padding: 0px 30px; !impirtant;" @if(request()->segment(1) == 'simulation') class="active" @endif href="{{ route('simulation') }}">&nbsp;&nbsp;&nbsp;Simulation</a></li>

                        </ul>
                    </div>
                    {{-- ==================/Manage=========== --}}
                    {{-- ==================Settings=========== --}}
                    <div @if(request()->segment(1) == 'settings') class="open" @endif id="pages">
                        <ul>
                            <li class="navigation-divider" style="padding: 0px 30px; !impirtant;">Settings</li>                         
                            <li><a style="padding: 0px 30px; !impirtant;" @if(request()->segment(1) == 'settings' && request()->segment(2) == 'pricing')
                                    class="active" @endif href="{{ route('settings.pricing') }}">Pricing</a></li>
                            <li><a style="padding: 0px 30px; !impirtant;" @if(request()->segment(1) == 'dashboard' && request()->segment(2) == 'profile')
                                    class="active" @endif href="{{ route('dashboard.profile') }}" title="Projects">Profile</a></li>
							<li><a style="padding: 0px 30px; !impirtant;" @if(request()->segment(1) == 'license' && request()->segment(2) == 'license')
                                    class="active" @endif href="{{ route('license') }}" title="License">License</a></li>
							<li><a style="padding: 0px 30px; !impirtant;" @if(request()->segment(1) == 'events' && request()->segment(2) == 'events')
                                    class="active" @endif href="{{ route('events') }}" title="License">Events</a></li>
							<li><a style="padding: 0px 30px; !impirtant;" @if(request()->segment(1) == 'accounts' && request()->segment(2) == 'accounts')
                                    class="active" @endif href="{{ route('accounts') }}" title="License">Accounts Manage</a></li>
							<li><a style="padding: 0px 30px; !impirtant;" @if(request()->segment(1) == 'logout') class="active" @endif  href="{{ route('logout') }}" >LOGOUT</a></li>
                            
                        </ul>
                    </div>
					
                    {{-- ==================/Settings=========== --}}
					{{-- ==================Settings=========== --}}
                    <div>
                        <ul>
                            <li class="navigation-divider" style="padding: 0px 30px; !impirtant;">LOGOUT</li>                        
                            
							  <li><a style="padding: 0px 30px; !impirtant;" @if(request()->segment(1) == 'logout') class="active" @endif  href="{{ route('logout') }}" >LOGOUT</a></li>
                            
                        </ul>
                    </div>
                    {{-- ==================/Settings=========== --}}
                </div>
            </div>
            <!-- end::navigation menu -->
        </div>
        <!-- end::navigation -->
        <!-- begin::main-content -->
        <div class="main-content">
            @yield('content')
            <!-- ===========Footer============== -->
            <footer>
                <div class="container-fluid">
                    <div>© 2022 <a href="/">XAQSIS</a></div>
                    <div>
                        <nav class="nav">
                            <a href="https://themeforest.net/licenses/standard" class="nav-link">Licenses</a>
                            <a href="#" class="nav-link">Change Log</a>
                            <a href="#" class="nav-link">Get Help</a>
                        </nav>
                    </div>
                </div>
            </footer>
            <!-- ===========/Footer============== -->
        </div>
        <!-- end::main-content -->
    </div>
    <!-- end::main -->
    <!-- Plugin scripts -->
    <script src="{{ url('public/vendors/bundle.js') }}"></script>
    <!-- Javascript -->
    <script src="{{ url('public/vendors/dataTable/jquery.dataTables.min.js') }}"></script>
    <!-- Bootstrap 4 and responsive compatibility -->
    <script src="{{ url('public/vendors/dataTable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('public/vendors/dataTable/dataTables.responsive.min.js') }}"></script>
	<script src="{{ url('public/vendors/toastr/toastr.js') }}"></script>
    @yield('script')
    <!-- App scripts -->
    <script src="{{ url('public/assets/js/app.min.js') }}"></script>
    <!-- Apex chart -->
    <script src="{{ url('public/vendors/charts/apex/apexcharts.min.js') }}"></script>
    <!-- Chartjs -->
    <script src="{{ url('public/vendors/charts/chartjs/chart.min.js') }}"></script>
    <!-- Circle progress -->
    <script src="{{ url('public/vendors/circle-progress/circle-progress.min.js') }}"></script>
    <!-- Datepicker -->
    <script src="{{ url('public/vendors/datepicker/daterangepicker.js') }}"></script>
    <!-- Peity -->
    <script src="{{ url('public/vendors/charts/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ url('public/assets/js/examples/charts/peity.js') }}"></script>
    <!-- Dashboard scripts -->
    <script src="{{ url('public/assets/js/examples/dashboard.js') }}"></script>
	
</body>

</html>