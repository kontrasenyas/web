@extends('layouts.base.other')

@section('title')
Login
@endsection

@section('meta_content')
  <meta name="description" content="Libot Philippines login page." />
  <meta name="keywords" content="libot, libot philippines, login, libot login, libot philippines login, signin, sign in" />
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
        <span class="inline-block pr-10">Don't have an account?</span>
        <a class="inline-block btn btn-info btn-rounded btn-outline" href="{{ route('register') }}">Sign Up</a>
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
                    <h3 class="text-center txt-dark mb-10">Sign in to Libot</h3>
                    <h6 class="text-center nonecase-font txt-grey">Enter your details below</h6>
                  </div>  
                  <div class="form-wrap">
                    <form action="{{ route('signin') }}" method="post">
                      <div class="form-group">
                        <label class="control-label mb-10" for="mobile_no">Mobile Number</label>
                        <input class="form-control" type="text" name="mobile_no" required="" id="mobile_no" placeholder="Enter mobile" value="{{ Request::old('mobile_no') }}">
                      </div>
                      <div class="form-group">
                        <label class="pull-left control-label mb-10" for="password">Password</label>
                        <a class="capitalize-font txt-primary block mb-10 pull-right font-12" href="{{ route('account.forgot') }}">forgot password ?</a>
                        <div class="clearfix"></div>
                        <input type="password" class="form-control" required="" id="password" name="password" placeholder="Enter pwd">
                      </div>
                      
                      <div class="form-group">
                        <div class="checkbox checkbox-primary pr-10 pull-left">
                          <input id="checkbox_2" type="checkbox">
                          <label for="checkbox_2"> Keep me logged in</label>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                      <input type="hidden" name="_token" value="{{ Session::token() }}"> 
                      <div class="form-group text-center">
                        <button type="submit" class="btn btn-info btn-rounded">sign in</button>
                      </div>
                    </form>
                    <form class="form-group text-center" action="{{ route('login.facebook') }}">
                      <button class="loginBtn loginBtn--facebook" type="submit" onclick="this.disabled=true;this.form.submit();">Login with facebook</button>
                      <input type="hidden" name="_token" value="{{ Session::token() }}"> 
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

  {{-- Facebook button --}}
  <style type="text/css">
    /* Shared */
    .loginBtn {
      box-sizing: border-box;
      position: relative;
      /* width: 13em;  - apply for fixed size */
      margin: 0.2em;
      padding: 0 15px 0 46px;
      border: none;
      text-align: left;
      line-height: 34px;
      white-space: nowrap;
      border-radius: 0.2em;
      font-size: 16px;
      color: #FFF;
    }
    .loginBtn:before {
      content: "";
      box-sizing: border-box;
      position: absolute;
      top: 0;
      left: 0;
      width: 34px;
      height: 100%;
    }
    .loginBtn:focus {
      outline: none;
    }
    .loginBtn:active {
      box-shadow: inset 0 0 0 32px rgba(0,0,0,0.1);
    }
    /* Facebook */
    .loginBtn--facebook {
      background-color: #4C69BA;
      background-image: linear-gradient(#4C69BA, #3B55A0);
      /*font-family: "Helvetica neue", Helvetica Neue, Helvetica, Arial, sans-serif;*/
      text-shadow: 0 -1px 0 #354C8C;
    }
    .loginBtn--facebook:before {
      border-right: #364e92 1px solid;
      background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/14082/icon_facebook.png') 6px 6px no-repeat;
    }
    .loginBtn--facebook:hover,
    .loginBtn--facebook:focus {
      background-color: #5B7BD5;
      background-image: linear-gradient(#5B7BD5, #4864B1);
    }
  </style>
@endsection()
