@extends('layouts.main')

@section('meta')
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="Libot Philippines dashboard page, we creates socially responsible travel experiences thus, making it more convenient to find travel packages and renting a car for everyone." />
    <meta name="keywords" content="libot, libot philippines, travel, libot travel, rent, dashboard" />
    <meta name="author" content="libot-ph"/>
@endsection()

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
	<link href="{{ URL::to('css/post.css')}}" media="all" rel="stylesheet" type="text/css" />

	<!-- Bootstrap Dropify CSS -->
    <link href="vendors/bower_components/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css"/>

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
									<form id="post_dashboard" action="{{ route('post.create') }}" method="post"  enctype="multipart/form-data">
										<div class="form-group">											
											<div class="radio-list">
												<div class="radio-inline pl-0">
													<span class="radio radio-info">
														<input type="radio" name="radio_type" id="radio_rental" value="rental" @if(Request::old('radio_type') == 'rental') checked @endif required>
														<label for="radio_rental">Rental</label>
													</span>
												</div>
												<div class="radio-inline">
													<span class="radio radio-info">
														<input type="radio" name="radio_type" id="radio_package" value="package" @if(Request::old('radio_type') == 'package' ) checked @endif required>
														<label for="radio_package">Travel Package</label>
													</span>
												</div>
											</div>
										</div>
										<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
											<input type="text" class="form-control" placeholder="Title" aria-describedby="basic-addon2" name="title" id="title" value="{{ Request::old('title') }}" required="">
										</div>
										<div class="form-group {{ $errors->has('capacity') ? 'has-error' : '' }}">
											<input type="number" class="form-control" placeholder="Capacity" aria-describedby="basic-addon2" name="capacity" id="capacity" value="{{ Request::old('capacity') }}" required="">
										</div>
										<div class="form-group {{ $errors->has('contact_no') ? 'has-error' : '' }}">
											<input type="text" class="form-control" placeholder="Contact No (Eg. 09171234567)" aria-describedby="basic-addon2" name="contact_no" id="contact_no" value="{{ Request::old('contact_no') }}" pattern=".{11,}" required title="Valid Mobile number Ex. 09171234567">
										</div>
										<div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
											<input type="text" class="form-control location" placeholder="Location" aria-describedby="basic-addon2" name="location" id="location" value="{{ Request::old('location') }}" autocomplete="disabled" required="">
										</div>
										<div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
											<textarea  class="form-control" name="body" id="new-post" rows="5" placeholder="More details (Eg. Toyota Hiace, Trip to Tagaytay.)" required="">{{ Request::old('body') }}</textarea>				
										</div>
										<div class="form-group">
											<label for="input-id">Add photo (must be a valid image file)</label>
											{{-- <input type="file" name="image" class="form-control" id="image"> --}}
											<input name="images[]" id="input-id" type="file" class="file" data-preview-file-type="text" multiple>
											{{-- <input name="image" id="input-id" type="file" class="file" data-preview-file-type="text"> --}}
										</div>
										{{-- onclick="this.disabled=true;this.form.submit();" --}}
										<input id="create_post" type="submit" class="btn btn-success pull-left" value="Create Post" />
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
                                <div class="panel-body" style="padding-bottom: 0px !important;">
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
											<label for="title" class="mb-20"><span class="glyphicon glyphicon-arrow-left"></span> Create your first post. </label>
							            @endif
							        @endif
							        <div class="posts">
							        @foreach($posts as $post)
							        	<div class="form-group div_hover col-md-12">                    
								            <div class="post row" data-postid="{{ $post->id }}">
								                <div class="col-md-6">
								                    <h4 class="body text-uppercase">{{ str_limit($post->title, $limit = 15, $end = '...') }}</h4>                
								                    <div class="info">
								                    	<p class="panel-title">{{ $post->type }}</p>
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
					{{-- <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
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
					</div>				 --}}	
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

	<!-- Form Flie Upload Data JavaScript -->
    <script src="dist/js/form-file-upload-data.js"></script>
    
    <!-- Bootstrap Daterangepicker JavaScript -->
    <script src="vendors/bower_components/dropify/dist/js/dropify.min.js"></script>

	@include('includes.message-block')

	<script type="text/javascript">
		$('#post_dashboard').on('submit', function () {
			$('#create_post').attr('disabled','disabled')
		})
	</script>
@endsection()

