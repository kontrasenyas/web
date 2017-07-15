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
    <div class="form-group">
            <a href="{{ route('account.forgot') }}">Forgot your password?</a>
    </div> 
</div>
@endsection