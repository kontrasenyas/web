@extends('layouts.main')

@section('meta')
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="Libot Philippines search page, we creates socially responsible travel experiences thus, making it more convenient to find travel packages and renting a car for everyone." />
    <meta name="keywords" content="libot, libot philippines, travel, libot travel, rent, search" />
    <meta name="author" content="libot-ph"/>
@endsection()

@section('title')
Libot Philippines
@endsection

@section('css')    
    <!-- Data table CSS -->
    <link href="vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>

    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">

    <link href="vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">

    <!-- Post image style -->
    <link href="{{ URL::to('css/post.css')}}" media="all" rel="stylesheet" type="text/css" />

    <!-- bootstrap-select CSS -->
	<link href="vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
@endsection()

@section('content')
    <div class="container-fluid pt-25">                
        <!-- Row -->
        <div class="row">
         	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ml-auto mr-auto no-float">
	            <div class="panel panel-default card-view">
	                <div class="panel-heading">
	                    <div class="pull-left">
	                        <h6 class="panel-title txt-dark">Search</h6>
	                    </div>
	                    <div class="clearfix"></div>
	                </div>
	                <div class="panel-wrapper collapse in">
	                    <div class="panel-body">
	                        <form action="" method="get" id="search-form">	                        					
						        <div class="col-md-12">
						            {{-- <div class="text-center col-md-6 col-md-offset-3"> --}}
						                <div class="">
						                	<div class="row form-group">
												<div class="col-md-12">
													{{-- <label class="control-label mb-10">Select box</label> --}}
													<select class="selectpicker" data-style="form-control btn-default btn-outline" name="search-type" id="search-type">
														<option value="any">Any</option>
														<option value="rental">Rental</option>
														<option value="package">Travel Package</option>
														<option value="itinerary">Itinerary</option>
													</select>
												</div>
						                	</div>
						                	<div class="row form-group">
						                        <div class="col-md-12">
						                            <input type="text" class="form-control" placeholder="Location" name="location" id="location" autocomplete="off" value="{{ Request::query('location') }}" required="">
						                        </div>
						                    </div>
						                    <div class="row form-group">
						                        <div class="col-md-12">
						                            <input type="text" class="form-control" placeholder="Title" name="query" id="query" autocomplete="off" value="{{ Request::query('query') }}">
						                        </div>                          
						                    </div>						                    
						                    <div class="form-group row">
						                        <div class="col-md-12">
						                            <input type="text" class="form-control" placeholder="Keywords" name="keywords" id="keywords" autocomplete="off" value="{{ Request::query('keywords') }}">
						                        </div>
						                    </div>
						                    <div class="form-group row">
						                        <div class="col-md-12">                         
						                            <button id="btnSearch" class="btn btn-primary" type="submit" onclick="this.disabled=true;search();this.form.submit();">Search!</button>
						                            {{-- <input type="submit" class="btn btn-primary" id="btnSearch" value="Save Changes" /> --}}
						                            <input type="hidden" name="_token" value="{{ Session::token() }}">                          
						                        </div>
						                    </div>
						                </div><!-- /input-group -->
						            {{-- </div> --}}
						        </div>
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
    <script type="text/javascript" src="{{ URL::to('js/search.js') }}"></script>

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

    <!-- Bootstrap Select JavaScript -->
	<script src="vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

    @include('includes.places-autocomplete')
    @include('includes.message-block')
    @include('includes.register-first')
@endsection()

