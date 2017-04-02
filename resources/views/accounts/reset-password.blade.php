@extends('layouts.master')

@section('title')
	Forgot Password
@endsection

@section('content')
@include('includes.message-block')
	<section class="row new-post">
        <div class="col-md-6 col-md-offset-3">      
        <h3>Reset Password</h3>      
            <form action="{{ route('account.post-reset-password') }}" method="post">
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password">Please enter your New Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
                <input type="hidden" value="{{ $token }}" name="password_token">
                <input type="hidden" value="{{ $code }}" name="code">
            </form>
        </div>
    </section>
@endsection