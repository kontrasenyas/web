@extends('layouts.main')

@section('meta')
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="Libot Philippines about page, we creates socially responsible travel experiences thus, making it more convenient to find travel packages and renting a car for everyone." />
    <meta name="keywords" content="libot, libot philippines, travel, libot travel, rent, about us" />
    <meta name="author" content="libot-ph"/>
@endsection()

@section('title')
    @if(Auth::user() && Auth::user()->id == $user->id)
        My Itinerary List
    @endif
    @if(!Auth::user() || Auth::user()->id != $user->id)
        {{ $user->first_name }}'s Itinerary List
    @endif
@endsection

@section('css')
	<!-- Data table CSS -->
	<link href="vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
	
	<!-- Custom CSS -->
	<link href="dist/css/style.css" rel="stylesheet" type="text/css">

	<link href="vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">

	<style type="text/css">
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
	    }   
    </style>
@endsection()

@section('content')    
            <div class="container-fluid">
				
				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<h5 class="txt-dark">Itinerary List</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						<ol class="breadcrumb">
							<li><a href="{{ route('home') }}">Home</a></li>
							<li class="active"><span>Itinerary List</span></li>
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
										<h6 class="panel-title txt-dark pb-15">											
										    @if(Auth::user() && Auth::user()->id == $user->id)
										        My Itinerary List
										    @endif
										    @if(!Auth::user() || Auth::user()->id != $user->id)
										        {{ $user->first_name }}'s Itinerary List
										    @endif										    
										</h6>
										@if(Auth::user() && Auth::user()->id == $user->id)
											<span><a href="{{ route('create-itinerary') }}" class="text-success"><i class="fa fa-plus-square"></i> Create Itinerary</a></span>
										@endif()
									</div>
									<div class="clearfix"></div>
								</div>
								<hr class="light-grey-hr mb-10"/>
								<div  class="panel-wrapper collapse in">
									<div  class="panel-body text-center pl-15">
										@if(count($itinerary_list) == 0)
	                                        @if(!Auth::user() || Auth::user()->id != $user->id)
	                                            <h4>This user doesn't have any itinerary at the moment</h4>
	                                        @endif
	                                        @if(Auth::user() && Auth::user()->id == $user->id)
	                                            <h4>You don't have any itinerary at the moment</h4>	                                            
	                                        @endif
	                                    @endif
										@foreach($itinerary_list as $itinerary)
											<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" data-postid="{{ $itinerary->id }}"> 
		                                        <div class="panel panel-primary contact-card card-view" id="div-post">
		                                            <div class="panel-heading">
		                                                <div class="pull-left">
		                                                    {{-- <div class="pull-left user-img-wrap mr-15">
		                                                        <img class="card-user-img img-circle pull-left" src="{{ route('post.image', ['filename' => $post->image_name]) }}" alt="user"/>
		                                                    </div> --}}
		                                                    <div class="pull-left user-detail-wrap">    
		                                                        <span class="block card-user-name">
		                                                            {{ str_limit($itinerary->title, $limit = 15, $end = '...') }}
		                                                        </span>
		                                                    </div>
		                                                </div>
		                                                <div class="clearfix"></div>
		                                            </div>
		                                            <div class="panel-wrapper collapse in">
		                                                <div class="panel-body row text-left">
		                                                    <div class="user-others-details pl-15 pr-15">
		                                                        <div class="mb-15">
		                                                            <i class="zmdi inline-block mr-10">Location:</i>
		                                                            <span class="inline-block txt-dark">{{ str_limit($itinerary->location, $limit = 22, $end = '...') }}</span>
		                                                        </div>                        
		                                                        <div class="mb-15">
		                                                            <i class="zmdi inline-block mr-10">Description:</i>
		                                                            <span class="inline-block txt-dark">{{ str_limit($itinerary->body, $limit = 15, $end = '...') }}</span>
		                                                        </div>
		                                                    </div>
		                                                    <hr class="light-grey-hr mt-20 mb-20"/>
		                                                    <div class="emp-detail pl-15 pr-15">                        
		                                                        {{-- <div>
		                                                            <span class="inline-block capitalize-font mr-5">posted by:</span>
		                                                            <span class="txt-dark">{{ $post->user->first_name }} {{ $post->created_at->diffForHumans() }}</span>
		                                                        </div>
		                                                        <div class="mb-5">
		                                                            <span class="inline-block capitalize-font mr-5">{{ $post->view_count }} views</span>
		                                                        </div> --}}
		                                                    </div>                        
		                                                </div>
		                                            </div>
		                                            <a href="{{ route('get.itinerary', ['itinerary_id' => $itinerary->id]) }}"><span class="link-spanner"></span></a>
		                                        </div>
		                                    </div>
										@endforeach()
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
@endsection()