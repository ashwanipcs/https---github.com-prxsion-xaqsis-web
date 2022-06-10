@extends('layouts.app')
@section('head')
 <!-- Prism -->
<link rel="stylesheet" href="{{ url('public/vendors/prism/prism.css') }}" type="text/css">
 <!-- Select2 -->
<link rel="stylesheet" href="{{ url('public/vendors/select2/css/select2.min.css') }}" type="text/css">
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
                <div class="card" style="padding: 28px;"> 
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
				<form name="projectactivity" id="frmPAid" method="post" action="{{ route('projectactivity.save') }}">
				<!-- CROSS Site Request Forgery Protection -->
				@csrf	
                    <div class="row">  						
                        <div class="col-md-12" style="margin-top:14px;">                            
							<div class="form-group row">
							  <label for="inputPassword3" class="col-sm-2 col-form-label"><strong>Project1 </strong>:</label>
							  <div class="col-sm-10">
								<div class="row">
									<div class="col-md-10" style="padding-right:0px;">
											@foreach($projects as $p=>$project)
											@if($project->uuid==$project_uuid)
											<input type="hidden" name="project_uuid" value="{{$project->uuid}}">
											<strong>{{$project->name}}</strong>
											 @endif
										   @endforeach										   
									</div>                                         
								</div>                                   
							  </div>
							</div>                     
                        </div>
                        <div class="col-md-12">
							 <div class="form-group row">
                                  <label for="inputPassword3" class="col-sm-2 col-form-label"><strong> </strong>:</label>
                                  <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-md-9" style="padding-right:0px;">                                            
                                        </div>
                                        <div class="col-md-2">                                           
                                        </div>
                                        <div class="col-md-1">
                                            <a href="javascript:void(0);" style="font-size:25px;" class="addCF">
                                                <img style="height:36px;" src="{{ url('public/assets/media/image/icons/add.png')}}" alt="logo">                                             
                                            </a>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            <div class="card">
                                <div class="card-body" style="padding:0px;">                                   
					
						<table class="form-table datatableTbl table table-striped table-bordered" id="customFields" style="width:100%">
							<!--<a href="javascript:void(0);" class="addCF">Add</a>-->
							<tr valign="top">
								<th style="width:10%">Activity</th>
								<th style="width:5%">Activity Multiple</th>
								<th style="width:10%">Mostlikely Cost</th>
								<th style="width:10%">Optimistic Cost</th>                                           
								<th style="width:15%">Pessimistic Cost</th>
								<th style="width:5%">Mostlikely Duration</th>
								<th style="width:5%">Optimistic Duration</th>
								<th style="width:5%">Pessimistic Duration</th>
								
								<th style="width:5%">Active</th>
								<th style="width:10%">Actions</th>
								</tr>
								 @if($projectactivity)
									@foreach($projectactivity as $key => $items)
									@php $item_id = Crypt::encrypt($items->uuid); @endphp
											<tr>
											<td style="width:50%"> 
												<select name="activity_uuid[]" class="form-control addactivity" id="exampleFormControlSelect1">
													<option value="0">-- Select Activity--</option>
												   @foreach($activity as $k=>$val)																
														<option value="{{$val->uuid}}" @if($val->uuid == $items->activity_uuid) selected @else  @endif>{{$val->name}}</option>					    
												   @endforeach                                                
											  </select>
											 </td>
											 <td style="width:10%"> 
												<select name="predecessors[]" class="js-example-basic-single" multiple required>
													<option value="0">-- Select Activity--</option>
												   @foreach($activity as $k1=>$val1)																
														<option value="{{$val1->uuid}}" @if($val1->uuid == $items->activity_uuid) selected @else  @endif>{{$val1->name}}</option>					    
												   @endforeach                                                
											  </select>
											 </td>
											<td ><input type="text" name="mostlikely_cost[]" class="form-control" value="{{$items->mostlikely_cost}}"></td>
											<td ><input type="text" name="optimistic_cost[]" class="form-control" value="{{$items->optimistic_cost}}"></td>											
											<td><input type="text" name="pessimistic_cost[]" class="form-control" value="{{$items->pessimistic_cost}}"></td>
											<td ><input type="text" name="mostlikely_duration[]" class="form-control" value="{{$items->mostlikely_duration}}"></td>											
											<td ><input type="text" name="optimistic_duration[]" class="form-control" value="{{$items->optimistic_duration}}"></td>
											<td ><input type="text" name="pessimistic_duration[]" class="form-control" value="{{$items->pessimistic_duration}}"></td>
											
											<td style="float: right;margin: 11px 9px 9px 11px;">
											 @foreach($activity as $k12=>$val12)
												<input name="uuid[]" class="form-check-input" type="hidden" value="{{$val12->uuid}}">
											  @endforeach 
											<input name="is_active" class="form-check-input" type="checkbox" id="gridCheck1" @if($items->is_active==1) checked @else "" @endif></td>													 
											<td> 
												  <a href="{{route('projectactivity.remove', $items->uuid)}}">
												 <img style="height:20px;" src="{{ url('public/assets/media/image/icons/delete.png') }}" alt="logo">
												</a>
											</td>
										</tr> 
								@endforeach
								@else	
									 
								@endif
							</table>
							</div></div>
								<div class="col-md-12  text-right">
									<div class="row">
										<div class="col-md-9 text-right">                                    
										</div>
										<div class="col-md-1 text-right">                                  	 
											<button type="submit"  class="btn btn-primary btn-uppercase">Save</button>									
										</div>
										<div class="col-md-1 text-right">
											<button type="button" class="btn btn-primary btn-uppercase">Cancel</button>
										</div>
									</div>
								</div>						 
							</div>
							
					</form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
<!-- Select2 -->
<script src="{{ url('public/vendors/select2/js/select2.min.js') }}"></script>
<script src="{{ url('public/assets/js/examples/select2.js') }}"></script>
<SCRIPT language="javascript">
$(document).ready(function(){
	$(".addCF").click(function(){
				 
				var htmlOpt ='<tr><td style="width:50%"> ';
				htmlOpt +='<select name="activity_uuid[]" class="form-control addactivity" id="exampleFormControlSelect1" required>';
				htmlOpt +=' <option value="">-- Select Activity--</option>';
				@foreach($activity as $k2=>$val2)																
				htmlOpt +='<option value="{{$val2->uuid}}">{{$val2->name}}</option>';															    
				@endforeach                                                
				htmlOpt +='</select>';
				htmlOpt +='</td>';
				htmlOpt +='<td style="width:10%"> ';
				htmlOpt +='<select name="predecessors[]" class="js-example-basic-single" multiple required>';
				htmlOpt +=' <option value="">-- Select Activity--</option>';
				@foreach($activity as $k3=>$val3)																
				htmlOpt +='<option value="{{$val3->uuid}}">{{$val3->name}}</option>';															    
				@endforeach                                                
				htmlOpt +='</select>';
				htmlOpt +='</td>';
				htmlOpt +='<td ><input type="text" name="mostlikely_cost[]" class="form-control" value="0"></td>';
				htmlOpt +='<td ><input type="text" name="optimistic_cost[]" class="form-control" value="0"></td>';			
				htmlOpt +='<td><input type="text" name="pessimistic_cost[]" class="form-control" value="0"></td>';
				htmlOpt +='<td ><input type="text" name="mostlikely_duration[]" class="form-control" value="0"></td>';				
				htmlOpt +='<td ><input type="text" name="optimistic_duration[]" class="form-control" value="0"></td>';
				htmlOpt +='<td ><input type="text" name="pessimistic_duration[]" class="form-control" value="0"></td>';
				htmlOpt +='<td style="float: right;margin: 11px 9px 9px 11px;">';
				htmlOpt +='<input style="border: white;" name="is_active" class="form-check-input" type="checkbox">';
				htmlOpt +='<input name="uuid[]" value="Null" type="hidden">';			 
				htmlOpt +='</td>';													 
				htmlOpt +='<td>';
				htmlOpt +='<a href="javascript:void(0);" class="remCF">';
				htmlOpt +='<img style="height:20px;" src="{{ url('assets/media/image/icons/delete.png') }}" alt="logo">';
				htmlOpt +='</a>';
				htmlOpt +='</td>';
				htmlOpt +='</tr> ';
		
		$("#customFields").append(htmlOpt);
	});
	$("#customFields").on('click','.remCF',function(){
		$(this).parent().parent().remove();
	});
	
	 
});

</SCRIPT>

<!-- DataTable -->
<script type="javascript">
$(function () {
	$('[data-toggle="tooltip"]').tooltip();
});

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
  

</script>
<script type="javascript">	
$(document).ready(function () {
	var table = $('.datatableTbl').DataTable(); 
	$('.datatableTbl tbody').on( 'click', 'remove', function () {
		table
			.row( $(this).parents('tr') )
			.remove()
			.draw();
	});
});
</script>

 	<!-- Javascript -->
    <script src="{{ url('public/vendors/prism/prism.js') }}"></script>
@endsection
