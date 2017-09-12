@extends('layouts.base.other')

@section('title')
Reset Password
@endsection

@section('meta_content')
<meta name="description" content="Libot Philippines Reset password page." />
<meta name="keywords" content="libot, libot philippines, Reset password, libot Reset password, libot philippines Reset password" />
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
                                    <a href="{{ route('home') }}">
                                        <img class="brand-img mr-10" src="dist/img/logo.png" alt="brand"/>
                                        <span class="brand-text">Libot</span>
                                    </a>
                                </div>
                                <div class="mb-30">
                                    <h3 class="text-center txt-dark mb-10">Reset Password</h3>
                                </div>  
                                <div class="form-wrap">
                                    <form action="{{ route('account.post-reset-password') }}" method="post">
                                        <div class="form-group">
                                            <label class="pull-left control-label mb-10" for="password">New Password</label>
                                            <input type="password" class="form-control" required="" id="password" name="password" placeholder="Enter New pwd">
                                        </div>
                                        <div class="form-group">
                                            <label class="pull-left control-label mb-10" for="password2">Confirm Password</label>
                                            <input type="password" class="form-control" required="" id="password2" name="password2" placeholder="Re-Enter pwd">
                                        </div>
                                        <div class="form-group text-center">
                                            <input type="hidden" value="{{ Session::token() }}" name="_token">
                                            <input type="hidden" value="{{ $token }}" name="password_token">
                                            <input type="hidden" value="{{ $code }}" name="code">
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