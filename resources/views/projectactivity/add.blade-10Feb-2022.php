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
                <div class="card" style="padding: 28px;"> 
				<form name="projectactivity" method="post" action="{{ route('projectactivity.save') }}">
				<!-- CROSS Site Request Forgery Protection -->
				@csrf	
                    <div class="row">  						
                        <div class="col-md-12" style="margin-top:14px;">                            
							<div class="form-group row">
							  <label for="inputPassword3" class="col-sm-2 col-form-label"><strong>Project </strong>:</label>
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
                                            <a href="javascript:void(0); return false;" style="font-size:25px;" onclick="addRow('dataTable')">
                                                <img style="height:36px;" src="{{ url('public/assets/media/image/icons/add.png')}}" alt="logo">                                             
                                            </a>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            <div class="card">
                                <div class="card-body" style="padding:0px;">
                                    <table class="datatableTbl table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="width:10%">Activity</th>
                                            <th style="width:10%">Mostlikely Cost</th>
                                            <th style="width:5%">Mostlikely Duration</th>
                                            <th style="width:15%">Pessimistic Cost</th>
                                            <th style="width:5%">Pessimistic Duration</th>
                                            <th style="width:10%">Optimistic Cost</th> 
											<th style="width:5%">Optimistic Duration</th>
											<th style="width:5%">Active</th>
                                            <th style="width:10%">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tbody">
											 <table id="dataTable" class="table table-striped table-bordered" width="100%">
												@foreach($projectactivity as $key => $items)
												<tr>
													<td style="width:14%"> 
														<select name="activity_uuid[]" class="form-control" id="exampleFormControlSelect1">
															<option>C1010-Partitions</option>
														   @foreach($activity as $k=>$val)																
																<option value="{{$val->uuid}}" @if($val->uuid == $items->activity_uuid) selected @else  @endif>{{$val->name}}</option>															    
														   @endforeach                                                
													  </select>
													 </td>
													<td ><input type="text" name="mostlikely_cost[]" class="form-control" value="{{$items->mostlikely_cost}}"></td>
													<td ><input type="text" name="mostlikely_duration[]" class="form-control" value="{{$items->mostlikely_duration}}"></td>
													<td><input type="text" name="pessimistic_cost[]" class="form-control" value="{{$items->pessimistic_cost}}"></td>
													<td ><input type="text" name="pessimistic_duration[]" class="form-control" value="{{$items->pessimistic_duration}}"></td>
													<td ><input type="text" name="optimistic_cost[]" class="form-control" value="{{$items->optimistic_cost}}"></td>
													<td ><input type="text" name="optimistic_duration[]" class="form-control" value="{{$items->optimistic_duration}}"></td>
													<td ><input name="is_active" class="form-check-input" type="checkbox" id="gridCheck1" checked="checked"></td>													 
													<td> 
														  <a href="#" onclick="deleteRow('dataTable')">
														 <img style="height:20px;" src="{{ url('public/assets/media/image/icons/delete.png') }}" alt="logo">
														</a>
													</td>
												</tr> 
												@endforeach
											</table> 
                                        </tbody>
                                </div>
                            </div>
                        </div>                       
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

<SCRIPT language="javascript">
function addRow(tableID) {
			//alert(tableID);
			var table = document.getElementById(tableID);
		//alert(table);
			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var colCount = table.rows[0].cells.length;

			for(var i=0; i<colCount; i++) {

				var newcell	= row.insertCell(i);

				newcell.innerHTML = table.rows[0].cells[i].innerHTML;
				//alert(newcell.childNodes);
				switch(newcell.childNodes[0].type) {
					case "text":
							newcell.childNodes[0].value = 0;
							break;
					case "checkbox":
							newcell.childNodes[0].checked = false;
							break;
					case "select-one":
							newcell.childNodes[0].selectedIndex = 0;
							break;
				}
			}
		}

		function deleteRow(tableID) {
			
			try {
			var table = document.getElementById(tableID);
			alert(table);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chkbox = row.cells[0].childNodes[0];
				if(null != chkbox && true == chkbox.checked) {
					if(rowCount <= 1) {
						alert("Cannot delete all the rows.");
						break;
					}
					table.deleteRow(i);
					rowCount--;
					i--;
				}


			}
			}catch(e) {
				alert(e);
			}
		}

	</SCRIPT>

<!-- DataTable -->
<script type="javascript">
$(function () {
	$('[data-toggle="tooltip"]').tooltip();
});
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
