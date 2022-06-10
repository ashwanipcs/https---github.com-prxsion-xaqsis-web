@extends('layouts.app')

@section('head')
   <!-- Prism -->
<link rel="stylesheet" href="{{ url('public/assets/lib/main.css') }}" type="text/css"> 
<style>
 body {
    margin: 40px 10px;
    padding: 0;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 1100px;
    margin: 0 auto;
  }
</style>
@endsection
@section('content')
    <!-- begin::page-header -->
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Projects Events</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="{{asset('public/assets/media/image/icons/home.png')}}" alt="">
                        <a href="#">Manage</a>
                    </li>                    
                    <li class="breadcrumb-item active" aria-current="page">Projects Events</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- end::page-header -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
				<div class="row">
                    <div class="col-md-12 text-right mb-3">                         
                    </div>
                </div>
				<div class="card">						
                    <div class="card-body">					
					<div class="response"></div>
					<div id='calendar'></div>  
					</div>
				</div>
             </div>
		</div>
	</div>

<!-- .modal -->
	<div class="modal fade showModel">
		<div class="modal-dialog">
			<form name="modelFrm" method="post" action="" class="frmAction">
			<!-- CROSS Site Request Forgery Protection -->
			@csrf	
				<div class="modal-content">
					<div class="modal-header">					 
						<h4 class="modal-title"><span class="txttitle"></span></h4> 
						<button type="button" class="close" data-dismiss="modal">×</button>								
					</div>
					<div class="modal-body">
						<input type="text" name="uuid" class="form-control uuid" value="">									
						<div class="form-group row">
							<div class="col-sm-2"><strong>Events</strong>:</div>
							<div class="col-sm-10">
								<select name="event_uuid" class="form-control txtevents" style="width: 100%" required >
									<option value="0">-- Select Event --</option>
									@if($events)
										@foreach($events as $key=>$val)
										<option value="{{$val->uuid}}">{{$val->name}}</option>
										@endforeach
									@endif	
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-2"><strong>Projects</strong>:</div>
							<div class="col-sm-10">
							@if($projects)
								@foreach($projects as $index=>$items)
								<div class="checkbox checkbox-success">
								  <input name="project_uuid[]" value="{{$items->uuid}}" id="chkjquery" class="styled" type="checkbox" >
									  <label for="chkjquery">{{$items->name}}</label>
								</div> 
								@endforeach
							@endif
							</div>
						</div> 
					</div>   
					<div class="modal-footer">
						<button type="submit"  class="btn btn-primary btn-rounded">Save</button>
						<button type="button" class="btn btn-primary btn-rounded" data-dismiss="modal">Close</button>								                              
					</div>
				</div> 
			</form>
		</div>                                          
	</div>	
  

@endsection
@section('script')
<!-- Prism -->	  
<script src="{{ url('public/vendors/prism/prism.js') }}"></script>
<script src="{{ url('public/assets/lib/main.js') }}"></script>

<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialDate: '{{date("Y")}}-{{date("m")}}-{{date("d")}}',
      //initialView: 'timeGridMonth',
	  customButtons: {
			addProjectEvents: {
			  text: 'Add Project Events',
			  click: function() {
					//alert('clicked the custom button!');
					$(".txttitle").show().text('Create Projects Events');
					$('.showModel').modal({
						backdrop: 'static',
						keyboard: false
					});
				/*Save Project Events Data*/
				$('.frmAction').attr('action', "{{route('projectevents.create')}}");
			  }
			}
		},
      headerToolbar: {
        left: 'prev,next today addProjectEvents',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      height: 'auto',
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      selectable: true,
      selectMirror: true,
      nowIndicator: true,
	   select: function(start, end) {
                // Display add  modal.
                // You could fill in the start and end fields based on the parameters
                //$('.showModel').modal('show');
				$(".txttitle").show().text('Create Projects Events');
				$(".uuid").val('');
				$('.showModel').modal({
					backdrop: 'static',
					keyboard: false
				});
				/*Save Project Events Data*/
				$('.frmAction').attr('action', "{{route('projectevents.create')}}");
            },
		 
		
      events: [
		@if($res)
			 @foreach($res as $events)
				@php $start_date = date('Y-m-d H:i',$events->start); $end_date = date('Y-m-d H:i',$events->end); @endphp
				{	
					id:'{{$events->uuid}}',
					title: '{{$events->title}}',
					start: '{{$start_date}}',
					end: '{{$end_date}}',
					projectuuid: '{{$events->project_uuid}}',
					eventuuid: '{{$events->event_uuid}}'

				},
		   @endforeach
		@endif
      ],	 
	  eventClick: function(info) {
			//alert('uuid : ' + info.event.id+' = projectuuid='+info.event.extendedProps.projectuuid+"= event uuid="+info.event.extendedProps.eventuuid);
			$(".txttitle").show().text('Update Projects Events');
			$(".uuid").val(info.event.id);
			var eventuuid = info.event.extendedProps.eventuuid;
			alert(eventuuid);
			$(".txtevents option").each(function()
			{
				var selOptVal = $(this).val();
				if(selOptVal == info.event.extendedProps.eventuuid)
				{
					$(this).attr('selected', true);
				}
			});
			$('.showModel').modal({
				backdrop: 'static',
				keyboard: false
			});
		  }
    });

    calendar.render();
  });
</script>
<script type="text/javascript">
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
	 $("body").on("click", ".confirmDelete", function(event){
		 var url = $(this).data("url");	
			alert(url);
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

@endsection
