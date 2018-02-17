@extends('layouts.main')

@section('meta')
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="Libot Philippines change password page, we creates socially responsible travel experiences thus, making it more convenient to find travel packages and renting a car for everyone." />
    <meta name="keywords" content="libot, libot philippines, travel, libot travel, rent, change password" />
    <meta name="author" content="libot-ph"/>
@endsection()

@section('title')
Change Password
@endsection

@section('css')
    <!-- Data table CSS -->
    <link href="vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>

    <link href="vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
    
    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
@endsection()

@section('content')    
            <div class="container-fluid">
                
                <!-- Title -->
                <div class="row heading-bg">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h5 class="txt-dark">Change Password</h5>
                    </div>
                    <!-- Breadcrumb -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('account.profile', Auth::user()->id) }}">Profile</a></li>
                            <li><a href="{{ route('account.get-change-password') }}">Settings</a></li>
                            <li class="active"><span>Change Password</span></li>
                        </ol>
                    </div>
                    <!-- /Breadcrumb -->
                </div>
                <!-- /Title -->
                <div class="row">
                        <div class="col-md-6 ml-auto mr-auto no-float">
                            <div class="panel panel-default card-view">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h6 class="panel-title txt-dark">Do you want to change your password?</h6>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <hr class="light-grey-hr mb-10"/>
                                <div  class="panel-wrapper collapse in">
                                    <div  class="panel-body pl-15">
                                        <form action="{{ route('account.post-change-password') }}" method="post">
                                            <div class="form-group {{ $errors->has('current-password') ? 'has-error' : '' }}">
                                                <label class="pull-left control-label mb-10" for="current-password">Old Password</label>
                                                <input type="password" class="form-control" required="" id="current-password" name="current-password" placeholder="Enter pwd">
                                            </div>
                                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                                <label class="pull-left control-label mb-10" for="password">New Password</label>
                                                <input type="password" class="form-control" required="" id="password" name="password" placeholder="Enter New pwd">
                                            </div>
                                            <div class="form-group {{ $errors->has('confirm-password') ? 'has-error' : '' }}">
                                                <label class="pull-left control-label mb-10" for="confirm-password">Confirm Password</label>
                                                <input type="password" class="form-control" required="" id="confirm-password" name="confirm-password" placeholder="Re-Enter pwd">
                                            </div>
                                            <div class="form-group text-center">
                                                <input type="hidden" value="{{ Session::token() }}" name="_token">
                                                <button type="submit" class="btn btn-info btn-rounded">Submit</button>
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