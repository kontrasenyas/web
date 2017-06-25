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
    <div class="col-md-4">
    	@foreach($list as $each)
        <div class="col-md-12">
    		@if($each->user_one == Auth::user()->id)                                 
                    <a href="{{ route('get.message', ['user_id' => $each->user_two]) }}" style="text-decoration:none; color: black;">
                    <div class="col-md-3 visible-lg visible-md">
                        <img style="padding-top: 3px;" src="{{ route('account.image', ['filename' => $each->profile_picture_path]) }}" alt="" class="img-circle" width="50" height="50">
                    </div>
                        @if($each->latest_user_reply == Auth::user()->id)
                        <div class="inbox_hover">                     
                        <strong>{{ $each->first_name }} {{ $each->last_name }}</strong><br/>
                            <span class="text-muted">You: {{ $each->reply }} </span><br/>
                            <span class="text-muted"><small><i>{{ Carbon\Carbon::parse($each->mr_created)->diffForHumans() }}</i></small></span>
                        </div>   
                        @endif
                        @if($each->latest_user_reply != Auth::user()->id)
                            @if($each->is_read == 0)
                                <div class="inbox_hover inbox_unread">
                            @endif
                            @if($each->is_read == 1)
                                <div class="inbox_hover">
                            @endif                    
                            <strong>{{ $each->first_name }} {{ $each->last_name }}</strong><br/>
                            <span class="text-muted">{{ $each->reply }}</span><br/>
                            <span class="text-muted"><small><i>{{ Carbon\Carbon::parse($each->mr_created)->diffForHumans() }}</i></small></span>
                        </div>
                        @endif
                    </a>
    		@endif
    		@if($each->user_two == Auth::user()->id)
    			<a href="{{ route('get.message', ['user_id' => $each->user_one]) }}" style="text-decoration:none; color: black;">
                <div class="col-md-3 visible-lg visible-md">
                        <img style="padding-top: 3px;" src="{{ route('account.image', ['filename' => $each->profile_picture_path]) }}" alt="" class="img-circle" width="50" height="50">      
                </div>
                    @if($each->latest_user_reply == Auth::user()->id)
                    <div class="inbox_hover"> 
                        <strong>{{ $each->first_name }} {{ $each->last_name }}</strong><br/>
                        <span class="text-muted">You: {{ $each->reply }} </span><br/>
                        <span class="text-muted"><small><i>{{ Carbon\Carbon::parse($each->mr_created)->diffForHumans() }}</i></small></span>
                    </div>   
                    @endif
                    @if($each->latest_user_reply != Auth::user()->id)
                        @if($each->is_read == 0)
                            <div class="inbox_hover inbox_unread">
                        @endif
                        @if($each->is_read == 1)
                            <div class="inbox_hover">
                        @endif  
                        <strong>{{ $each->first_name }} {{ $each->last_name }}</strong><br/>
                        <span class="text-muted">{{ $each->reply }}</span><br/>
                        <span class="text-muted"><small><i>{{ Carbon\Carbon::parse($each->mr_created)->diffForHumans() }}</i></small></span>
                    </div>   
                    @endif
                </a>
    		@endif
            </div>
    	@endforeach
    </div>    
@endsection


<style type="text/css">
    
    .inbox_hover { background-color: white; }

    .inbox_unread { background-color: #eff0f1; }

    .inbox_hover:hover { background-color: #D0CFCF; }
</style>