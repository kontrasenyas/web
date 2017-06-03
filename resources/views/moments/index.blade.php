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
    <div class="col-md-12 text-center">
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#momentModal" id="btnMoment">What is your travel moment?</button>
    </div>
    <div class="col-md-6">
        Picture
    </div>

    <div class="col-md-6">
        Description
    </div>

    @include('moments.moment-modal')
@endsection

