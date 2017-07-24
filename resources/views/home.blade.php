@extends('layouts/master')

@section('title')
Libot Philippines
@endsection

@section('description', 'With Libot Philippines, we creates socially responsible travel experiences thus, making it more convenient to find travel packages for everyone.')
@section('meta-image', 'https://libot-ph.com/images/libot.png')

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