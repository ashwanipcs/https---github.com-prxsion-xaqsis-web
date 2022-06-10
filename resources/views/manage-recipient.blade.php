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
            <h4>Recipient</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="{{asset('assets/media/image/icons/home.png')}}" alt="">
                        <a href="#">Manage</a>
                    </li>
                    
                    <li class="breadcrumb-item active" aria-current="page">Recipient</li>
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
                        <a data-toggle="modal" data-target="#recipient" href="#">
                            <img style="height:36px;" src="{{ url('assets/media/image/icons/add.png') }}" alt="logo">
                        </a>
                        &nbsp;&nbsp;
                        <a href="#">
                            <img style="height:36px;" src="{{ url('assets/media/image/icons/download.png') }}" alt="logo">
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
