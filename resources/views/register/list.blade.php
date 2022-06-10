<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>XAQSIS - Register</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('public/assets/media/image/favicon.png') }}"/>
    <!-- Plugin styles -->
    <link rel="stylesheet" href="{{ url('public/vendors/bundle.css') }}" type="text/css">
    <!-- App styles -->
    <link rel="stylesheet" href="{{ url('public/assets/css/app.min.css') }}" type="text/css">
	 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	
</head>

{{-- 	@foreach ($result as $key => $val)
		{{ $key }} - {{ $val['title'] }}
	@endforeach 
 @foreach ($register as $key => $val)
			{{ $key }} - {{ $val['title'] }}
		@endforeach --}}
<body class="form-membership" style="padding: 0px;">
<!-- end::preloader -->
<div class="container">
<div class="row">
    <div class="col-md-3">
        <!--<img class="logo" width="100%" style="margin: 15px auto;" src="{{ url('public/assets/media/image/user/auth_image.jpg') }}" alt="image">-->
    </div>
	 <div class="col-md-12">
		<table class="table table table-striped" id="table" style="width:100%">
		 <thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">First Name</th>           
					<th class="text-center">Actions</th>
				</tr>
			</thead>
		<tbody>
		@foreach($result as $item)
		<tr class="item{{$item['id']}}">
			<td>{{$item['id']}}</td>
			<td>{{$item['title']}}</td>   
			<td><button class="edit-modal btn btn-info" data-info="{{$item['id']}}">
					<span class="glyphicon glyphicon-edit"></span> Edit
				</button>
				<button class="delete-modal btn btn-danger" data-info="{{$item['id']}}">
					<span class="glyphicon glyphicon-trash"></span> Delete
				</button></td>
		</tr>
		@endforeach
		</tbody>
		</table>
	</div>
</div>

<script>
$(document).ready(function() {
    $('#table').DataTable();
} );
 </script>
 </div>
 
<!-- Plugin scripts -->
<script src="{{ url('public/vendors/bundle.js') }}"></script>
<!-- App scripts -->
<script src="{{ url('public/assets/js/app.min.js') }}"></script>


<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

</body>
</html>
