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
    			<a href="{{ route('get.message', ['user_id' => $each->user_two]) }}">{{ $each->first_name }} {{ $each->last_name }} - {{ $each->user_two }}</a><br/>
    		@endif
    		@if($each->user_two == Auth::user()->id)
    			<a href="{{ route('get.message', ['user_id' => $each->user_one]) }}">{{ $each->first_name }} {{ $each->last_name }} - {{ $each->user_one }}</a><br/>
    		@endif
    	@endforeach
<!--     	@foreach($message_replies as $message_reply)
    		{{ $message_reply->reply }}
    	@endforeach -->
    </div>    
@endsection

