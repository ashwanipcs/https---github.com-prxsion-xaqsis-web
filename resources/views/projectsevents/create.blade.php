@extends('layouts.app')

@section('head')
   <!-- Prism -->

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
					<form action="{{ route('projectevents.save') }}" method="post">
					  {{ csrf_field() }}
						  Task name:
						  <br />
						  <input type="text" name="name" />
						  <br /><br />
						  Task description:
						  <br />
						  <textarea name="description"></textarea>
						  <br /><br />
						  Start time:
						  <br />
						  <input type="text" name="task_date" class="date" />
						  <br /><br />
						  <input type="submit" value="Save" />
					</form> 
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
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
<script>
$('.date').datepicker({
        autoclose: true,
        dateFormat: "yy-mm-dd"
    });
</script>
@endsection
