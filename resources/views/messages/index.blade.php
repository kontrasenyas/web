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
                @if($each->latest_user_reply == Auth::user()->id)
                    You: {{ $each->reply }} <br/>
                    <span class="text-muted"><small><i>{{ Carbon\Carbon::parse($each->mr_created)->diffForHumans() }}</i></small></span>
                    <br/>
                @endif
                @if($each->latest_user_reply != Auth::user()->id)
                    {{ $each->reply }} <br/>
                    <span class="text-muted"><small><i>{{ Carbon\Carbon::parse($each->mr_created)->diffForHumans() }}</i></small></span>
                    <br/>
                @endif
                
    		@endif
    		@if($each->user_two == Auth::user()->id)
    			<a href="{{ route('get.message', ['user_id' => $each->user_one]) }}">{{ $each->first_name }} {{ $each->last_name }}</a><br/>
                @if($each->latest_user_reply == Auth::user()->id)
                    You: {{ $each->reply }} <br/>
                    <span class="text-muted"><small><i>{{ Carbon\Carbon::parse($each->mr_created)->diffForHumans() }}</i></small></span>
                    <br/>
                @endif
                @if($each->latest_user_reply != Auth::user()->id)
                    {{ $each->reply }} <br/>
                    <span class="text-muted"><small><i>{{ Carbon\Carbon::parse($each->mr_created)->diffForHumans() }}</i></small></span>
                    <br/>
                @endif
    		@endif
    	@endforeach
    </div>    
@endsection
