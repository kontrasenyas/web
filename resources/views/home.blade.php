@extends('layouts/master')

@section('title')
Libot Philippines
@endsection

@section('description', 'Libot Philippines helps you to find travel package, a car/services to use for your travel and everything you needs for travel.')
@section('meta-image', 'https://libot-ph.com/favicon.ico')

@section('content')

<div class="col-md-12">
	<div class="col-md-6">
		@include('includes.search')		
	</div>	
	<div class="col-md-6 posts">		
			@include('posts.latest-posts')
	</div>
</div>

@endsection