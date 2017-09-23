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

	<!-- Post image style -->
	<style type="text/css">
		.img-preview {
			width: 200px;
			height: 150px; 
			overflow: hidden;
			margin-bottom: 0px;
		}
		.new-post {
			padding: 16px 0;
			border-bottom: 1px solid #ccc;
		}

		.new-post header,
		.posts header {
			margin: 20px;
		}

		.posts .post {
			padding-left: 0px;
			border-left: 3px solid #a21b24;
		}

		.posts .post .info {
			color: #aaa;
			font-style: italic;
		}

		.div_hover { background-color: #f8f8f8; }

		.div_hover:hover { background-color: #eff0f1; }

	    #div-post{
	        /*Important:*/
	        position:relative;
	    }

	    #div-post:hover { background-color: #eff0f1; }
	    /*Important:*/
	    .link-spanner{
	        position:absolute; 
	        width:100%;
	        height:100%;
	        top:0;
	        left: 0;
	        z-index: 1;

	        /* edit: fixes overlap error in IE7/8, 
	        make sure you have an empty gif 
	        background-image: url('empty.gif');*/
	    }   
	</style>
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
									<div id="morris_extra_line_chart" class="morris-chart hidden" style="height:293px;"></div>
									<ul class="flex-stat mt-40 hidden">
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

									@if(count($posts) == 0)               
							            @if(Auth::user())
											<h4>You don't have any post at the moment</h4><br/>
											<label for="title"><span class="glyphicon glyphicon-arrow-left"></span> Create your first post. </label>
							            @endif
							        @endif
							        <div class="posts">
							        @foreach($posts as $post)
							        	<div class="form-group div_hover col-md-12">                    
								            <div class="post row" data-postid="{{ $post->id }}">
								                <div class="col-md-6">
								                    <h4 class="body text-uppercase">{{ $post->title }}</h4>                
								                    <div class="info">
								                        <p class="body text-uppercase">{{ str_limit($post->location, $limit = 22, $end = '...') }}</p>
								                        <p>Posted by {{ $post->user->first_name }} {{ $post->created_at->diffForHumans() }}</p>
								                        <p>Contact No: {{ $post->user->mobile_no }}</p>
								                        <p>Description: {{ str_limit($post->body, $limit = 15, $end = '...') }}</p>
								                        <span class="text-muted">{{ $post->view_count }} views</span>
								                    </div>
								                </div>
								                <div class="col-md-6">
								                    <img src="{{ route('post.image', ['filename' => $post->image_name]) }}" alt=""
								                    class="img-responsive center-block img-preview">
								                </div>
								            </div>
								            <a href="{{ route('post.get', ['post_id' => $post->id]) }}"><span class="link-spanner"></span></a>
								        </div>
							        @endforeach()
							    	</div>
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
													<span class="txt-light block counter"><span class="counter-anim">{{$posts->total()}}</span></span>
													<span class="weight-500 uppercase-font txt-light block">total posts</span>
												</div>
												<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
													<i class="zmdi zmdi-redo txt-light data-right-rep-icon"></i>
												</div>
												<a href="{{ route('user-post', ['user_id' => Auth::user()->id]) }}"><span class="link-spanner"></span></a>
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
													<span class="txt-light block counter"><span class="counter-anim">{{$posts->sum('view_count')}}</span></span>
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

