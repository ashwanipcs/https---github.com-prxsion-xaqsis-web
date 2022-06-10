@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Projects</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="{{asset('public/assets/media/image/icons/home.png')}}" alt="">
                        <a href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Projects</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="padding: 28px;">
				<div class="row">
					<div class="col-md-12">
						<!-- Success message -->
						@if(Session::has('error'))
							<div class="alert alert-danger">
								{{Session::get('error')}}
							</div>
						@endif
						@if (count($errors) > 0)
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
					</div>
				</div>
                    <div class="row"> 
                        <div class="col-md-12" style="margin-top:14px;">  
							<form name="frmProjects" method="post" action="{{ route('projects.save') }}">
								<!-- CROSS Site Request Forgery Protection -->
								@csrf			
									
                                <div class="form-group row">
                                  <label for="inputEmail3" class="col-sm-3 col-form-label"> <strong>Name</strong></label>
                                  <div class="col-sm-7">
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'error' : '' }}" id="inputEmail3" style="width: 70%">
									<!-- Error -->
									@if ($errors->has('name'))
									<span class="text-danger">
										{{ $errors->first('name') }}
									</span>
									@endif
								  </div>									
                                </div>
                                <div class="form-group row">
                                  <label for="inputPassword3" class="col-sm-3 col-form-label"><strong>Description</strong></label>
                                  <div class="col-sm-7">
                                    <input type="text" name="description" class="form-control {{ $errors->has('description') ? 'error' : '' }}"  style="width: 70%" id="inputPassword3">
									<!-- Error -->
									@if ($errors->has('description'))
									<span class="text-danger">
										{{ $errors->first('description') }}
									</span>
									@endif
								  </div>								  
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3"><strong>Is Active</strong>:</div>
                                    <div class="col-sm-7">
                                      <div class="form-check">
                                        <input name="is_active" class="form-check-input"  type="checkbox" id="gridCheck1">
										 
                                      </div>
                                    </div>
									
                                  </div>								  
								<div class="form-group row">
								<div class="col-md-12 text-center">
									<button type="submit" class="btn btn-primary btn-uppercase">Save</button>
									<a href="{{route('projects')}}"><span class="btn btn-primary btn-uppercase">Cancel</span></a>										 								
                                </div>                                  
                                </div>
							</form>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

