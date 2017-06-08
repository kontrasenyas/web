@extends('layouts.master')

@section('title')
	Reset Password Success
@endsection

@section('content')
<section class="row new-post">
    <div class="col-md-6 col-md-offset-3">      
        <h3>Reset Password</h3>      
        <div class="row form-group">
            <div class="col-md-12">
                Password successfully updated.
            </div>
        </div>
        <p><a href="{{ route('login') }}">Click here to login</a></p>
    </div>
</section>
@endsection