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
    <!-- begin::page-header -->
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Project Activity</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="{{asset('public/assets/media/image/icons/home.png')}}" alt="">
                        <a href="#">Manage</a>
                    </li>
                    
                    <li class="breadcrumb-item active" aria-current="page">Project Activity</li>
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
						<a href="{{route('projectactivity.create')}}" class="btn btn-primary btn-sm rounded-0" data-toggle="tooltip" data-placement="top" title="Add">Add</a>
                        <!--<button type="button" class="btn btn-primary btn-sm rounded-0"  data-toggle="tooltip" data-placement="top" title="Add">
						<i class="fa fa-table"></i></button> 
						<button type="button" class="createModel btn btn-primary btn-sm rounded-0" data-toggle="tooltip" data-placement="top" title="Add">Show Modal</button>
						<button type="button" class="importModel btn btn-primary btn-sm rounded-0" data-toggle="tooltip" data-placement="top" title="Import Activity">Import Activity</button>							
						-->
				   </div>
                </div>
                <div class="card">
						<!-- Success message -->
						@if(Session::has('success'))
							<div class="alert alert-success">
								{{Session::get('success')}}
							</div>
						@endif
						<!-- Success message -->
						@if(Session::has('error'))
							<div class="alert alert-danger">
								{{Session::get('error')}}
							</div>
						@endif
                    <div class="card-body">
						 <div class="form-group row">
                                  <label for="inputPassword3" class="col-sm-2 col-form-label"><strong>Projects </strong>:</label>
                                  <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-md-10" style="padding-right:0px;">
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
                                                <img style="height:36px;" src="{{ url('public/assets/media/image/icons/navigate_pg.png') }}" alt="logo">
                                            </a>
                                        </div>
                                    </div>
                                   
                                   
                                  </div>
                                </div>
                        <table class="datatableTbl table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Org Name</th> 
								<th>Name</th>  
								<th>Mostlikely Cost</th>
								<th>Mostlikely Duration</th>
								<th>Pessimistic Cost</th>
								<th>Pessimistic Duration</th>								
                                <th>Is Active</th>  
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
							 @foreach($res as $key =>$items)
							 @php $item_id = Crypt::encrypt($items->uuid); @endphp
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$items->org_name}}</td> 
								<td>{{$items->name}}</td>  
								<td>{{$items->mostlikely_cost}}</td>
								<td>{{$items->mostlikely_duration}}</td>	
								<td>{{$items->pessimistic_cost}}</td>
								<td>{{$items->optimistic_cost}}</td>								
                                <td><div class="form-check">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input class="form-check-input" name="is_active" type="checkbox" id="gridCheck1" @if($items->is_active==true) checked @endif></div></td>                              
                                <td> 
									<a href="{{route('projectactivity.edit',$item_id)}}" class="btn btn-success btn-sm rounded-0" data-toggle="tooltip" data-placement="top" title="Edit">
									 <i class="fa fa-edit"></i></a>
                                    &nbsp;&nbsp; 
									<a href="{{route('projectactivity.remove',$item_id)}}" class="btn btn-danger btn-sm rounded-0"  data-toggle="tooltip" data-placement="top" title="Delete">
									<i class="fa fa-trash"></i></a> 
                                </td>
                            </tr>
							@endforeach                                              
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
<script src="{{ url('public/vendors/prism/prism.js') }}"></script>
@endsection
