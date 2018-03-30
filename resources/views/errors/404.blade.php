@extends('layouts.base.other')

@section('title')
Page is not found.
@endsection

@section('meta_content')
  <meta name="description" content="Libot Philippines" />
  <meta name="keywords" content="libot, libot philippines" />
  <meta name="author" content="libot"/>
@endsection()

@section('content')
  <!--Preloader-->
  <div class="preloader-it">
    <div class="la-anim-1"></div>
  </div>
  <!--/Preloader-->

  <div class="wrapper pa-0">
    <header class="sp-header">
      <div class="sp-logo-wrap pull-left">
        <a href="{{ route('home') }}">
          <img class="brand-img mr-10" src="dist/img/logo.png" alt="brand"/>
          <span class="brand-text">Libot</span>
        </a>
      </div>
      <div class="form-group mb-0 pull-right">
        <a class="inline-block btn btn-info btn-rounded btn-outline" href="{{ route('login') }}">Sign In</a>
      </div>
      <div class="clearfix"></div>
    </header>
    
    <!-- Main Content -->
    <div class="page-wrapper pa-0 ma-0 auth-page">
      <div class="container-fluid">
        <!-- Row -->
        <div class="table-struct full-width full-height">
          <div class="table-cell vertical-align-middle auth-form-wrap">
            <div class="auth-form  ml-auto mr-auto no-float">
              <div class="row">
                <div class="col-sm-12 col-xs-12">
                  <div class="mb-30">
                    <h3 class="text-center txt-dark mb-10">404 Not found.</h3>
                    <h6 class="text-center nonecase-font txt-grey">Sorry for the inconvenience. The page your looking is not found.</h6>
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
