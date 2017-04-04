@extends('layouts.master')

@section('title')
	{{ $user->first_name }}
@endsection

@section('content')
@include('includes.message-block')
        <div class="col-md-6 col-md-offset-3">
        	<img src="{{ route('account.image', ['filename' => $user->profile_picture_path]) }}" alt="" class="img-responsive center-block">
            <div class="col-md-12 text-center page-header">
                <h1 class="text-uppercase">{{ $user->first_name }} {{ $user->last_name }}</h1>
                <h3 class="text-uppercase">{{ $user->mobile_no }}</h3>
                <h4 class="text-lowercase">{{ $user->email }}</h3>
            </div>
            @if(Auth::user())
            <div class="col-md-12 text-center">
        		<a href="{{ route('account.edit') }}">Edit your account</a>
        	</div>
            <div class="col-md-12 text-center">
                <a href="{{ route('account.get-change-password') }}">Change your password</a>
            </div>
        	@endif
        </div>   
@endsection