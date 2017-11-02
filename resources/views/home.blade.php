@extends('layouts.main')

@section('title')
Libot Philippines
@endsection

@section('css')
	<!-- Morris Charts CSS -->
	<link href="vendors/bower_components/morris.js/morris.css" rel="stylesheet" type="text/css"/>

	<!-- Data table CSS -->
	<link href="vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>

	<link href="vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">

	<!-- bootstrap-select CSS -->
	<link href="vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>	

	<!-- Bootstrap Switches CSS -->
	<link href="vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>

	<!-- switchery CSS -->
	<link href="vendors/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" type="text/css"/>

	<!-- Custom CSS -->
	<link href="dist/css/style.css" rel="stylesheet" type="text/css">
@endsection()

@section('content')  
<div class="container-fluid pt-25">
	
	<!-- Row -->
	<div class="row">
		<div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
			<div class="panel panel-default card-view">
				<div class="panel-heading">
					<div class="pull-left">
						<h6 class="panel-title txt-dark">Recent Posts</h6>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
						@include('posts.latest-posts')
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
			<div class="panel panel-default card-view panel-refresh">
				<div class="refresh-container">
					<div class="la-anim-1"></div>
				</div>
				<div class="panel-heading">
					<div class="pull-left">
						<h6 class="panel-title txt-dark">top 5 places</h6>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-wrapper collapse in">
					<div class="panel-body row">
						<div class="col-sm-6 pa-0">
							<canvas id="chart_7" height="164"></canvas>
						</div>
						<div class="col-sm-6 pr-0 pt-25">
							<div class="label-chatrs">
								<div class="mb-5">
									<span class="clabels inline-block bg-yellow mr-5"></span>
									<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Tagaytay City</span>
								</div>
								<div class="mb-5">
									<span class="clabels inline-block bg-pink mr-5"></span>
									<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Baguio City</span>
								</div>
								<div class="mb-5">
									<span class="clabels inline-block bg-blue mr-5"></span>
									<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Vigan City</span>
								</div>
								<div class="mb-5">
									<span class="clabels inline-block bg-red mr-5"></span>
									<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Cebu City</span>
								</div>	
								<div class="">
									<span class="clabels inline-block bg-green mr-5"></span>
									<span class="clabels-text font-12 inline-block txt-dark capitalize-font">La Union</span>
								</div>												
							</div>
						</div>										
					</div>	
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
			<div class="panel panel-default card-view pt-0">
				<div class="panel-wrapper collapse in">
					<div class="panel-body pa-0">
						<div class="sm-data-box bg-white">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-6 text-left pl-0 pr-0 data-wrap-left">
										<span class="txt-dark block counter"><span class="counter-anim">15,678</span></span>
										<span class="block"><span class="weight-500 uppercase-font txt-grey font-13">Visits</span><i class="zmdi zmdi-caret-down txt-danger font-21 ml-5 vertical-align-middle"></i></span>
									</div>
									<div class="col-xs-6 text-left  pl-0 pr-0 pt-25 data-wrap-right">
										<div id="sparkline_4" style="width: 100px; overflow: hidden; margin: 0px auto;"></div>
									</div>
								</div>	
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default card-view pt-0">
				<div class="panel-wrapper collapse in">
					<div class="panel-body pa-0">
						<div class="sm-data-box bg-white">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-6 text-left pl-0 pr-0 data-wrap-left">
										<span class="txt-dark block counter"><span class="counter-anim">142,357</span></span>
										<span class="block"><span class="weight-500 uppercase-font txt-grey font-13">Posts</span><i class="zmdi zmdi-caret-down txt-danger font-21 ml-5 vertical-align-middle"></i></span>
									</div>
									<div class="col-xs-6 text-left  pl-0 pr-0 pt-25 data-wrap-right">
										<div id="sparkline_6" style="width: 100px; overflow: hidden; margin: 0px auto;"></div>
									</div>
								</div>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Row -->
	
	<!-- Row -->
	<div class="row">
		
	</div>
	<!-- /Row -->
</div>
@endsection()

@section('script')	
	<!-- JavaScript -->

	<!-- jQuery -->
	<script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

	<!-- Data table JavaScript -->
	<script src="vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>

	<!-- Slimscroll JavaScript -->
	<script src="dist/js/jquery.slimscroll.js"></script>

	<!-- simpleWeather JavaScript -->
	<script src="vendors/bower_components/moment/min/moment.min.js"></script>
	<script src="vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
	<script src="dist/js/simpleweather-data.js"></script>

	<!-- Progressbar Animation JavaScript -->
	<script src="vendors/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="vendors/bower_components/jquery.counterup/jquery.counterup.min.js"></script>

	<!-- Fancy Dropdown JS -->
	<script src="dist/js/dropdown-bootstrap-extended.js"></script>

	<!-- Sparkline JavaScript -->
	<script src="vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script>

	<!-- Owl JavaScript -->
	<script src="vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>

	<!-- ChartJS JavaScript -->
	<script src="vendors/chart.js/Chart.min.js"></script>

	<!-- EasyPieChart JavaScript -->
	<script src="vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
	<!-- Morris Charts JavaScript -->
	<script src="vendors/bower_components/raphael/raphael.min.js"></script>
	<script src="vendors/bower_components/morris.js/morris.min.js"></script>
	<script src="vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>

	<!-- Switchery JavaScript -->
	<script src="vendors/bower_components/switchery/dist/switchery.min.js"></script>

	<!-- Bootstrap Select JavaScript -->
	<script src="vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

	<!-- Init JavaScript -->
	<script src="dist/js/init.js"></script>
	<script src="dist/js/ecommerce-data.js"></script>

	@include('includes.message-block')
@endsection()

