@extends('layouts/master')

@section('title')
Login
@endsection

@section('content')

<div class="col-md-offset-4 col-md-4 text-center">
    <h3>Log into Libot</h3>
    <form action="{{ route('signin') }}" method="post" class="form-group">
        <div class="form-group has-feedback {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
            <label for="mobile_no">Mobile Number</label>
            <input class="form-control" type="text" name="mobile_no" id="mobile_no" value="{{ Request::old('mobile_no') }}">
            <i class="glyphicon glyphicon-user form-control-feedback"></i>
        </div>
        <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password">
            <i class="glyphicon glyphicon-lock form-control-feedback"></i>
        </div>
        <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block" onclick="this.disabled=true;this.form.submit();">Log In</button>
        </div>
        <input type="hidden" name="_token" value="{{ Session::token() }}"> 
    </form>
    <form action="{{ route('login.facebook') }}">
        <button class="loginBtn loginBtn--facebook" type="submit">Login with facebook</button>
        <input type="hidden" name="_token" value="{{ Session::token() }}"> 
    </form>
    <div class="form-group">
        <a href="{{ route('account.forgot') }}">Forgot your password?</a>
    </div> 
</div>
@endsection

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