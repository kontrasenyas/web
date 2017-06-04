@extends('layouts/master')

@section('title')
    Your Moments
@endsection

@section('description', 'Libot Philippines helps you to find travel package, a car/services to use for your travel and everything you needs for travel.')
@section('meta-image', 'https://libot-ph.com/favicon.ico')

@section('content')
    <div class="col-md-12 text-center page-header">
        <h1>Moments</h1>
    </div>
    @if(Auth::check() && Auth::user()->id == $user->id)
    <div class="col-md-12 text-center">
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#momentModal" id="btnMoment">What is your travel moment?</button>
    </div>
    @endif

    @include('moments.moment-user')

    @include('moments.moment-modal')
@endsection

