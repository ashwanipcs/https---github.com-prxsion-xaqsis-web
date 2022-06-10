@extends('layouts.app')

@section('head')
    <!-- DataTable -->
    <link rel="stylesheet" href="{{ url('vendors/dataTable/dataTables.min.css') }}" type="text/css">

    <!-- Prism -->
    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">
@endsection

@section('content')

    <!-- begin::page-header -->
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Settings</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="{{asset('assets/media/image/icons/home.png')}}" alt="">
                        <a href="#">Settings</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Pricing</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- end::page-header -->

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-12 text-right mb-3" >
                        <a href="#">
                            <img style="height:36px;" src="{{ url('assets/media/image/icons/energy-saving.png') }}" alt="logo">
                        </a>
                        
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <table id="example1" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>UUID</th>
                                <th>Project</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Nature</th>
                                <th>Is Active</th>
                                <th>Modified By</th>
                                <th>Modified On</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1.</td>
                                <td>Runwal Greens</td>
                                <td>C1010-Partitions</td>
                                <td>C1010-Partitions</td>
                                <td>Variable</td>
                                <td><div class="form-check">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input"  type="checkbox" id="gridCheck1"></div></td>
                                <td>Variable</td>
                                <td>Administrator</td>
                                <td> 
                                    <a href="#">
                                        <img style="height:20px;" src="{{ url('assets/media/image/icons/edit.png') }}" alt="logo">
                                    </a>
                                    &nbsp;&nbsp;
                                    <a href="#">
                                        <img style="height:20px;" src="{{ url('assets/media/image/icons/delete.png') }}" alt="logo">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1.</td>
                                <td>Runwal Greens</td>
                                <td>C1010-Partitions</td>
                                <td>C1010-Partitions</td>
                                <td>Variable</td>
                                <td><div class="form-check">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input"  type="checkbox" id="gridCheck1"></div></td>
                                <td>Variable</td>
                                <td>Administrator</td>
                                <td> 
                                    <a href="#">
                                        <img style="height:20px;" src="{{ url('assets/media/image/icons/edit.png') }}" alt="logo">
                                    </a>
                                    &nbsp;&nbsp;
                                    <a href="#">
                                        <img style="height:20px;" src="{{ url('assets/media/image/icons/delete.png') }}" alt="logo">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1.</td>
                                <td>Runwal Greens</td>
                                <td>C1010-Partitions</td>
                                <td>C1010-Partitions</td>
                                <td>Variable</td>
                                <td><div class="form-check">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input"  type="checkbox" id="gridCheck1"></div></td>
                                <td>Variable</td>
                                <td>Administrator</td>
                                <td> 
                                    <a href="#">
                                        <img style="height:20px;" src="{{ url('assets/media/image/icons/edit.png') }}" alt="logo">
                                    </a>
                                    &nbsp;&nbsp;
                                    <a href="#">
                                        <img style="height:20px;" src="{{ url('assets/media/image/icons/delete.png') }}" alt="logo">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1.</td>
                                <td>Runwal Greens</td>
                                <td>C1010-Partitions</td>
                                <td>C1010-Partitions</td>
                                <td>Variable</td>
                                <td><div class="form-check">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input"  type="checkbox" id="gridCheck1"></div></td>
                                <td>Variable</td>
                                <td>Administrator</td>
                                <td> 
                                    <a href="#">
                                        <img style="height:20px;" src="{{ url('assets/media/image/icons/edit.png') }}" alt="logo">
                                    </a>
                                    &nbsp;&nbsp;
                                    <a href="#">
                                        <img style="height:20px;" src="{{ url('assets/media/image/icons/delete.png') }}" alt="logo">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1.</td>
                                <td>Runwal Greens</td>
                                <td>C1010-Partitions</td>
                                <td>C1010-Partitions</td>
                                <td>Variable</td>
                                <td><div class="form-check">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input"  type="checkbox" id="gridCheck1"></div></td>
                                <td>Variable</td>
                                <td>Administrator</td>
                                <td> 
                                    <a href="#">
                                        <img style="height:20px;" src="{{ url('assets/media/image/icons/edit.png') }}" alt="logo">
                                    </a>
                                    &nbsp;&nbsp;
                                    <a href="#">
                                        <img style="height:20px;" src="{{ url('assets/media/image/icons/delete.png') }}" alt="logo">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1.</td>
                                <td>Runwal Greens</td>
                                <td>C1010-Partitions</td>
                                <td>C1010-Partitions</td>
                                <td>Variable</td>
                                <td><div class="form-check">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input"  type="checkbox" id="gridCheck1"></div></td>
                                <td>Variable</td>
                                <td>Administrator</td>
                                <td> 
                                    <a href="#">
                                        <img style="height:20px;" src="{{ url('assets/media/image/icons/edit.png') }}" alt="logo">
                                    </a>
                                    &nbsp;&nbsp;
                                    <a href="#">
                                        <img style="height:20px;" src="{{ url('assets/media/image/icons/delete.png') }}" alt="logo">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1.</td>
                                <td>Runwal Greens</td>
                                <td>C1010-Partitions</td>
                                <td>C1010-Partitions</td>
                                <td>Variable</td>
                                <td><div class="form-check">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input"  type="checkbox" id="gridCheck1"></div></td>
                                <td>Variable</td>
                                <td>Administrator</td>
                                <td> 
                                    <a href="#">
                                        <img style="height:20px;" src="{{ url('assets/media/image/icons/edit.png') }}" alt="logo">
                                    </a>
                                    &nbsp;&nbsp;
                                    <a href="#">
                                        <img style="height:20px;" src="{{ url('assets/media/image/icons/delete.png') }}" alt="logo">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1.</td>
                                <td>Runwal Greens</td>
                                <td>C1010-Partitions</td>
                                <td>C1010-Partitions</td>
                                <td>Variable</td>
                                <td><div class="form-check">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input"  type="checkbox" id="gridCheck1"></div></td>
                                <td>Variable</td>
                                <td>Administrator</td>
                                <td> 
                                    <a href="#">
                                        <img style="height:20px;" src="{{ url('assets/media/image/icons/edit.png') }}" alt="logo">
                                    </a>
                                    &nbsp;&nbsp;
                                    <a href="#">
                                        <img style="height:20px;" src="{{ url('assets/media/image/icons/delete.png') }}" alt="logo">
                                    </a>
                                </td>
                            </tr>
                           
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
            <div class="col-md-12">


                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="pricing-table m-b-20">
                                    <h6 class="m-b-20 text-uppercase font-size-11 text-center">Starter</h6>
                                    <h1 class="font-weight-bold text-center font-size-35">
                                        Free
                                    </h1>
                                    <ul class="m-b-30 m-t-30 list-group list-group-flush">
                                        <li class="list-group-item d-flex align-items-center">
                                                <span class="icon-block mr-3 bg-success icon-block-xs icon-block-floating">
                                                    <i data-feather="check" class="width-18 height-18"></i>
                                                </span>
                                            Email preview on air
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                                <span class="icon-block mr-3 bg-success icon-block-xs icon-block-floating">
                                                    <i data-feather="check" class="width-18 height-18"></i>
                                                </span>
                                            Spam testing and blocking
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                                <span class="icon-block mr-3 bg-danger icon-block-xs icon-block-floating">
                                                    <i data-feather="x" class="width-18 height-18"></i>
                                                </span>
                                            10 GB Space
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                                <span class="icon-block mr-3 bg-danger icon-block-xs icon-block-floating">
                                                    <i data-feather="x" class="width-18 height-18"></i>
                                                </span>
                                            50 user accounts
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                                <span class="icon-block mr-3 bg-danger icon-block-xs icon-block-floating">
                                                    <i data-feather="x" class="width-18 height-18"></i>
                                                </span>
                                            Free support for one years
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                                <span class="icon-block mr-3 bg-danger icon-block-xs icon-block-floating">
                                                    <i data-feather="x" class="width-18 height-18"></i>
                                                </span>
                                            Free upgrade for one year
                                        </li>
                                    </ul>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary">Start Trial</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success-bright">
                            <div class="card-body">
                                <div class="pricing-table selected-pricing-table m-b-20">
                                    <h6 class="m-b-20 text-uppercase font-size-11 text-center">Basic</h6>
                                    <h1 class="m-b-20 font-weight-bold text-center">
                                        <sup>
                                            <small>$</small>
                                        </sup>
                                        <span class="font-size-35">189</span>
                                        <sup>
                                            <small class="font-size-11 text-uppercase">yearly</small>
                                        </sup>
                                    </h1>
                                    <ul class="m-b-30 m-t-30 list-group list-group-flush">
                                        <li class="list-group-item bg-none d-flex align-items-center">
                                                <span class="icon-block mr-3 bg-success icon-block-xs icon-block-floating">
                                                    <i data-feather="check" class="width-18 height-18"></i>
                                                </span>
                                            Email preview on air
                                        </li>
                                        <li class="list-group-item bg-none d-flex align-items-center">
                                                <span class="icon-block mr-3 bg-success icon-block-xs icon-block-floating">
                                                    <i data-feather="check" class="width-18 height-18"></i>
                                                </span>
                                            Spam testing and blocking
                                        </li>
                                        <li class="list-group-item bg-none d-flex align-items-center">
                                                <span class="icon-block mr-3 bg-success icon-block-xs icon-block-floating">
                                                    <i data-feather="check" class="width-18 height-18"></i>
                                                </span>
                                            10 GB Space
                                        </li>
                                        <li class="list-group-item bg-none d-flex align-items-center">
                                                <span class="icon-block mr-3 bg-success icon-block-xs icon-block-floating">
                                                    <i data-feather="check" class="width-18 height-18"></i>
                                                </span>
                                            50 user accounts
                                        </li>
                                        <li class="list-group-item bg-none d-flex align-items-center">
                                                <span class="icon-block mr-3 bg-danger icon-block-xs icon-block-floating">
                                                    <i data-feather="x" class="width-18 height-18"></i>
                                                </span>
                                            Free support for one years
                                        </li>
                                        <li class="list-group-item bg-none d-flex align-items-center">
                                                <span class="icon-block mr-3 bg-danger icon-block-xs icon-block-floating">
                                                    <i data-feather="x" class="width-18 height-18"></i>
                                                </span>
                                            Free upgrade for one year
                                        </li>
                                    </ul>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary">Start Trial</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="pricing-table m-b-20">
                                    <h6 class="m-b-20 text-uppercase font-size-11 text-center">Premium</h6>
                                    <h1 class="m-b-20 font-weight-bold text-center">
                                        <sup>
                                            <small>$</small>
                                        </sup>
                                        <span class="font-size-35">289</span>
                                        <sup>
                                            <small class="text-muted font-size-11 text-uppercase">monthly</small>
                                        </sup>
                                    </h1>
                                    <ul class="m-b-30 m-t-30 list-group list-group-flush">
                                        <li class="list-group-item d-flex align-items-center">
                                                <span class="icon-block mr-3 bg-success icon-block-xs icon-block-floating">
                                                    <i data-feather="check" class="width-18 height-18"></i>
                                                </span>
                                            Email preview on air
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                                <span class="icon-block mr-3 bg-success icon-block-xs icon-block-floating">
                                                    <i data-feather="check" class="width-18 height-18"></i>
                                                </span>
                                            Spam testing and blocking
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                                <span class="icon-block mr-3 bg-success icon-block-xs icon-block-floating">
                                                    <i data-feather="check" class="width-18 height-18"></i>
                                                </span>
                                            10 GB Space
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                                <span class="icon-block mr-3 bg-success icon-block-xs icon-block-floating">
                                                    <i data-feather="check" class="width-18 height-18"></i>
                                                </span>
                                            50 user accounts
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                                <span class="icon-block mr-3 bg-success icon-block-xs icon-block-floating">
                                                    <i data-feather="check" class="width-18 height-18"></i>
                                                </span>
                                            Free support for one years
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                                <span class="icon-block mr-3 bg-danger icon-block-xs icon-block-floating">
                                                    <i data-feather="x" class="width-18 height-18"></i>
                                                </span>
                                            Free upgrade for one year
                                        </li>
                                    </ul>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary">Start Trial</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="pricing-table m-b-20">
                                    <h6 class="m-b-20 text-uppercase font-size-11 text-center">Premium</h6>
                                    <h1 class="m-b-20 font-weight-bold text-center">
                                        <sup>
                                            <small>$</small>
                                        </sup>
                                        <span class="font-size-35">289</span>
                                        <sup>
                                            <small class="text-muted font-size-11 text-uppercase">monthly</small>
                                        </sup>
                                    </h1>
                                    <ul class="m-b-30 m-t-30 list-group list-group-flush">
                                        <li class="list-group-item d-flex align-items-center">
                                                <span class="icon-block mr-3 bg-success icon-block-xs icon-block-floating">
                                                    <i data-feather="check" class="width-18 height-18"></i>
                                                </span>
                                            Email preview on air
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                                <span class="icon-block mr-3 bg-success icon-block-xs icon-block-floating">
                                                    <i data-feather="check" class="width-18 height-18"></i>
                                                </span>
                                            Spam testing and blocking
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                                <span class="icon-block mr-3 bg-success icon-block-xs icon-block-floating">
                                                    <i data-feather="check" class="width-18 height-18"></i>
                                                </span>
                                            10 GB Space
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                                <span class="icon-block mr-3 bg-success icon-block-xs icon-block-floating">
                                                    <i data-feather="check" class="width-18 height-18"></i>
                                                </span>
                                            50 user accounts
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                                <span class="icon-block mr-3 bg-success icon-block-xs icon-block-floating">
                                                    <i data-feather="check" class="width-18 height-18"></i>
                                                </span>
                                            Free support for one years
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                                <span class="icon-block mr-3 bg-danger icon-block-xs icon-block-floating">
                                                    <i data-feather="x" class="width-18 height-18"></i>
                                                </span>
                                            Free upgrade for one year
                                        </li>
                                    </ul>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary">Start Trial</button>
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
    <!-- DataTable -->
    <script src="{{ url('vendors/dataTable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('vendors/dataTable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('vendors/dataTable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('assets/js/examples/datatable.js') }}"></script>

    <!-- Prism -->
    <script src="{{ url('vendors/prism/prism.js') }}"></script>
@endsection
