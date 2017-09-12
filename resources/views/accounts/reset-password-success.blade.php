@extends('layouts.base.other')

@section('title')
Reset Password Success
@endsection

@section('meta_content')
<meta name="description" content="Libot Philippines Reset Password page." />
<meta name="keywords" content="libot, libot philippines, Reset password, libot Reset password, libot philippines Reset password" />
<meta name="author" content="libot"/>
@endsection()

@section('content')
    <!--Preloader-->
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <!--/Preloader-->

    <div class="wrapper error-page pa-0">
        <header class="sp-header">
            <div class="sp-logo-wrap pull-left">
                <a href="{{ route('home') }}">
                    <img class="brand-img mr-10" src="dist/img/logo.png" alt="brand"/>
                    <span class="brand-text">Libot</span>
                </a>
            </div>
            <div class="form-group mb-0 pull-right">
                <a class="inline-block btn btn-info btn-rounded btn-outline nonecase-font" href="{{ route('home') }}">Back to Home</a>
            </div>
            <div class="clearfix"></div>
        </header>

        <!-- Main Content -->
        <div class="page-wrapper pa-0 ma-0">
            <div class="container-fluid">
                <!-- Row -->
                <div class="table-struct full-width full-height">
                    <div class="table-cell vertical-align-middle auth-form-wrap">
                        <div class="auth-form  ml-auto mr-auto no-float">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="mb-30">
                                        <span class="block error-head text-center txt-info mb-10">Hooray!</span>
                                        <span class="text-center nonecase-font mb-20 block error-comment">Password successfully updated.</span>
                                        <div class="form-group text-center">
                                            <a href="{{ route('login') }}" class="btn btn-info btn-rounded">sign in</a>
                                        </div>
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