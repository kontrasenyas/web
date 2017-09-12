<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>@yield('title')</title>
    <meta name="description" content="Magilla is a Dashboard & Admin Site Responsive Template by hencework." />
    <meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Magilla Admin, Magillaadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
    <meta name="author" content="hencework"/>

    <base href="{{ URL::to('/') }}">
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    
    <!-- Morris Charts CSS -->
    <link href="{{ URL::to('vendors/bower_components/morris.js/morris.css') }}" rel="stylesheet" type="text/css"/>
    
    <!-- vector map CSS -->
    <link href="{{ URL::to('vendors/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" type="text/css"/>
    
    <!-- Calendar CSS -->
    <link href="{{ URL::to('vendors/bower_components/fullcalendar/dist/fullcalendar.css') }}" rel="stylesheet" type="text/css"/>
        
    <!-- Data table CSS -->
    <link href="{{ URL::to('vendors/bower_components/datatables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
    
    <!-- Custom CSS -->
    <link href="{{ URL::to('dist/css/style.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
	<!--Preloader-->
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <!--/Preloader-->

    <!-- #wrapper -->
    <div class="wrapper theme-1-active pimary-color-red">
    	@include('layouts.partials.top-menu-items')
    	@include('layouts.partials.right-sidebar')
    	@include('layouts.partials.left-sidebar')

    	<!-- Main Content -->
    	<div class="page-wrapper">
    		@yield('content')

    		<!-- Footer -->
			<footer class="footer container-fluid pl-30 pr-30">
			    <div class="row">
			        <div class="col-sm-12">
			            <p>2017 &copy; Libot. Created by Joseph Alcantara</p>
			        </div>
			    </div>
			</footer>
			<!-- /Footer -->

    	</div>
    	<!-- /Main Content -->
    </div>
	<!-- /#wrapper -->
    
    <!-- JavaScript -->
    
    <!-- jQuery -->
    <script src="{{ URL::to('vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ URL::to('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    
    <!-- Vector Maps JavaScript -->
    <script src="{{ URL::to('vendors/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ URL::to('vendors/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ URL::to('dist/js/vectormap-data.js') }}"></script>
    
    <!-- Calender JavaScripts -->
    <script src="{{ URL::to('vendors/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ URL::to('vendors/jquery-ui.min.js') }}"></script>
    <script src="{{ URL::to('vendors/bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ URL::to('dist/js/fullcalendar-data.js') }}"></script>
    
    <!-- Counter Animation JavaScript -->
    <script src="{{ URL::to('vendors/bower_components/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ URL::to('vendors/bower_components/jquery.counterup/jquery.counterup.min.js') }}"></script>
    
    <!-- Data table JavaScript -->
    <script src="{{ URL::to('vendors/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    
    <!-- Slimscroll JavaScript -->
    <script src="{{ URL::to('dist/js/jquery.slimscroll.js') }}"></script>
    
    <!-- Fancy Dropdown JS -->
    <script src="{{ URL::to('dist/js/dropdown-bootstrap-extended.js') }}"></script>
    
    <!-- Sparkline JavaScript -->
    <script src="{{ URL::to('vendors/jquery.sparkline/dist/jquery.sparkline.min.js') }}"></script>
    
    <script src="{{ URL::to('vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ URL::to('dist/js/skills-counter-data.js') }}"></script>
    
    <!-- Morris Charts JavaScript -->
    <script src="{{ URL::to('vendors/bower_components/raphael/raphael.min.js') }}"></script>
    <script src="{{ URL::to('vendors/bower_components/morris.js/morris.min.js') }}"></script>
    <script src="{{ URL::to('dist/js/morris-data.js') }}"></script>
    
    <!-- Owl JavaScript -->
    <script src="{{ URL::to('vendors/bower_components/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    
    <!-- Switchery JavaScript -->
    <script src="{{ URL::to('vendors/bower_components/switchery/dist/switchery.min.js') }}"></script>
    
    <!-- Data table JavaScript -->
    <script src="{{ URL::to('vendors/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        
    <!-- Gallery JavaScript -->
    <script src="{{ URL::to('dist/js/isotope.js') }}"></script>
    <script src="{{ URL::to('dist/js/lightgallery-all.js') }}"></script>
    <script src="{{ URL::to('dist/js/froogaloop2.min.js') }}"></script>
    <script src="{{ URL::to('dist/js/gallery-data.js') }}"></script>
    
    <!-- Spectragram JavaScript -->
    <script src="{{ URL::to('dist/js/spectragram.min.js') }}"></script>
    
    <!-- Init JavaScript -->
    <script src="{{ URL::to('dist/js/init.js') }}"></script>
    <script src="{{ URL::to('dist/js/widgets-data.js') }}"></script>

</body>

</html>