@extends('layouts.main')

@section('meta')
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="Libot Philippines Help page. How Libot philippines works." />
    <meta name="keywords" content="libot, libot philippines, travel, libot travel, rent, Help, how libot philippines works" />
    <meta name="author" content="libot-ph"/>
@endsection()

@section('title')
Help
@endsection

@section('css')
    <!-- Data table CSS -->
    <link href="vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    
    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
@endsection()

@section('content')    
            <div class="container-fluid">
                
                <!-- Title -->
                <div class="row heading-bg">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h5 class="txt-dark">Help</h5>
                    </div>
                    <!-- Breadcrumb -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li class="active"><span>Help</span></li>
                        </ol>
                    </div>
                    <!-- /Breadcrumb -->
                </div>
                <!-- /Title -->
                <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default card-view">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h6 class="panel-title txt-dark">How this works?</h6>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <hr class="light-grey-hr mb-10"/>
                                <div  class="panel-wrapper collapse in">
                                    <div  class="panel-body pl-15">
                                    <h5>Want to share your travel packages, services or cars to others?</h4>
                                    <div  class="panel-body pl-15">
                                        <ol>
                                            <li>Login or Register to our website. Don't worry its <strong>FREE</strong>.</li>
                                            <li>Post your travel packages or services or cars.</li>
                                            <li>Let the other users see your ads.</li>
                                        </ol>
                                    </div>
                                    <hr class="light-grey-hr mb-10"/>
                                    <h5>Want to find travel packages, services or cars?</h5>
                                    <div  class="panel-body pl-15">                                        
                                        <ol>
                                            <li>Login or Register to our website. Don't worry its <strong>FREE</strong>.</li>
                                            <li>Search your travel packages, services or cars.</li>
                                            <li>Contact the person you saw in the ads.</li>
                                        </ol>
                                    </div>
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