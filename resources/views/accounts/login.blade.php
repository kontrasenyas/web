@extends('layouts/master')

@section('title')
Welcome
@endsection

@section('content')

<div class="col-md-offset-4 col-md-4 text-center">
    <h3>Sign In</h3>
    <form action="{{ route('signin') }}" method="post">
        <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
            <label for="mobile_no">Mobile Number</label>
            <input class="form-control" type="text" name="mobile_no" id="mobile_no" value="{{ Request::old('mobile_no') }}">
        </div>
        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password">
        </div>
        <div class="form-group">
            <a href="{{ route('account.forgot') }}">Forgot your password?</a>
        </div>  
        <button type="submit" class="btn btn-primary">Log In</button>
        <input type="hidden" name="_token" value="{{ Session::token() }}">
    </form>
</div>
@endsection