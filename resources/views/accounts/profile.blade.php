@extends('layouts.master')

@section('title')
	Account
@endsection

@section('content')
@include('includes.message-block')
        <div class="col-md-6 col-md-offset-3">
        <img src="{{ route('account.image', ['filename' => $user->profile_picture_path]) }}" alt="" class="img-responsive center-block">
            <div class="col-md-12 text-center page-header">
                <h1 class="text-uppercase">{{ $user->first_name }} {{ $user->last_name }}</h1>
                <h3 class="text-uppercase">{{ $user->mobile_no }}</h3>
            </div>
        </div>
@endsection