@extends('layouts.main')

@section('meta')
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="description" content="Libot Philippines about page, we creates socially responsible travel experiences thus, making it more convenient to find travel packages and renting a car for everyone." />
	<meta name="keywords" content="libot, libot philippines, travel, libot travel, rent, about us" />
	<meta name="author" content="libot-ph"/>

	<meta property="fb:app_id"      content="1236189279823899" />
    <meta property="og:url"           content="{{ url()->current() }}" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="Libot Philippines  -  {{ $itinerary->title }}" />
	<meta property="og:description"   content="{{ $itinerary->body }}" />
	<meta property="og:image"         content="{{ URL::to('images/libot.png')}}" />
@endsection()

@section('title')
	{{ $itinerary->title }}
@endsection

@section('css')
	<!-- Data table CSS -->
	<link href="vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>

	<!-- Custom CSS -->
	<link href="dist/css/style.css" rel="stylesheet" type="text/css">

	<link href="vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">

	<style type="text/css">
		#body {
		    white-space: pre;
		}
	</style>
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
					<li><a href="{{ route('itinerary', ['user_id' => $itinerary->user_id]) }}">Itinerary List</a></li>
					<li class="active"><span>Itinerary</span></li>
				</ol>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->
		<div class="row itinerary" data-itineraryid="{{ $itinerary->id }}">
			<div class="col-md-12">
				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="text-center">
							<h6 class="panel-title txt-dark" id="title">{{ $itinerary->title }}</h6>
							<div id="fb-root"></div>
							<script>(function(d, s, id) {
							    var js, fjs = d.getElementsByTagName(s)[0];
							    if (d.getElementById(id)) return;
							    js = d.createElement(s); js.id = id;
							    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId=1236189279823899&autoLogAppEvents=1";
							    fjs.parentNode.insertBefore(js, fjs);
							 	}(document, 'script', 'facebook-jssdk'));
							</script>

							<!-- Your share button code -->
							<div class="fb-share-button" data-href="{{ url()->current() }}" data-layout="button_count"></div>
						</div>
						<div class="clearfix"></div>
					</div>
					<hr class="light-grey-hr mb-10"/>
					<div  class="panel-wrapper collapse in">
						<div  class="panel-body pl-15">
							<p class="pb-15">Location: <span id="location">{{ $itinerary->location }}</span></p>
							<p><span>Itinerary details:</span></p>
							<p><span id="body">{{ $itinerary->body }}</span></p>
						</div>
					</div>
					<div class="interaction mr-10 mb-20">								
						@if(Auth::user() == $itinerary->user)
							<div class="btn-group mr-10">
								<a class="edit btn btn-success btn-anim"><i class="fa fa-pencil"></i><span class="btn-text">Edit</span></a>
							</div>
							<div class="btn-group mr-10">
								<a href="{{ route('delete.itinerary', ['itinerary_id' => $itinerary->id]) }}" class="btn btn-danger btn-anim" onclick="return confirm('Are you sure?')"><i class="fa fa-minus-square-o"></i><span class="btn-text">Delete</span></a>
							</div>
						@endif											
					</div>
				</div>
			</div>			
		</div>	

	</div>
	<!-- Edit Modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Edit Itinerary</h4>
				</div>
				<form action="" method="POST" id="edit-itinerary-form">
					<div class="modal-body">						
						<div class="form-group">
							<label for="itinerary-title">Title</label>
							<input type="text" name="itinerary-title" id="itinerary-title" rows="5" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="post-location">Location</label>
							<input type="text" name="post-location" id="post-location" rows="5" class="form-control typeahead" required="" autocomplete="disabled">
						</div>
						<div class="form-group">
							<label for="itinerary-body">Details</label>
							<textarea name="itinerary-body" id="itinerary-body" rows="5" class="form-control" required=""></textarea>
						</div>										
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<input type="submit" class="btn btn-primary" id="modal-save" value="Save Changes" />
					</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
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

	<script type="text/javascript">
		var token = '{{ Session::token() }}';
		var urlEdit = '{{ route('edit.itinerary') }}';
	</script>

	<script type="text/javascript" src="{{ URL::to('js/itinerary.js')}}"></script>

	@include('includes.message-block')
	@include('includes.places-autocomplete')
@endsection()