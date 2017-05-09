@extends('layouts/master')

@section('title')
Libot Philippines
@endsection

@section('description', 'Libot Philippines helps you to find travel package, a car/services to use for your travel and everything you needs for travel.')
@section('meta-image', 'https://libot-ph.com/favicon.ico')

@section('content')
@include('includes.search')
<hr>
@include('posts.latest-posts')

@endsection