@extends('layouts.main')

@section('meta')
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="Libot Philippines, we creates socially responsible travel experiences thus, making it more convenient to find travel packages and renting a car for everyone." />
    <meta name="keywords" content="libot, libot philippines, travel, libot travel, rent" />
    <meta name="author" content="libot-ph"/>

    <meta property="og:url"           content="{{ url()->current() }}" />
    <meta property="og:type"          content="website" />
	<meta property="og:title"         content="Libot Philippines" />
	<meta property="og:description"   content="Libot Philippines, we creates socially responsible travel experiences thus, making it more convenient to find travel packages and renting a car for everyone." />
	<meta property="og:image"         content="{{ URL::to('images/libot.png') }}" />
@endsection()

@section('title')
Libot Philippines
@endsection

@section('css')
<noscript id="deferred-styles">
      
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
</noscript>
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
		{{-- <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
			<div class="panel panel-default card-view pt-0">
				<div class="panel-wrapper collapse in">
					<div class="panel-body pa-0">
						<div class="sm-data-box bg-white">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-6 text-left pl-0 pr-0 data-wrap-left">
										<span class="txt-dark block counter"><span class="counter-anim">{{ $posts->total() }}</span></span>
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
		</div> --}}
		<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
			<div class="panel panel-default card-view pt-0">
				<div class="panel-wrapper collapse in">
					<div class="panel-body pa-0">
						<div class="sm-data-box bg-white">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-6 text-left pl-0 pr-0 data-wrap-left">
										<div class="col-md-12 text-center">
                                        	<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Flibotph%2F&tabs&width=340&height=154&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=1428793614008809" width="340" height="154" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                                        </div>
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
	<script>
      var loadDeferredStyles = function() {
        var addStylesNode = document.getElementById("deferred-styles");
        var replacement = document.createElement("div");
        replacement.innerHTML = addStylesNode.textContent;
        document.body.appendChild(replacement)
        addStylesNode.parentElement.removeChild(addStylesNode);
      };
      var raf = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
          window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
      if (raf) raf(function() { window.setTimeout(loadDeferredStyles, 0); });
      else window.addEventListener('load', loadDeferredStyles);
    </script>

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

