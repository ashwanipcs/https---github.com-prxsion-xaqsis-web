<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>XAQSIS</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo e(url('public/assets/media/image/favicon.png')); ?>" />
    <!-- Plugin styles -->
    <link rel="stylesheet" href="<?php echo e(url('public/vendors/bundle.css')); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo e(url('public/vendors/k_style.css')); ?>" type="text/css">
	<link rel="stylesheet" href="<?php echo e(url('public/vendors/toastr/toastr.css')); ?>" type="text/css">
    <?php echo $__env->yieldContent('head'); ?>
    <!-- App styles -->
    <link rel="stylesheet" href="<?php echo e(url('public/assets/css/app.min.css')); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo e(url('public/vendors/dataTable/dataTables.min.css')); ?>" type="text/css">
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
<body class="<?php echo $__env->yieldContent('bodyClass'); ?>">
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
                                    <a href="<?php echo e(route('projects')); ?>">
                                        <div class="p-3 border-radius-1 border text-center mb-3">
                                            <i class="width-23 height-23" data-feather="message-circle"></i>
                                            <div class="mt-2">Projects</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="<?php echo e(route('summary.costanalysis')); ?>">
                                        <div class="p-3 border-radius-1 border text-center mb-3">
                                            <i class="width-23 height-23" data-feather="mail"></i>
                                            <div class="mt-2">Cost Analysis</div>
                                        </div>
                                    </a>
                                </div>
                                <!--<div class="col-6">
                                    <a href="<?php echo e(route('pert-analysis')); ?>">
                                        <div class="p-3 border-radius-1 border text-center">
                                            <i class="width-23 height-23" data-feather="check-circle"></i>
                                            <div class="mt-2">PERT Analysis</div>
                                        </div>
                                    </a>
                                </div>-->
                                <div class="col-6">
                                    <a href="<?php echo e(route('mcs-analysis')); ?>">
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
                  <strong> Welcome: <?php if(Session::get('username')): ?> <?php echo e(Session::get('username')); ?> <?php endif; ?>
				  <?php if(Session::get('org_name')): ?> ( <?php echo e(Session::get('org_name')); ?> ) <?php endif; ?>
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
                            data-backround-image="<?php echo e(url('public/assets/media/image/image1.jpg')); ?>">
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
                    <div class="navigation-menu-tab-header" data-toggle="tooltip" title="<?php if(Session::get('username')): ?> <?php echo e(Session::get('username')); ?> <?php endif; ?>"
                        data-placement="right">
                        <a href="#" class="nav-link" data-toggle="dropdown" aria-expanded="false">
                            <figure class="avatar avatar-sm">
                                <?php if(file_exists(public_path().'/storage/users/'.Session::get('account_uuid').'/'.Session::get('account_uuid').'.jpg' )): ?>
								<img src="<?php echo e(url('public/storage/users/'.Session::get('account_uuid').'/'.Session::get('account_uuid').'.jpg' )); ?>" class="rounded-circle" alt="...">
								<?php else: ?>
								 <img src="<?php echo e(url('public/assets/media/image/user/women_avatar1.jpg')); ?>" class="rounded-circle"
                                    alt="avatar">
								<?php endif; ?>    
                            </figure>
                        </a>

                    </div>
                </div>
                <div class="flex-grow-1">
                    <ul>
                        <li>
                            <a <?php if(!request()->segment(1) || request()->segment(1) == 'dashboard'): ?> class="active"
                                <?php endif; ?> href="#" data-toggle="tooltip" data-placement="right" title="Dashboard"
                                data-nav-target="#dashboards">
                                <i data-feather="bar-chart-2"></i>
                            </a>
                        </li>
						<li>
                            <a <?php if(request()->segment(1) == 'projects'): ?> class="active" <?php endif; ?> href="#" data-toggle="tooltip"
                                data-placement="right" title="Projects" data-nav-target="#projects">
                                <i data-feather="layers"></i>
                            </a>
                        </li> 
                        <li>
                            <a <?php if(request()->segment(1) == 'recipients'): ?> class="active" <?php endif; ?> href="#" data-toggle="tooltip"
                                data-placement="right" title="Manage" data-nav-target="#manage">
                                <i data-feather="command"></i>
                            </a>
                        </li> 
                    </ul>
                </div>
                <div>
                    <ul>
                        <li>
                            <a <?php if(request()->segment(1) == 'pages'): ?> class="active" <?php endif; ?> href="#"
                                data-toggle="tooltip" data-placement="right" title="Settings" data-nav-target="#pages">
                                <i data-feather="settings"></i>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('logout')); ?>" data-toggle="tooltip" data-placement="right" title="Logout">
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
                        <a href="<?php echo e(url('/')); ?>">
                            <img class="logo" src="<?php echo e(url('public/assets/media/image/logo.png')); ?>" alt="logo">
                            <img class="logo-light" src="<?php echo e(url('public/assets/media/image/logo-light.png')); ?>" alt="light logo">
                        </a>
                    </div>
                </div>
                <!-- end::navigation-logo -->
                <div class="navigation-menu-group">
                    
                    <div id="dashboards">
                        <ul>
                            <li class="navigation-divider" style="padding: 0px 30px; !impirtant;">Dashboard</li>
							<li><a style="padding: 0px 30px; !impirtant;" <?php if(request()->segment(1) == 'dashboard'): ?> class="active" <?php endif; ?> href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>                            
							<li><a style="padding: 0px 30px; !impirtant;" <?php if(request()->segment(1) == 'summary'): ?> class="active" <?php endif; ?> href="<?php echo e(route('summary.costanalysis')); ?>">Cost Analysis</a></li>                            
                            <li><a style="padding: 0px 30px; !impirtant;" <?php if(request()->segment(1) == 'mcs-analysis'): ?> class="active" <?php endif; ?> href="<?php echo e(route('mcs-analysis')); ?>">MCS Analysis</a></li>                            
                            
                        </ul>
                    </div>
                    
					
                    <div <?php if(request()->segment(1) == 'projects'): ?> class="open" <?php endif; ?> id="projects">
                        <ul>
                            <li class="navigation-divider" style="padding: 0px 30px; !impirtant;">Projects</li>
                             <li><a  style="padding: 0px 30px; !impirtant;" <?php if(request()->segment(1) == 'projects'): ?> class="active" <?php endif; ?> href="<?php echo e(route('projects')); ?>">Projects</a></li>
							
                        </ul>
                    </div>
                    
					
                    
                    <div <?php if(request()->segment(1) == 'recipients'): ?> class="open" <?php endif; ?> id="manage">
                        <ul>
                            <li class="navigation-divider" style="padding: 0px 30px; !impirtant;">Manage</li>
                            <li><a style="padding: 0px 30px; !impirtant;" <?php if(request()->segment(1) == 'recipients'): ?> class="active" <?php endif; ?> href="<?php echo e(route('recipients')); ?>">&nbsp;&nbsp;&nbsp;Recipients</a></li>
							<li><a style="padding: 0px 30px; !impirtant;" <?php if(request()->segment(1) == 'activity'): ?> class="active" <?php endif; ?> href="<?php echo e(route('activity')); ?>">&nbsp;&nbsp;&nbsp;Activity</a></li>
							<li><a  style="padding: 0px 30px; !impirtant;" <?php if(request()->segment(1) == 'simulation'): ?> class="active" <?php endif; ?> href="<?php echo e(route('simulation')); ?>">&nbsp;&nbsp;&nbsp;Simulation</a></li>

                        </ul>
                    </div>
                    
                    
                    <div <?php if(request()->segment(1) == 'settings'): ?> class="open" <?php endif; ?> id="pages">
                        <ul>
                            <li class="navigation-divider" style="padding: 0px 30px; !impirtant;">Settings</li>                         
                            <li><a style="padding: 0px 30px; !impirtant;" <?php if(request()->segment(1) == 'settings' && request()->segment(2) == 'pricing'): ?>
                                    class="active" <?php endif; ?> href="<?php echo e(route('settings.pricing')); ?>">Pricing</a></li>
                            <li><a style="padding: 0px 30px; !impirtant;" <?php if(request()->segment(1) == 'dashboard' && request()->segment(2) == 'profile'): ?>
                                    class="active" <?php endif; ?> href="<?php echo e(route('dashboard.profile')); ?>" title="Projects">Profile</a></li>
							<li><a style="padding: 0px 30px; !impirtant;" <?php if(request()->segment(1) == 'license' && request()->segment(2) == 'license'): ?>
                                    class="active" <?php endif; ?> href="<?php echo e(route('license')); ?>" title="License">License</a></li>
							<li><a style="padding: 0px 30px; !impirtant;" <?php if(request()->segment(1) == 'events' && request()->segment(2) == 'events'): ?>
                                    class="active" <?php endif; ?> href="<?php echo e(route('events')); ?>" title="License">Events</a></li>
							<li><a style="padding: 0px 30px; !impirtant;" <?php if(request()->segment(1) == 'accounts' && request()->segment(2) == 'accounts'): ?>
                                    class="active" <?php endif; ?> href="<?php echo e(route('accounts')); ?>" title="License">Accounts Manage</a></li>
							<li><a style="padding: 0px 30px; !impirtant;" <?php if(request()->segment(1) == 'logout'): ?> class="active" <?php endif; ?>  href="<?php echo e(route('logout')); ?>" >LOGOUT</a></li>
                            
                        </ul>
                    </div>
					
                    
					
                    <div>
                        <ul>
                            <li class="navigation-divider" style="padding: 0px 30px; !impirtant;">LOGOUT</li>                        
                            
							  <li><a style="padding: 0px 30px; !impirtant;" <?php if(request()->segment(1) == 'logout'): ?> class="active" <?php endif; ?>  href="<?php echo e(route('logout')); ?>" >LOGOUT</a></li>
                            
                        </ul>
                    </div>
                    
                </div>
            </div>
            <!-- end::navigation menu -->
        </div>
        <!-- end::navigation -->
        <!-- begin::main-content -->
        <div class="main-content">
            <?php echo $__env->yieldContent('content'); ?>
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
    <script src="<?php echo e(url('public/vendors/bundle.js')); ?>"></script>
    <!-- Javascript -->
    <script src="<?php echo e(url('public/vendors/dataTable/jquery.dataTables.min.js')); ?>"></script>
    <!-- Bootstrap 4 and responsive compatibility -->
    <script src="<?php echo e(url('public/vendors/dataTable/dataTables.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/vendors/dataTable/dataTables.responsive.min.js')); ?>"></script>
	<script src="<?php echo e(url('public/vendors/toastr/toastr.js')); ?>"></script>
    <?php echo $__env->yieldContent('script'); ?>
    <!-- App scripts -->
    <script src="<?php echo e(url('public/assets/js/app.min.js')); ?>"></script>
    <!-- Apex chart -->
    <script src="<?php echo e(url('public/vendors/charts/apex/apexcharts.min.js')); ?>"></script>
    <!-- Chartjs -->
    <script src="<?php echo e(url('public/vendors/charts/chartjs/chart.min.js')); ?>"></script>
    <!-- Circle progress -->
    <script src="<?php echo e(url('public/vendors/circle-progress/circle-progress.min.js')); ?>"></script>
    <!-- Datepicker -->
    <script src="<?php echo e(url('public/vendors/datepicker/daterangepicker.js')); ?>"></script>
    <!-- Peity -->
    <script src="<?php echo e(url('public/vendors/charts/peity/jquery.peity.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/js/examples/charts/peity.js')); ?>"></script>
    <!-- Dashboard scripts -->
    <script src="<?php echo e(url('public/assets/js/examples/dashboard.js')); ?>"></script>
	
</body>

</html><?php /**PATH C:\xampp\htdocs\laravel_demo_app\resources\views/layouts/app.blade.php ENDPATH**/ ?>