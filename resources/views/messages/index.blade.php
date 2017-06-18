@extends('layouts/master')

@section('title')
    Messages
@endsection

@section('description', 'Libot Philippines helps you to find travel package, a car/services to use for your travel and everything you needs for travel.')
@section('meta-image', 'https://libot-ph.com/favicon.ico')

@section('content')
    <div class="col-md-12 text-center page-header">
        <h1>Inbox</h1>
    </div>
    <div class="col-md-12">
    	@foreach($list as $each)
    		@if($each->user_one == Auth::user()->id)
    			<a href="{{ route('get.message', ['user_id' => $each->user_two]) }}">{{ $each->first_name }} {{ $each->last_name }}</a><br/>
                {{ $each->reply }}<br/>
                
    		@endif
    		@if($each->user_two == Auth::user()->id)
    			<a href="{{ route('get.message', ['user_id' => $each->user_one]) }}">{{ $each->first_name }} {{ $each->last_name }}</a><br/>
                {{ $each->reply }}<br/>
    		@endif
    	@endforeach
    </div>    
@endsection
