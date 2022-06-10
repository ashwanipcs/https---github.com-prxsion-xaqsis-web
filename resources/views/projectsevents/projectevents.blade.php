@extends('layouts.app')

@section('head')
   <!-- Prism -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" /> 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" /> 

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
                    <div class="col-md-12 text-right mb-3" >
                         
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
<!-- Prism -->	  

@endsection
@section('script')
<!-- Prism -->	  
<script src="{{ url('public/vendors/prism/prism.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/moment@2.27.0/moment.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>

<script>
$(document).ready(function () {
		var SITEURL = "{{url('/')}}";		 
			$.ajaxSetup({
				headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
	var url = SITEURL + "/projectevents";
	alert(url);
	var calendar = $('#calendar').fullCalendar({
		editable: true,
		events: SITEURL + "/projectevents",
		displayEventTime: true,
		editable: true,
		eventRender: function (event, element, view) {
			 
			if (event.allDay === 'true') {
				event.allDay = true;
			} else {
				event.allDay = false;
			}
		},
		selectable: true,
		selectHelper: true,
		select: function (start, end, allDay) {
			var title = prompt('Event Title:');
			var start_date = prompt('Start Date:');
			var end_date = prompt('End Date:');
			if (title) {
				//var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
				//var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
				$.ajax({
					url: SITEURL + "projectevents.create",
					data: 'title=' + title + '&start=' + start + '&end=' + end,
					type: "POST",
					success: function (data) {
						displayMessage("Added Successfully");
					}
				});
				calendar.fullCalendar('renderEvent',
					{
						title: title,
						start: start,
						end: end,
						allDay: allDay
					},
					true
				);
			}
			calendar.fullCalendar('unselect');
		},
		eventDrop: function (event, delta) {
			var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
			var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
			$.ajax({
					url: SITEURL + 'projectevents.update',
					data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
					type: "POST",
					success: function (response) {
						displayMessage("Updated Successfully");
					}
			});
		},
		eventClick: function (event) {
			var deleteMsg = confirm("Do you really want to delete?");
			if (deleteMsg) {
				$.ajax({
					type: "POST",
					url: SITEURL + 'projectevents.delete',
					data: "&id=" + event.id,
					success: function (response) {
						if(parseInt(response) > 0) {
							$('#calendar').fullCalendar('removeEvents', event.id);
							displayMessage("Deleted Successfully");
						}
					}
				});
			}
		}
	});
});
function displayMessage(message) {
	$(".response").html("<div class='success'>"+message+"</div>");
	setInterval(function() { $(".success").fadeOut(); }, 1000);
}
</script>
@endsection
