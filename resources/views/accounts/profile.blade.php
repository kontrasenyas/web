@extends('layouts.master')

@section('title')
    {{ $user->first_name }}
@endsection

@section('content')
    <div class="col-md-6 col-md-offset-3">
        <img src="{{ route('account.image', ['filename' => $user->profile_picture_path]) }}" alt=""
             class="img-responsive center-block">
        <div class="col-md-12 text-center page-header">
            <h1>{{ $user->first_name }} {{ $user->last_name }}</h1>
            <h3>{{ $user->mobile_no }}</h3>
            <h4 class="text-lowercase">{{ $user->email }}</h4>
        </div>
        @if(Auth::user() && Auth::user()->id == $user->id)
            <div class="col-md-12 text-center">
                <a href="{{ route('account.edit') }}">Edit your account</a>
            </div>
            <div class="col-md-12 text-center">
                <a href="{{ route('account.get-change-password') }}">Change your password</a>
            </div>
        @endif
    </div>
    @if(!Auth::user() || (Auth::user() && (Auth::user()->id != $user->id) ))
        <div class="col-md-12 text-center">
            This user has <a href="{{ route('user-post', ['user_id' => $user->id]) }}">{{count($posts)}} post/s</a>.
        </div>
        <div class="col-md-12 text-center">
            <a href="{{ route('account.feedback', ['user_id' => $user->id]) }}">Give this user a feedback.</a>
        </div>
    @endif
@endsection