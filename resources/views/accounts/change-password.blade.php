@extends('layouts.master')

@section('title')
	Change Password
@endsection

@section('content')
	<section class="row new-post">
        <div class="col-md-6 col-md-offset-3">      
        <h3>Change Password</h3>      
            <form action="{{ route('account.post-change-password') }}" method="post">
                <div class="form-group {{ $errors->has('current-password') ? 'has-error' : '' }}">
                    <label for="current-password">Current Password</label>
                    <input type="password" name="current-password" class="form-control" id="current-password">
                </div>
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password">New Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <div class="form-group {{ $errors->has('confirm-password') ? 'has-error' : '' }}">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" name="confirm-password" class="form-control" id="confirm-password">
                </div>
                <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();">Update Password</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>
@endsection