@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Projects</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="dashboard/analytics">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ url('dashboard/project') }}">Project</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">edit/new</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="padding: 28px;">
                    

                    <div class="row">
                        
                        <div class="col-md-12" style="margin-top:14px;">
                            <form>
                                <div class="form-group row">
                                  <label for="inputEmail3" class="col-sm-2 col-form-label"> <strong>Name</strong></label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" style="width: 70%" id="inputEmail3" >
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="inputPassword3" class="col-sm-2 col-form-label"><strong>Description</strong></label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control"  style="width: 70%" id="inputPassword3">
                                  </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2"><strong>Is Active</strong>:</div>
                                    <div class="col-sm-10">
                                      <div class="form-check">
                                        <input class="form-check-input"  type="checkbox" id="gridCheck1">
                                       
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label"><strong>Trails</strong>:</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-md-4">
                                                
                                                <input type="text" class="form-control"  id="inputPassword3" >
                                            </div>
                                            <div class="col-md-6">
                                                <p>
                                                    (Valid Trials between 10-10000)

                                                </p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                  </div>
                                <div class="form-group row">
                                  <label for="inputPassword3" class="col-sm-2 col-form-label"><strong>Recipient </strong>:</label>
                                  <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-md-9" style="padding-right:0px;">
                                            <select class="form-control" id="exampleFormControlSelect1">
                                                <option>Overall Project</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                              </select>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="#"  style="font-size:25px;">
                                                <img style="height:36px;" src="{{ url('assets/media/image/icons/navigate_pg.png') }}" alt="logo">
                                            </a>
                                        </div>
                                        <div class="col-md-1">
                                            <a href="#" style="font-size:25px;">
                                                <a href="{{url('dashboard/project/project_edit')}}"><img style="height:36px;" src="{{ url('assets/media/image/icons/add.png')}}" alt="logo"></a>
                                                {{-- <a href="{{url('dashboards/project/project_edit')}}"><i data-feather="plus" class="add_proj"></a></i> --}}
                                                {{-- <img style="height:36px;" src="{{ url('assets/media/image/icons/navigate_pg.png') }}" alt="logo"> --}}
                                            </a>
                                        </div>
                                    </div>
                                   
                                   
                                  </div>
                                </div>
                              </form>
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body" style="padding:0px;">
                                    <table id="example1" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Cost Head</th>
                                            <th>Nature</th>
                                            <th>MLE</th>
                                            <th>Ratio</th>
                                            <th>Positive Limit</th>
                                            <th>Negative Limit</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><select class="form-control" id="exampleFormControlSelect1">
                                                <option>C1010-Partitions</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                              </select></td>
                                            <td>Variable</td>
                                            <td>519473.68</td>
                                            <td>0.11</td>
                                            <td>-0.1</td>
                                            <td>0.30</td>
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
                                            <td><select class="form-control" id="exampleFormControlSelect1">
                                                <option>C1010-Partitions</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                              </select></td>
                                            <td>Variable</td>
                                            <td>519473.68</td>
                                            <td>0.11</td>
                                            <td>-0.1</td>
                                            <td>0.30</td>
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
                                            <td><select class="form-control" id="exampleFormControlSelect1">
                                                <option>C1010-Partitions</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                              </select></td>
                                            <td>Variable</td>
                                            <td>519473.68</td>
                                            <td>0.11</td>
                                            <td>-0.1</td>
                                            <td>0.30</td>
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
                                            <td><select class="form-control" id="exampleFormControlSelect1">
                                                <option>C1010-Partitions</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                              </select></td>
                                            <td>Variable</td>
                                            <td>519473.68</td>
                                            <td>0.11</td>
                                            <td>-0.1</td>
                                            <td>0.30</td>
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
                                            <td><select class="form-control" id="exampleFormControlSelect1">
                                                <option>C1010-Partitions</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                              </select></td>
                                            <td>Variable</td>
                                            <td>519473.68</td>
                                            <td>0.11</td>
                                            <td>-0.1</td>
                                            <td>0.30</td>
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
                                            <td><select class="form-control" id="exampleFormControlSelect1">
                                                <option>C1010-Partitions</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                              </select></td>
                                            <td>Variable</td>
                                            <td>519473.68</td>
                                            <td>0.11</td>
                                            <td>-0.1</td>
                                            <td>0.30</td>
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
                       
                        <div class="col-md-12  text-right">
                            <div class="row">
                                <div class="col-md-9 text-right">
                                    
                                </div>
                                <div class="col-md-1 text-right">
                                    <a class="btn btn-primary btn-uppercase" style="color:#fff;" href="{{route('dashboard.project')}}">Save</a>
                                    {{-- <button type="button" class="btn btn-primary btn-uppercase">Save</button> --}}
                                </div>
                                <div class="col-md-1 text-right">
                                    <button type="button" class="btn btn-primary btn-uppercase">Cancel</button>
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



<!-- Bootstrap 4 and responsive compatibility -->
<script src="vendors/dataTable/dataTables.bootstrap4.min.js"></script>
<script src="vendors/dataTable/dataTables.responsive.min.js"></script>

    

@endsection
