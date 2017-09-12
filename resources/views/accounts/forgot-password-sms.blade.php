@extends('layouts.base.other')

@section('title')
Forgot Password
@endsection

@section('meta_content')
    <meta name="description" content="Libot Philippines forgot password page." />
    <meta name="keywords" content="libot, libot philippines, forgot password, libot forgot password, libot philippines forgot password" />
    <meta name="author" content="libot"/>
@endsection()

@section('content')
        <!--Preloader-->
        <div class="preloader-it">
            <div class="la-anim-1"></div>
        </div>
        <!--/Preloader-->
        
        <div class="wrapper pa-0">
            <!-- Main Content -->
            <div class="page-wrapper pa-0 ma-0 auth-page">
                <div class="container-fluid">
                    <!-- Row -->
                    <div class="table-struct full-width full-height">
                        <div class="table-cell vertical-align-middle auth-form-wrap">
                            <div class="auth-form  ml-auto mr-auto no-float">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="sp-logo-wrap text-center pa-0 mb-30">
                                            <a href="{{ route('home')}}">
                                                <img class="brand-img mr-10" src="dist/img/logo.png" alt="brand"/>
                                                <span class="brand-text">Libot</span>
                                            </a>
                                        </div>
                                        <div class="mb-30">
                                            <h3 class="text-center txt-dark mb-10">Need help with your password?</h3>
                                            <h6 class="text-center txt-grey nonecase-font">Enter the mobile number you use for Libot, and we’ll help you create a new password.</h6>
                                        </div>  
                                        <div class="form-wrap">
                                            <form action="{{ route('account.send-sms') }}" method="post">
                                                <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
                                                    <label class="control-label mb-10" for="mobile_no">Mobile Number</label>
                                                    <input type="text" class="form-control" required="" id="mobile_no" name="mobile_no" placeholder="Enter mobile number">
                                                </div>

                                                <div class="form-group">
                                                    <a class="capitalize-font txt-primary block mb-10 pull-right font-12" href="{{ route('account.forgot') }}">Don't have access to your Mobile Number?</a>
                                                    <div class="clearfix"></div>
                                                </div>
                                                
                                                <div class="form-group text-center">
                                                    <input type="hidden" value="{{ Session::token() }}" name="_token">
                                                    <button type="submit" class="btn btn-info btn-rounded">Reset</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Row -->   
                </div>
                
            </div>
            <!-- /Main Content -->
        </div>
        <!-- /#wrapper -->
@endsection()