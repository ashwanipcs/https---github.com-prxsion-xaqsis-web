@extends('layouts.app')

@section('head')
   <!-- Prism -->
    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css"> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
	 
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
                        <img style="height: 12px; margin-top: -3px;" src="{{asset('assets/media/image/icons/home.png')}}" alt="">
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
                        <button type="button" class="addModel btn btn-secondary btn-floating" data-toggle="tooltip" data-placement="top" title="Add">
						 <i class="ti-plus"></i></button>
                    </div>
                </div>
                <div class="card">						
                    <div class="card-body">
                        <table  class="table table-striped table-bordered showDatatable">
                            <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Name</th>               
                                <th>Is Active</th>                                
                                <th>Modified On</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
							@foreach($res as $key=>$item)
							@php $item_id = Crypt::encrypt($item->uuid); @endphp
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->name}}</td>                                 
                                <td><div class="form-check">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input class="form-check-input"  type="checkbox" id="gridCheck1"></div></td>
                                <td>{{$item->modified_on}}</td>
                                <td> 
									<a href="javascript: void(0); return false;" data-id="{{$item_id}}xaqsis{{$item->name}}" class="editModel btn btn-success btn-floating" data-toggle="tooltip" data-placement="top" title="Edit">
									 <i class="fa fa-edit"></i></a> 
									<a href="javascript:void(0); return false;"  data-id="{{route('projects.remove',$item_id)}}" class="confirmDelete btn btn-danger btn-floating"  data-toggle="tooltip" data-placement="top" title="Delete">
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
	
	<!-- .modal -->
	<div class="modal fade showModel">
		<div class="modal-dialog">
			<form name="frmProjects" method="post" action="{{ route('projects.save') }}">
			<!-- CROSS Site Request Forgery Protection -->
			@csrf	
				<div class="modal-content">
					<div class="modal-header">					 
						<h4 class="modal-title">Create Project</h4> 
						<button type="button" class="close" data-dismiss="modal">×</button>								
					</div> 
					<div class="modal-body">
						<div class="form-group row">
							<div class="col-sm-4"><strong>Name</strong>:</div>							 
							<div class="col-sm-8">
								<input type="hidden" name="editid" class="form-control edit_id" style="display:none;">
								<input type="text" name="name" class="form-control txtname" style="width: 70%" required >								 
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-4"><strong>Is Active</strong>:</div>
							<div class="col-sm-8">
								<div class="form-check">
									<input name="is_active" class="form-check-input" type="checkbox" id="gridCheck1" checked="checked">
								</div>
							</div>
						</div>		
					</div>   
					<div class="modal-footer">
						<button type="submit"  class="btn btn-primary btn-rounded">Save changes</button>
						<button type="button" class="btn btn-primary btn-rounded" data-dismiss="modal">Close</button>								                              
					</div>
				</div> 
			</form>
		</div>                                          
	</div>	 
@endsection

@section('script')
    <!-- DataTable -->
    <script>
	$(function () {
		$('[data-toggle="tooltip"]').tooltip();
	});
	
	$(document).ready(function () {
		$('.showDatatable').DataTable({
			responsive: true
		});
	});
	
	</script>
	<script>
$(document).ready(function(){
	$('.addModel').click(function(){
		$('.showModel').modal({
			backdrop: 'static',
			keyboard: false
		});
	});
});
$(document).ready(function(){
	$('.editModel').on('click',function(){		 
		var data = $(this).data("id");		 
		var fields = data.split('xaqsis');

		var id = fields[0];
		var name = fields[1];
		$(".edit_id").show().val(id);
		$(".txtname").val(name);
		$('.showModel').modal({
			backdrop: 'static',
			keyboard: false
		});
		 
	});
});

</script>
<script>
  @if(Session::has('success'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
	"positionClass": 'toast-top-center'
  }
  		toastr.success("{{Session::get('success')}}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
	"positionClass": 'toast-top-center'
  }
  		toastr.error("{{Session::get('error')}}");
  @endif  
  
  
  $(document).ready(function(){
	 $(".confirmDelete").click(function(){
		 var url = $(this).data("id");	
		 //alert(url);
		  toastr.success("<button type='button' class='confirmationRevertYes btn clear'>Yes</button><button type='button' class='confirmationRevertNo btn clear'>No</button>",'Are you sure you want to delete this item?',
		{
			  closeButton: true,
			  allowHtml: true,
			  onShown: function (toast) {
				  $(".confirmationRevertYes").click(function(){
					location.replace(url); 
				  });
				}
		});
	 }); 
  });
</script>
    <!-- Prism -->
	  
    <script src="{{ url('vendors/prism/prism.js') }}"></script>
@endsection
