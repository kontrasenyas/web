@extends('layouts.main')

@section('meta')
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="Libot Philippines about page, we creates socially responsible travel experiences thus, making it more convenient to find travel packages and renting a car for everyone." />
    <meta name="keywords" content="libot, libot philippines, travel, libot travel, rent, about us" />
    <meta name="author" content="libot-ph"/>
@endsection()

@section('title')
Create Itinerary
@endsection

@section('css')
	<!-- Data table CSS -->
	<link href="vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
	
	<!-- Custom CSS -->
	<link href="dist/css/style.css" rel="stylesheet" type="text/css">

	<link href="vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
@endsection()

@section('content')    
            <div class="container-fluid">
				
				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<h5 class="txt-dark">Itinerary</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						<ol class="breadcrumb">
							<li><a href="{{ route('home') }}">Home</a></li>
							<li><a href="{{ route('itinerary', ['user_id' => Auth::user()->id ]) }}"><span>Itinerary List</span></a></li>
							<li class="active"><span>Create Itinerary</span></li>
						</ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->
				<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="text-center">
										<h6 class="panel-title txt-dark">Create Itinerary</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<hr class="light-grey-hr mb-10"/>
								<div  class="panel-wrapper collapse in">
									<div  class="panel-body text-center pl-15">
										<form action="{{ route('post.itinerary') }}" method="post"  enctype="multipart/form-data">
											<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
												<input type="text" class="form-control" placeholder="Title" aria-describedby="basic-addon2" name="title" id="title" value="{{ Request::old('title') }}" required="">
											</div>
											<div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
												<input type="text" class="form-control" placeholder="Location" aria-describedby="basic-addon2" name="location" id="location" value="{{ Request::old('location') }}" autocomplete="disabled" required="">
											</div>
											<div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
												<textarea  class="form-control" name="body" id="new-post" rows="5" placeholder="More details (Eg. Toyota Hiace, Trip to Tagaytay.)" required="">{{ Request::old('body') }}</textarea>				
											</div>
											<input type="submit" class="btn btn-success pull-left" value="Create Post" />
											<input type="hidden" name="_token" value="{{ Session::token() }}">
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>	
			
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
	<script src="dist/js/dataTables-data.js"></script>
	
	<!-- Slimscroll JavaScript -->
	<script src="dist/js/jquery.slimscroll.js"></script>
	
	<!-- Owl JavaScript -->
	<script src="vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
	
	<!-- Switchery JavaScript -->
	<script src="vendors/bower_components/switchery/dist/switchery.min.js"></script>
	
	<!-- Fancy Dropdown JS -->
	<script src="dist/js/dropdown-bootstrap-extended.js"></script>
	
	<!-- Init JavaScript -->
	<script src="dist/js/init.js"></script>
    
    @include('includes.message-block')
	@include('includes.places-autocomplete')
@endsection()