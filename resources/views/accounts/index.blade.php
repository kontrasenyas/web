@extends('layouts.master')

@section('title')
	Edit Account
@endsection

@section('content')
@include('includes.message-block')
	<section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Your Account</h3></header>
            <form action="{{ route('account.save') }}" method="post" enctype="multipart/form-data">
                <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" id="first_name">
                </div>
                <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" id="last_name">
                </div>
                <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
                    <label for="mobile_no">Mobile Number</label>
                    <input type="text" name="mobile_no" class="form-control" value="{{ $user->mobile_no }}" id="mobile_no">
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email">Email Address</label>
                    <input type="text" name="email" class="form-control" value="{{ $user->email }}" id="email">
                </div>
                <div class="form-group">
                    <label for="image">Change profile picture (Image only)</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>
                <button type="submit" class="btn btn-primary">Save Account</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>
    {{-- @if (Storage::disk('local')->has($user->first_name . '-' . $user->id . '.jpg')) --}}
        <section class="row new-post">
            <div class="col-md-12">
                <img src="{{ route('account.image', ['filename' => $user->profile_picture_path]) }}" alt="" class="img-responsive center-block">
            </div>
        </section>
    {{-- @endif --}}
@endsection