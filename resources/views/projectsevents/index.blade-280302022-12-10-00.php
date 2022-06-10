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
<script src="{{ url('public/assets/lib/main.js') }}"></script>

<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        //left: 'prevYear,prev,next,nextYear today',
		left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,dayGridWeek,dayGridDay'
      },
      initialDate: '2022-03-12',
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      dayMaxEvents: true, // allow "more" link when too many events
      events: [
	  @foreach($res as $events)
	  @php $start_date = date('Y-m-d',$events->start_date); $end_date = date('Y-m-d',$events->end_date); @endphp
        {
          title: '{{$events->name}}',
          start: '{{$start_date}}',
		  end: '{{$end_date}}'
        },
       @endforeach
      ]
    });

    calendar.render();
  });

</script>
@endsection
