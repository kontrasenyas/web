@extends('layouts.master')

@section('title')
	Reset Password
@endsection

@section('content')
	<section class="row new-post">
        <div class="col-md-6 col-md-offset-3">      
        <h3>Reset Password</h3>      
            <p>Maybe your link has expired or broken. </p>
            <p><a href="{{ route('welcome') }}">Back to Homepage.</a></p>
        </div>
    </section>
@endsection