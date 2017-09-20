@extends('layouts.main')

@section('title')
Dashboard
@endsection

@section('css')
	<!-- Morris Charts CSS -->
    <link href="vendors/bower_components/morris.js/morris.css" rel="stylesheet" type="text/css"/>
	
	<!-- Data table CSS -->
	<link href="vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
	
	<link href="vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
		
	<!-- Custom CSS -->
	<link href="dist/css/style.css" rel="stylesheet" type="text/css">

	<!-- File Upload CSS -->
	<link href="{{ URL::to('plugins/file-upload/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css" />
@endsection()

@section('content')  
            <div class="container-fluid pt-25">
				
				<!-- Row -->
				<div class="row">
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                       <div class="panel panel-default card-view panel-refresh">
							<div class="refresh-container">
								<div class="la-anim-1"></div>
							</div>
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">What do you have?</h6>
								</div>							
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<form action="{{ route('post.create') }}" method="post"  enctype="multipart/form-data">
										<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
											<input type="text" class="form-control" placeholder="Title" aria-describedby="basic-addon2" name="title" id="title" value="{{ Request::old('title') }}" required="">
										</div>
										<div class="form-group {{ $errors->has('capacity') ? 'has-error' : '' }}">
											<input type="number" class="form-control" placeholder="Capacity" aria-describedby="basic-addon2" name="capacity" id="capacity" value="{{ Request::old('capacity') }}" required="">
										</div>
										<div class="form-group {{ $errors->has('contact_no') ? 'has-error' : '' }}">
											<input type="text" class="form-control" placeholder="Contact No (Eg. 09051234567)" aria-describedby="basic-addon2" name="contact_no" id="contact_no" value="{{ Request::old('contact_no') }}" required="">
										</div>
										<div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
											<input type="text" class="form-control" placeholder="Destination" aria-describedby="basic-addon2" name="location" id="location" value="{{ Request::old('location') }}" autocomplete="off" required="">
										</div>
										<div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
											<textarea  class="form-control" name="body" id="new-post" rows="5" placeholder="Other details (Eg. Toyota Hiace, Trip to Tagaytay.)" required="">{{ Request::old('body') }}</textarea>				
										</div>
										<div class="form-group">
											<label for="input-id">Photo (must be a valid image file)</label>
											{{-- <input type="file" name="image" class="form-control" id="image"> --}}
											<input name="image" id="input-id" type="file" class="file" data-preview-file-type="text">
										</div>
										{{-- onclick="this.disabled=true;this.form.submit();" --}}
										<button type="submit" class="btn btn-success pull-left">Create Post</button>
										<input type="hidden" name="_token" value="{{ Session::token() }}">
									</form>
								</div>	
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Your recent post</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
                                <div class="panel-body">
									<div id="morris_extra_line_chart" class="morris-chart" style="height:293px;"></div>
									<ul class="flex-stat mt-40">
										<li>
											<span class="block">Weekly Users</span>
											<span class="block txt-dark weight-500 font-18"><span class="counter-anim">3,24,222</span></span>
										</li>
										<li>
											<span class="block">Monthly Users</span>
											<span class="block txt-dark weight-500 font-18"><span class="counter-anim">1,23,432</span></span>
										</li>
										<li>
											<span class="block">Trend</span>
											<span class="block">
												<i class="zmdi zmdi-trending-up txt-success font-24"></i>
											</span>
										</li>
									</ul>
								</div>
							</div>
                        </div>
                    </div>
				</div>
				<!-- /Row -->
				
				<!-- Row -->
				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box bg-red">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
													<span class="txt-light block counter"><span class="counter-anim">914,001</span></span>
													<span class="weight-500 uppercase-font txt-light block font-13">visits</span>
												</div>
												<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
													<i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box bg-yellow">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
													<span class="txt-light block counter"><span class="counter-anim">46.41</span>%</span>
													<span class="weight-500 uppercase-font txt-light block">bounce rate</span>
												</div>
												<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
													<i class="zmdi zmdi-redo txt-light data-right-rep-icon"></i>
												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box bg-green">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
													<span class="txt-light block counter"><span class="counter-anim">4,054,876</span></span>
													<span class="weight-500 uppercase-font txt-light block">pageviews</span>
												</div>
												<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
													<i class="zmdi zmdi-file txt-light data-right-rep-icon"></i>
												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box bg-blue">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
													<span class="txt-light block counter"><span class="counter-anim">46.43</span>%</span>
													<span class="weight-500 uppercase-font txt-light block">growth rate</span>
												</div>
												<div class="col-xs-6 text-center  pl-0 pr-0 pt-25  data-wrap-right">
													<div id="sparkline_4" style="width: 100px; overflow: hidden; margin: 0px auto;"></div>
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
					<div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
						<div class="panel panel-default card-view panel-refresh">
							<div class="refresh-container">
								<div class="la-anim-1"></div>
							</div>
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">social campaigns</h6>
								</div>
								<div class="pull-right">
									<a href="#" class="pull-left inline-block refresh mr-15">
										<i class="zmdi zmdi-replay"></i>
									</a>
									<a href="#" class="pull-left inline-block full-screen mr-15">
										<i class="zmdi zmdi-fullscreen"></i>
									</a>
									<div class="pull-left inline-block dropdown">
										<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="zmdi zmdi-more-vert"></i></a>
										<ul class="dropdown-menu bullet dropdown-menu-right"  role="menu">
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i>Edit</a></li>
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i>Delete</a></li>
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i>New</a></li>
										</ul>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body row pa-0">
									<div class="table-wrap">
										<div class="table-responsive">
											<table class="table table-hover mb-0">
												<thead>
													<tr>
														<th>Campaign</th>
														<th>Client</th>
														<th>Changes</th>
														<th>Budget</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><span class="txt-dark weight-500">Facebook</span></td>
														<td>Beavis</td>
														<td><span class="txt-success"><i class="zmdi zmdi-caret-up mr-10 font-20"></i><span>2.43%</span></span></td>
														<td>
															<span class="txt-dark weight-500">$1478</span>
														</td>
														<td>
															<span class="label label-primary">Active</span>
														</td>
													</tr>
													<tr>
														<td><span class="txt-dark weight-500">Youtube</span></td>
														<td>Felix</td>
														<td><span class="txt-success"><i class="zmdi zmdi-caret-up mr-10 font-20"></i><span>1.43%</span></span></td>
														<td>
															<span class="txt-dark weight-500">$951</span>
														</td>
														<td>
															<span class="label label-danger">Closed</span>
														</td>
													</tr>
													<tr>
														<td><span class="txt-dark weight-500">Twitter</span></td>
														<td>Cannibus</td>
														<td><span class="txt-danger"><i class="zmdi zmdi-caret-down mr-10 font-20"></i><span>-8.43%</span></span></td>
														<td>
															<span class="txt-dark weight-500">$632</span>
														</td>
														<td>
															<span class="label label-default">Hold</span>
														</td>
													</tr>
													<tr>
														<td><span class="txt-dark weight-500">Spotify</span></td>
														<td>Neosoft</td>
														<td><span class="txt-success"><i class="zmdi zmdi-caret-up mr-10 font-20"></i><span>7.43%</span></span></td>
														<td>
															<span class="txt-dark weight-500">$325</span>
														</td>
														<td>
															<span class="label label-default">Hold</span>
														</td>
													</tr>
													<tr>
														<td><span class="txt-dark weight-500">Instagram</span></td>
														<td>Hencework</td>
														<td><span class="txt-success"><i class="zmdi zmdi-caret-up mr-10 font-20"></i><span>9.43%</span></span></td>
														<td>
															<span class="txt-dark weight-500">$258</span>
														</td>
														<td>
															<span class="label label-primary">Active</span>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>	
								</div>	
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
						<div class="panel panel-default card-view panel-refresh">
							<div class="refresh-container">
								<div class="la-anim-1"></div>
							</div>
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Advertising & Promotions</h6>
								</div>
								<div class="pull-right">
									<a href="#" class="pull-left inline-block refresh mr-15">
										<i class="zmdi zmdi-replay"></i>
									</a>
									<div class="pull-left inline-block dropdown">
										<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="zmdi zmdi-more-vert"></i></a>
										<ul class="dropdown-menu bullet dropdown-menu-right"  role="menu">
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i>option 1</a></li>
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i>option 2</a></li>
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i>option 3</a></li>
										</ul>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div>
										<canvas id="chart_2" height="253"></canvas>
									</div>	
									<div class="label-chatrs mt-30">
										<div class="inline-block mr-15">
											<span class="clabels inline-block bg-yellow mr-5"></span>
											<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Active</span>
										</div>
										<div class="inline-block mr-15">
											<span class="clabels inline-block bg-red mr-5"></span>
											<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Closed</span>
										</div>	
										<div class="inline-block">
											<span class="clabels inline-block bg-green mr-5"></span>
											<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Hold</span>
										</div>											
									</div>
								</div>
							</div>	
						</div>	
					</div>	
				</div>	
				<!-- Row -->
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
	
	<!-- Morris Charts JavaScript -->
    <script src="vendors/bower_components/raphael/raphael.min.js"></script>
    <script src="vendors/bower_components/morris.js/morris.min.js"></script>
    <script src="vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
	
	<!-- Switchery JavaScript -->
	<script src="vendors/bower_components/switchery/dist/switchery.min.js"></script>
	
	<!-- Init JavaScript -->
	<script src="dist/js/init.js"></script>
	<script src="dist/js/dashboard-data.js"></script>

	<!-- File Upload -->
	<script src="{{ URL::to('plugins/file-upload/js/plugins/piexif.min.js')}}" type="text/javascript"></script>
	<script src="{{ URL::to('plugins/file-upload/js/plugins/sortable.min.js')}}" type="text/javascript"></script>
	<script src="{{ URL::to('plugins/file-upload/js/plugins/purify.min.js')}}" type="text/javascript"></script>
	<script src="{{ URL::to('plugins/file-upload/js/fileinput.min.js')}}" type="text/javascript"></script>

	@include('includes.message-block')
	@include('includes.places-autocomplete')
@endsection()

