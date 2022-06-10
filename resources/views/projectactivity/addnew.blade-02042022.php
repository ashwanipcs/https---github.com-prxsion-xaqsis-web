@extends('layouts.app')
@section('head')
<!-- Prism -->
<link rel="stylesheet" href="{{ url('public/vendors/prism/prism.css') }}" type="text/css">
<!-- Style -->
<link rel="stylesheet" href="{{ url('public/vendors/select2/css/select2.min.css') }}" type="text/css">
<style>
@import url(https://fonts.googleapis.com/css?family=Open+Sans);

* {
  font-family: 'Open Sans', sans-serif;
}

.responsive-table {
  overflow: auto;
}

table {
  width: 100%;
  border-spacing: 0;
  border-collapse: collapse;
  white-space:nowrap;
}

table th {
  background: #BDBDBD;
}

table tr:nth-child(odd) {
  background-color: #F2F2F2;
}
table tr:nth-child(even) {
  background-color: #E6E6E6;
}

th, tr, td {
  text-align: center;
  border: 1px solid #E0E0E0;
  padding: 5px;
}

img {
  font-style: italic;
  font-size: 11px;
}

.fa-bars{
  cursor: move;
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
						<a href="javascript:void(0);" class="addmodel" data-toggle="tooltip" data-placement="top" title="Add">
						<img style="height:36px;" src="{{ url('public/assets/media/image/icons/add.png')}}" alt="logo"></a>
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
							  <label for="inputPassword3" class="col-sm-2 col-form-label"></label>
							  <div class="col-sm-10">
								<div class="row">
									<div class="col-md-10" style="padding-right:0px;">
										@foreach($projects as $p=>$project)
										@if($project->uuid==$project_uuid)
										<input type="hidden" name="projectuuid" class="projectuuid" value="{{$project->uuid}}">
										<strong>{{$project->name}}</strong>
										 @endif
									   @endforeach
									</div>                                      
								</div>
							  </div>
						</div>
						<hr/>
                        <div class="responsive-table">
						  <table id="sortable">
							<thead class="ui-state-default">
							  <th>Index</th>
							  <th>Activity</th>
							  <th>Most Likely Cost</th>
							  <th>Optimistic Cost</th>
							  <th>Pessimistic Cost</th>
							  <th>Most Likely Duration</th>
							  <th>Optimistic Duration</th>
							  <th>Pessimistic Duration</th>		  
							  <th>Action</th>
							</thead>
							@if($projectactivity)
								@foreach($projectactivity as $key => $items)
								@php $item_id = Crypt::encrypt($items->uuid); 
								     $pArr ='["c32527fa-73b5-46e2-a7d1-77fcd4440692",
											"beb8f817-afe0-4f8c-a92a-5388d93bfa7c",
											"96e33805-77ec-43d5-8ae0-99897415156b",
											"2165536f-3733-4afa-a445-d5bdb38bab9d"]';
								@endphp
								<tr>
								  <td data-id="{{$key+1}}"><a href="#">{{$key+1}}</a></td>
								  <td>{{$items->name}}</td>
								  <td>{{$items->mostlikely_cost}}</td>
								  <td>{{$items->optimistic_cost}}</td>
								  <td>{{$items->pessimistic_cost}}</td>
								  <td>{{$items->mostlikely_duration}}</td>
								  <td>{{$items->optimistic_duration}}</td>
								  <td>{{$items->pessimistic_duration}}</td>
								  <td>
									 <a href="javascript:void(0);" data-name="{{$items->name}}" data-uuid="{{$items->uuid}}" data-activityuuid="{{$items->activity_uuid}}" data-mc="{{$items->mostlikely_cost}}" data-oc="{{$items->optimistic_cost}}" 
									 data-pc="{{$items->pessimistic_cost}}" data-md="{{$items->mostlikely_duration}}" data-od="{{$items->optimistic_duration}}"
									data-pd="{{$items->pessimistic_duration}}" data-predecessors="{{$pArr}}" class="editModel btn btn-success btn-floating" data-toggle="tooltip" data-placement="top" title="Edit">
									<button class="btn btn-primary" data-btnid="btn 1">Edit</button></a></td>
								</tr>
								@endforeach
							@else	
								 
							@endif
						  </table>
					   </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade showModel" role="dialog">
		<div class="modal-dialog modal-xl">
			<!-- Modal content-->
			<form class="frmAction" method="post" novalidate>
			@csrf
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Create Project Activity</h4>
				</div>
				<div class="modal-body">	
						<input type="hidden" name="project_uuid" class="form-control projectid" value="">					 
						  <div class="form-row">
							<div class="col-md-12 mb-3">
								<label for="validationCustom01">Projects Activity</label>								 
									<select name="activity_uuid" class="form-control" id="exampleFormControlSelect1" required>
										<option value="">-- Select Projects Activity --</option>
									   @foreach($activity as $k=>$val)
										<option value="{{$val->uuid}}">{{$val->name}}</option>	
									   @endforeach                                                
								  </select>	
								 
							</div>
						  </div> 
						  <div class="form-row">
							<div class="col-md-4 mb-3">
							  <label for="validationCustom01">Mostlikely Cost</label>
							  <input type="text" name="mostlikely_cost" class="form-control mostlikelycost" id="validationCustom01"  value="0.00" required>							
							</div>
							<div class="col-md-4 mb-3">
							  <label for="validationCustom02">Optimistic Cost</label>
							  <input type="text" name="optimistic_cost" class="form-control optimisticcost" id="validationCustom02"  value="0.00" required>							  
							</div>
							<div class="col-md-4 mb-3">
							  <label for="validationCustomUsername">Pessimistic Cost</label>
							  <div class="input-group">
								<input type="text" name="pessimistic_cost" class="form-control pessimisticcost" id="validationCustomUsername" value="0.00"  required>
							  </div>
							</div>
						  </div>
						  
						  <div class="form-row">
							<div class="col-md-4 mb-3">
							  <label for="validationCustom01">Mostlikely Duration</label>
							  <input type="text" name="mostlikely_duration" class="form-control mostlikelyduration" id="validationCustom01"  value="0" required>
							</div>
							<div class="col-md-4 mb-3">
							  <label for="validationCustom02">Optimistic Duration</label>
							  <input type="text" name="optimistic_duration" class="form-control optimisticduration" id="validationCustom02"  value="0" required>
							</div>
							<div class="col-md-4 mb-3">
							  <label for="validationCustomUsername">Pessimistic Duration</label>
							  <div class="input-group">
								<input type="text" name="pessimistic_duration" class="form-control pessimisticduration" id="validationCustomUsername" value="0" required>
							  </div>
							</div>
						  </div>

						 <div class="form-row">
						 <div class="col-md-12 mb-12">						 
						  <label for="validationCustomUsername">Select Parent Activity</label>						 
								<select name="predecessors[]" class="select-parent-activity" multiple>
								  <option value="">Select</option>
								  <optgroup label="Activity">
									 @foreach($activity as $k1=>$val1)																
										<option value="{{$val1->uuid}}">{{$val1->name}}</option>
									@endforeach  
								  </optgroup>								 
								</select>
						</div>
						</div>
					
				</div>
				<div class="modal-footer">
					<button type="submit"  class="submitbtn btn btn-primary btn-rounded">Save</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
				</div>
			</div>
			</form>
		</div>
    </div> 
	<!-- For Update Project Activity -->
	<div class="modal fade updateShowModel" role="dialog">
		<div class="modal-dialog modal-xl">
			<!-- Modal content-->
			<form class="frmUpdateAction" method="post" novalidate>
			@csrf
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Update Project Activity</h4>
				</div>
				<div class="modal-body">	
						
						  <div class="form-row">
							<div class="col-md-12 mb-3">
								<label for="validationCustom01">Projects Activity: <strong><span class="activity_name"></span></strong></label>
								
								<input type="hidden" name="project_uuid" class="form-control projectid" value="">
								<input type="hidden" name="activity_uuid" class="form-control activityuuid" value="">
								<input type="hidden" name="uuid" class="form-control uuid" value="">
							</div>
						  </div> 
						  <div class="form-row">
							<div class="col-md-4 mb-3">
							  <label for="validationCustom01">Mostlikely Cost</label>
							  <input type="text" name="mostlikely_cost" class="form-control mostlikelycost" id="validationCustom01"  value="0.00" required>							
							</div>
							<div class="col-md-4 mb-3">
							  <label for="validationCustom02">Optimistic Cost</label>
							  <input type="text" name="optimistic_cost" class="form-control optimisticcost" id="validationCustom02"  value="0.00" required>							  
							</div>
							<div class="col-md-4 mb-3">
							  <label for="validationCustomUsername">Pessimistic Cost</label>
							  <div class="input-group">
								<input type="text" name="pessimistic_cost" class="form-control pessimisticcost" id="validationCustomUsername" value="0.00"  required>
							  </div>
							</div>
						  </div>
						  
						  <div class="form-row">
							<div class="col-md-4 mb-3">
							  <label for="validationCustom01">Mostlikely Duration</label>
							  <input type="text" name="mostlikely_duration" class="form-control mostlikelyduration" id="validationCustom01"  value="0" required>
							</div>
							<div class="col-md-4 mb-3">
							  <label for="validationCustom02">Optimistic Duration</label>
							  <input type="text" name="optimistic_duration" class="form-control optimisticduration" id="validationCustom02"  value="0" required>
							</div>
							<div class="col-md-4 mb-3">
							  <label for="validationCustomUsername">Pessimistic Duration</label>
							  <div class="input-group">
								<input type="text" name="pessimistic_duration" class="form-control pessimisticduration" id="validationCustomUsername" value="0" required>
							  </div>
							</div>
						  </div>

						 <div class="form-row">
						 <div class="col-md-12 mb-12">						 
						  <label for="validationCustomUsername">Select Parent Activity</label>						 
								<select name="predecessors[]" class="select-parent-activity predecessorsVal" id="predecessorsItems" multiple>
								  <option>Select</option>
								  <optgroup label="Activity">
									 @foreach($activity as $k1=>$val1)																
										<option value="{{$val1->uuid}}">{{$val1->name}}</option>@endforeach  
								  </optgroup>								 
								</select>
						</div>
						</div>
					
				</div>
				<div class="modal-footer">
					<button type="submit"  class="submitbtn btn btn-primary btn-rounded">Save</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
				</div>
			</div>
			</form>
		</div>
    </div> 
	
@endsection

@section('script')
<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>   
<!-- Javascript -->
<script src="{{ url('public/vendors/select2/js/select2.min.js') }}"></script>   

<script id="rendered-js" >
	$(function () {
	  $("#sortable tbody").sortable({
		cursor: "move",
		placeholder: "sortable-placeholder",
		helper: function (e, tr)
		{
		  var $originals = tr.children();
		  var $helper = tr.clone();
		  $helper.children().each(function (index)
		  {
			// Set helper cell sizes to match the original sizes
			$(this).width($originals.eq(index).width());
		  });
		  return $helper;
		} }).
	  disableSelection();
	});
</script>

<script type="text/javascript">
$("body").on("click", ".addmodel", function(event){	
	/*var button = $(event.relatedTarget) 
	var btnID = button.data('btnid')
	var modal = $(this)             
	modal.find('.modal-body input#btnClickedID').val(btnID)*/
	$(".activities").show();
	$(".editactivities").hide();
	$('.frmAction').attr('action', "{{route('projectactivity.add')}}");
	var project_uuid =	$(".projectid").val($(".projectuuid").val());
	$('.showModel').modal({
		backdrop: 'static',
		keyboard: false
	});
})
</script>
<script type="text/javascript">
$("body").on("click", ".editModel", function(event){	
	/*var button = $(event.relatedTarget) 
	var btnID = button.data('btnid')
	var modal = $(this)             
	modal.find('.modal-body input#btnClickedID').val(btnID)*/
	$(".activities").hide();
	$(".editactivities").show();
	$('.frmUpdateAction').attr('action', "{{route('projectactivity.update')}}");
	var project_uuid =	$(".projectid").val($(".projectuuid").val());
	var uuid 		= $(this).data('uuid');
	var name 		= $(this).data('name');
	var activity_uuid = $(this).data('activityuuid');
	var mc = $(this).data('mc');
	var oc = $(this).data('oc');
	var pc = $(this).data('pc');
	var md = $(this).data('md');
	var od = $(this).data('od');
	var pd = $(this).data('pd');
	var predecessors = $(this).data('predecessors');
	
	//alert(name);
	
	$(".uuid").val(uuid);
	$(".activity_name").text(name);
	$(".activityuuid").val(activity_uuid);
	$(".mostlikelycost").val(mc);
	$(".optimisticcost").val(oc);
	$(".pessimisticcost").val(oc);
	$(".mostlikelyduration").val(md);
	$(".optimisticduration").val(od);
	$(".pessimisticduration").val(pd);
	
	var Values = new Array();
	//Values.push("c32527fa-73b5-46e2-a7d1-77fcd4440692");
	//Values.push("beb8f817-afe0-4f8c-a92a-5388d93bfa7c");
	//Values.push("96e33805-77ec-43d5-8ae0-99897415156b");
	/*const  myNumbersArray = [
			"c32527fa-73b5-46e2-a7d1-77fcd4440692",
			"beb8f817-afe0-4f8c-a92a-5388d93bfa7c",
			"96e33805-77ec-43d5-8ae0-99897415156b",
			'2165536f-3733-4afa-a445-d5bdb38bab9d'
			];*/
	for(let i = 0; i < predecessors.length; i++) {		
		Values.push(predecessors[i]);
		$('#predecessorsItems').val(Values).trigger('change');
	}	
	
	$('.updateShowModel').modal({
		backdrop: 'static',
		keyboard: false
	});
})
</script>

<script>
	$('.select-parent-activity').select2({
		placeholder: 'Select', width:'100%'
	});
</script>
<!-- Javascript -->
<script src="{{ url('public/vendors/prism/prism.js') }}"></script>
@endsection
