<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>Forgot Password</title>
        <meta name="description" content="Libot Philippines forgot password." />
        <meta name="keywords" content="libot, libot philippines, forgot password, libot forgot password, libot philippines forgot password" />
        <meta name="author" content="libot"/>
        
        <!-- Favicon -->
        <link rel="shortcut icon" href="favicon.ico">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        
        <!-- vector map CSS -->
        <link href="vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>

        {{-- toast/notification --}}
        <link href="vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
        
        <!-- Custom CSS -->
        <link href="dist/css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
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
                                            <h6 class="text-center txt-grey nonecase-font">Enter the email you use for Libot, and we’ll help you create a new password.</h6>
                                        </div>  
                                        <div class="form-wrap">
                                            <form action="{{ route('account.send-email-forgot') }}" method="post">
                                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                                    <label class="control-label mb-10" for="email">Email address</label>
                                                    <input type="email" class="form-control" required="" id="email" name="email" placeholder="Enter email">
                                                </div>
                                                <div class="form-group">
                                                    <a class="capitalize-font txt-primary block mb-10 pull-right font-12" href="{{ route('account.forgot-sms') }}">Don't have access to your Email Address?</a>
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
        
        <!-- JavaScript -->
        
        <!-- jQuery -->
        <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>
        
        <!-- Bootstrap Core JavaScript -->
        <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
        
        <!-- Slimscroll JavaScript -->
        <script src="dist/js/jquery.slimscroll.js"></script>
        
        <!-- Init JavaScript -->
        <script src="dist/js/init.js"></script>

        @include('includes.message-block')
    </body>
</html>
