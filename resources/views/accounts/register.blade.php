@extends('layouts/master')

@section('title')
Welcome
@endsection

@section('content')

<div class="row">
<div class="col-md-4 col-md-offset-4 text-center">
		<h3>Sign Up</h3>
		<form action="{{ route('signup') }}" method="post">
			<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
				<label for="email">Email Address</label>
				<input class="form-control" type="text" name="email" id="email" value="{{ Request::old('email') }}">
			</div>
			<div class="form-group {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
				<label for="mobile_no">Mobile Number</label>
				<input class="form-control" type="text" name="mobile_no" id="mobile_no" value="{{ Request::old('mobile_no') }}">
			</div>
			<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
				<label for="password">Password</label>
				<input class="form-control" type="password" name="password" id="password">
			</div>
			<div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
				<label for="first_name">First Name</label>
				<input class="form-control" type="text" name="first_name" id="first_name" value="{{ Request::old('first_name') }}">
			</div>
			<div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
				<label for="last_name">Last Name</label>
				<input class="form-control" type="text" name="last_name" id="last_name" value="{{ Request::old('last_name') }}">
			</div>
			<button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();">Sign Up</button>
			<input type="hidden" name="_token" value="{{ Session::token() }}">
		</form>
	</div>
</div>
@endsection