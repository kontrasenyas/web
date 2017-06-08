@extends('layouts.master')

@section('title')
	Forgot Password
@endsection

@section('content')
	<section class="row new-post">
        <div class="col-md-6 col-md-offset-3">      
        <h3>Forgot Password</h3>      
            <form action="{{ route('account.send-email-forgot') }}" method="post">
                {{-- <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
                    <label for="mobile_no">Your registered Mobile Number</label>
                    <input type="text" name="mobile_no" class="form-control" id="mobile_no">
                </div> --}}
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email">Your registered Email Address</label>
                    <input type="text" name="email" class="form-control" id="email">
                </div>
                <div class="form-group">
                    <a href="{{ route('account.forgot-sms') }}">Don't have access to your Email Address?</a>
                </div>
                <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();">Submit</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>
@endsection