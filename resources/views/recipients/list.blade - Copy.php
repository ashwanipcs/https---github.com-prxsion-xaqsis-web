@extends('layouts.app')

@section('head')
    <!-- DataTable -->
    <link rel="stylesheet" href="{{ url('public/vendors/dataTable/dataTables.min.css') }}" type="text/css">
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
            <h4>Projects</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="{{asset('public/assets/media/image/icons/home.png')}}" alt="">
                        <a href="#">Manage</a>
                    </li>
                    
                    <li class="breadcrumb-item active" aria-current="page">Projects</li>
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
                        <a href="#" data-toggle="modal" data-target="#cost_head">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
                        <!--<button type="button" class="btn btn-primary btn-sm rounded-0"  data-toggle="tooltip" data-placement="top" title="Add">
						<i class="fa fa-table"></i></button>-->
						<button type="button" class="createModel btn btn-primary btn-sm rounded-0" data-toggle="tooltip" data-placement="top" title="Add">Show Modal</button>						
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
                        <table class="datatableTbl table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Name</th> 
								<th>Email</th>               
                                <th>Is Active</th>                                
                                <th>Modified On</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
							 @foreach($res as $key => $v)
							 @php $item_id = Crypt::encrypt($v->uuid); @endphp
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$v->name}}</td>  
								<td>{{$v->email}}</td>                                 
                                <td><div class="form-check">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input class="form-check-input"  type="checkbox" id="gridCheck1"></div></td>
                                <td>{{$v->modified_on}}</td>
                                <td> 
									<a href="#" data-id="{{$item_id}}@{{$v->name}}@{{$v->email}}" class="editModel btn btn-success btn-sm rounded-0" data-toggle="tooltip" data-placement="top" title="Edit">
									 <i class="fa fa-edit"></i></a>
                                    &nbsp;&nbsp; 
									<a href="{{route('recipients.remove',$item_id)}}" class="btn btn-danger btn-sm rounded-0"  data-toggle="tooltip" data-placement="top" title="Delete">
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
	
	<!-- Modal -->
	<div class="showModel modal fade" role="dialog">
		<div class="modal-dialog">
			<form name="frmProjects" method="post" action="{{ route('recipients.save') }}">
				<!-- CROSS Site Request Forgery Protection -->
				@csrf	
				<!-- Modal content-->
				<div class="modal-content">
					 <div class="modal-header">						
						<h4 class="modal-title"> <span class="txttitle"></span></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					 </div>
					 <div class="modal-body">
						<input type="text" name="project_uuid" class="form-control project_uuid">
						<div class="form-group row">
							<div class="col-sm-4"><strong>Name</strong>:</div>
							<div class="col-sm-8">
								<input type="text" name="name" class="form-control txtname" style="width: 70%" required >								
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-4"><strong>Email</strong>:</div>
							<div class="col-sm-8">
								<input type="text" name="email" class="form-control txtemail" style="width: 70%" required >								
							</div>
						</div>	
						<div class="form-group row">
							<div class="col-sm-4"><strong>Projects</strong>:</div>
							<div class="col-sm-8">
								<select name="project_uuid" class="form-control custom-select custom-select-sm" style="width: 70%">
								  <option selected>Open this select menu</option>
								 @foreach($projects as $key=>$val)
									 <option value="{{$val->uuid}}">{{$val->name}}</option>
								@endforeach
								</select>						
							</div>
						</div>	
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
						<button type="submit"  class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</form>	
		</div>
	</div> 
@endsection

@section('script')
<script>
$(document).ready(function(){
	$(".createModel").click(function(){
		$(".project_uuid").hide();
		$(".txttitle").show().text('Create Recipient');
		$(".showModel").modal({
			backdrop: 'static',
			keyboard: false
		});
	});
	
	$(".editModel").click(function(){
		$(".txttitle").show().text('Update Recipient');
		var dataVal = $(this).data("id");
		var fields  = dataVal.split('@');
		alert(fields);
		var id = fields[0];
		var name = fields[1];
		var email = fields[2];
		alert(name+ ""+email);
		$(".project_uuid").show().val(id);
		$(".txtname").val(name);
		$(".txtemail").val(email);
		
		$(".showModel").modal({
			backdrop: 'static',
			keyboard: false
		});
	});
});
</script>

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
