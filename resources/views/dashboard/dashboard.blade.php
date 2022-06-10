@extends('layouts.app')
@section('head')
<!-- styles -->
<link rel="stylesheet" href="{{ url('public/assets/css/styles.css') }}" type="text/css">
<!-- Plugin styles -->
<link rel="stylesheet" href="{{ url('public/vendors/bundle.css') }}" type="text/css">
  <!-- App styles -->
<link rel="stylesheet" href="{{ url('public/assets/css/app.min.css') }}" type="text/css">

<style>
#treechart {
  padding-right: 10px;
  max-width: '90%';
  margin: 35px auto;
}
#chartdiv1 {
  max-width: 100%;
  max-height: 100%;
  margin: 35px auto;
}  
#ganttchart {
  max-width: 100%;
  margin: 35px auto;
}

.apexcharts-yaxis text {
  font-weight: bold;
}
   
</style>

<script src="{{ url('public/assets/js/apexcharts.min.js') }}"></script>
<script src="{{ url('public/assets/js/moment.min.js') }}"></script>
<!-- Circle progress -->
<script src="{{ url('public/vendors/circle-progress/circle-progress.min.js') }}"></script>
<!-- Plugin scripts -->
<script src="{{ url('public/vendors/bundle.js') }}"></script>

<script>
// Replace Math.random() with a pseudo-random number generator to get reproducible results in e2e tests
// Based on https://gist.github.com/blixt/f17b47c62508be59987b
var _seed = 42;
Math.random = function() {
_seed = _seed * 16807 % 2147483647;
return (_seed - 1) / 2147483646;
};
</script>

@endsection
@section('content')

    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Analytics</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <img style="height: 12px; margin-top: -3px;" src="{{asset('public/media/image/icons/home.png')}}" alt="">
                        <a href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">analytics</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
               <div class="card card-body">
					<div class="d-flex align-items-center">
						<div class="position-relative mr-3 text-center">
							<div id="circle-1" class="circle"><canvas width="90" height="90"></canvas></div>
							<div class="position-absolute a-0 d-flex flex-column align-items-center justify-content-center">
								<h4 class="mb-0">65%</h4>
								<span class="font-size-11 text-uppercase text-muted">Reached</span>
							</div>
						</div>
						<div>
							<p class="mb-1">Time to Resolved Complaint</p>
							<p class="text-muted mb-1">
								<small>The average time taken to resolve complaints.</small>
							</p>
							<h3 class="mb-0">7m:32s
								<small>/ Goal: 8m:0s</small>
							</h3>
						</div>
					</div>
				</div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-body">
					<div class="d-flex align-items-center">
						<div class="position-relative mr-3 text-center">
							<div id="circle-2" class="circle"><canvas width="90" height="90"></canvas></div>
							<div class="position-absolute a-0 d-flex flex-column align-items-center justify-content-center">
								<h4 class="mb-0">35%</h4>
								<span class="font-size-11 text-uppercase text-muted">Reached</span>
							</div>
						</div>
						<div>
							<p class="mb-1">Average Speed of Answer</p>
							<p class="text-muted mb-1">
								<small>Measure how quickly support staff answer incoming calls.</small>
							</p>
							<h3 class="mb-0">0m:20s
								<small>/ Goal: 0m:10s</small>
							</h3>
						</div>
					</div>
				</div>
            </div>           
            
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="card-title">Website Audience Metrics</h6>
                            
                        </div>
                        <div class="d-lg-none d-sm-block mb-4"></div>
                        <div id="ganttchart"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">             
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div id="chartdiv1"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="card-title">Total Visits</h6>
                            <div>
                                <a href="#" class="mr-3">
                                    <i class="fa fa-refresh"></i>
                                </a>
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item">Report</a>
                                        <a href="#" class="dropdown-item">Download</a>
                                        <a href="#" class="dropdown-item">Close</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr class="text-uppercase font-size-11 text-muted">
                                    <th>Link</th>
                                    <th>Page Title</th>
                                    <th>Percentage (%)</th>
                                    <th class="text-right">Value</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <a href="#">
                                            <i class="fa fa-external-link"></i>
                                        </a>
                                    </td>
                                    <td>Homepage</td>
                                    <td>
                                        <div class="progress" style="height: 5px">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 65%;"
                                                 aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td class="text-right">65.35%</td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#">
                                            <i class="fa fa-external-link"></i>
                                        </a>
                                    </td>
                                    <td>About</td>
                                    <td>
                                        <div class="progress" style="height: 5px">
                                            <div class="progress-bar bg-warning" role="progressbar"
                                                 style="width: 51%;"
                                                 aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td class="text-right">51.20%</td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#">
                                            <i class="fa fa-external-link"></i>
                                        </a>
                                    </td>
                                    <td>Products</td>
                                    <td>
                                        <div class="progress" style="height: 5px">
                                            <div class="progress-bar bg-danger" role="progressbar"
                                                 style="width: 39%;"
                                                 aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td class="text-right">39.10%</td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#">
                                            <i class="fa fa-external-link"></i>
                                        </a>
                                    </td>
                                    <td>Categories</td>
                                    <td>
                                        <div class="progress" style="height: 5px">
                                            <div class="progress-bar bg-primary" role="progressbar"
                                                 style="width: 40%;"
                                                 aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td class="text-right">40%</td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#">
                                            <i class="fa fa-external-link"></i>
                                        </a>
                                    </td>
                                    <td>Contact</td>
                                    <td>
                                        <div class="progress" style="height: 5px">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                 style="width: 80%;"
                                                 aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td class="text-right">80%</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
				
            </div>
        </div>
		
		<div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="card-title">Website Audience Metrics</h6>                           
                        </div>
                        <div class="d-lg-none d-sm-block mb-4"></div>
                        <div id="users-chart"></div>
                    </div>
                </div>
            </div>
        </div>

		 <div class="row">
            <div class="col-md-12">
                <div class="card">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between">                            
							</div>
							<div class="table-responsive">
							   <div id="treechart"></div>
							</div>
						</div>
				</div>
			</div>
			</div>
		</div>
    </div>

@endsection

@section('script') 
<div class="colors"> <!-- To use theme colors with Javascript -->
        <div class="bg-primary"></div>
        <div class="bg-primary-bright"></div>
        <div class="bg-secondary"></div>
        <div class="bg-secondary-bright"></div>
        <div class="bg-info"></div>
        <div class="bg-info-bright"></div>
        <div class="bg-success"></div>
        <div class="bg-success-bright"></div>
        <div class="bg-danger"></div>
        <div class="bg-danger-bright"></div>
        <div class="bg-warning"></div>
        <div class="bg-warning-bright"></div>
    </div>
	<script>

        var options = {
          series: [{'name': 'Actual', 'data': [{'x': 'C1010-Partitions', 'y': [1646096400000, 1646182800000]}, {'x': 'C3010-Wallfinishes', 'y': [1646787600000, 1647046800000]}, {'x': 'D2010-Plumbingfixtures', 'y': [1648083600000, 1648170000000]}, {'x': 'D4010-Sprinklers', 'y': [1648861200000, 1649206800000]}, {'x': 'E1010-CommercialEquipment', 'y': [1650589200000, 1650762000000]}, {'x': 'Z1010-Fieldrequirements,Overheadandprofit', 'y': [1651366800000, 1651366800000]}, {'x': 'Z2010-Designers', 'y': [1651712400000, 1652058000000]}, {'x': 'Z3010-DesignandconstructionContingencies', 'y': [1652144400000, 1652576400000]}]}, {'name': 'Simulated', 'data': [{'x': 'C1010-Partitions', 'y': [1646096400000, 1646269200000]}, {'x': 'C3010-Wallfinishes', 'y': [1647046800000, 1647392400000]}, {'x': 'D2010-Plumbingfixtures', 'y': [1648774800000, 1648947600000]}, {'x': 'D4010-Sprinklers', 'y': [1649811600000, 1650330000000]}, {'x': 'E1010-CommercialEquipment', 'y': [1652230800000, 1652490000000]}, {'x': 'Z1010-Fieldrequirements,Overheadandprofit', 'y': [1653354000000, 1653440400000]}, {'x': 'Z2010-Designers', 'y': [1653872400000, 1654390800000]}, {'x': 'Z3010-DesignandconstructionContingencies', 'y': [1654477200000, 1655082000000]}]}]
		,
          chart: {
          height: '80%',		 
          type: 'rangeBar'
        },
        plotOptions: {
          bar: {
            horizontal: true,
            barHeight: '90%'
          }
        },
		dataLabels: {
          enabled: true,
          formatter: function(val, opts) {
            var label = opts.w.globals.labels[opts.dataPointIndex]
            var a = moment(val[0])
            var b = moment(val[1])
            var diff = b.diff(a, 'days')
            return diff + (diff > 1 ? ' Days' : ' Day')
          },
          style: {
            colors: ['#f3f4f5', '#fff']
          }
        },
		grid: {
		  row: {
			  colors: ['#e5e5e5', 'transparent'],
			  opacity: 0.5
		  }, 
		  column: {
			  colors: ['#f8f8f8', 'transparent'],
			  opacity: 0.5
		  }, 
		  xaxis: {
			lines: {
			  show: true
			}
		  }
		},
		xaxis: {
          type: 'datetime'
        },
        stroke: {
          width: .5
        },
        fill: {
          type: 'solid',
          opacity: 0.6
        },
        legend: {
          position: 'top',
          horizontalAlign: 'left'
        }
        };

        var chart = new ApexCharts(document.querySelector("#ganttchart"), options);
        chart.render();
      
      
    </script>
<script>
	  
        var options = {
          series: [{
          name: 'Frequency',
          type: 'column',
          data: [2, 0, 2, 1, 4, 5, 3, 8, 10, 12, 13, 12, 15, 22, 19, 23, 17, 19, 36, 27, 32, 35, 29, 26, 28, 20, 28, 32, 21, 24, 22, 21, 13, 19, 25, 29, 15, 19, 8, 19, 12, 20, 14, 15, 12, 13, 17, 6, 18, 10, 13, 7, 11, 7, 10, 8, 12, 8, 9, 7, 5, 5, 8, 5, 5, 3, 3, 1, 2, 1, 6, 1, 1, 0, 0, 2, 1, 1, 1, 0, 0, 1, 1, 0, 1, 0, 1, 0, 1]
        }, {
          name: 'CDF',
          type: 'line',
          data: [0.0, 0.0, 0.0, 0.0, 0.01, 0.01, 0.02, 0.02, 0.04, 0.05, 0.06, 0.07, 0.09, 0.11, 0.13, 0.15, 0.17, 0.19, 0.22, 0.25, 0.28, 0.32, 0.35, 0.37, 0.4, 0.42, 0.45, 0.48, 0.5, 0.53, 0.55, 0.57, 0.58, 0.6, 0.63, 0.65, 0.67, 0.69, 0.7, 0.72, 0.73, 0.75, 0.76, 0.78, 0.79, 0.8, 0.82, 0.82, 0.84, 0.85, 0.87, 0.87, 0.88, 0.89, 0.9, 0.91, 0.92, 0.93, 0.94, 0.94, 0.95, 0.95, 0.96, 0.97, 0.97, 0.98, 0.98, 0.98, 0.98, 0.98, 0.99, 0.99, 0.99, 0.99, 0.99, 0.99, 0.99, 0.99, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0]
        }],
          chart: {
          height: '500px',
          type: 'line',
        },
        stroke: {
          width: [0, 4]
        },
        title: {
          text: 'Construction Cost Probability'
        },
        dataLabels: {
          enabled: true,
          enabledOnSeries: [1]
        },
        labels: [2939436, 2949436, 2959436, 2969436, 2979436, 2989436, 2999436, 3009436, 3019436, 3029436, 3039436, 3049436, 3059436, 3069436, 3079436, 3089436, 3099436, 3109436, 3119436, 3129436, 3139436, 3149436, 3159436, 3169436, 3179436, 3189436, 3199436, 3209436, 3219436, 3229436, 3239436, 3249436, 3259436, 3269436, 3279436, 3289436, 3299436, 3309436, 3319436, 3329436, 3339436, 3349436, 3359436, 3369436, 3379436, 3389436, 3399436, 3409436, 3419436, 3429436, 3439436, 3449436, 3459436, 3469436, 3479436, 3489436, 3499436, 3509436, 3519436, 3529436, 3539436, 3549436, 3559436, 3569436, 3579436, 3589436, 3599436, 3609436, 3619436, 3629436, 3639436, 3649436, 3659436, 3669436, 3679436, 3689436, 3699436, 3709436, 3719436, 3729436, 3739436, 3749436, 3759436, 3769436, 3779436, 3789436, 3799436, 3809436, 3819436],
        xaxis: {
          type: 'numeric'
        },
        yaxis: [{
          title: {
            text: 'Frequency',
          },
        
        }, {
          opposite: true,
          title: {
            text: 'Prbability'
          }
        }]
        };

       var chart = new ApexCharts(document.querySelector("#chartdiv1"), options);
		 
        chart.render();
    </script>	
<script>
      
	var options = {
	  series: [
			  {
				name: 'Desktops',
				data: [	{x: 'ABC', y: 10},
						{x: 'DEF', y: 60},
						{x: 'XYZ', y: 41}]
			  },
			  {
				name: 'Mobile',
				data: [ {x: 'ABCD', y: 10},
						{x: 'DEFG',
					y: 20
				  },
				  {
					x: 'WXYZ',
					y: 51
				  },
				  {
					x: 'PQR',
					y: 30
				  },
				  {
					x: 'MNO',
					y: 20
				  },
				  {
					x: 'CDE',
					y: 30
				  }
				]
			  }
	],
	  legend: {
	  show: false
	},
	chart: {
	  height: '90%',
	  type: 'treemap'
	},
	title: {
	  text: 'Multi-dimensional Treemap',
	  align: 'center'
	}
	};

	var chart = new ApexCharts(document.querySelector("#treechart"), options);
	chart.render();  
  
</script>

@endsection
