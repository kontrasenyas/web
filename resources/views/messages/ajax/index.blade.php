		@foreach($message_reply->reverse() as $reply)
            {{-- Own message --}}
    		@if($reply->user->id == Auth::user()->id)
    			<div class="text-right"> 
    				{!! nl2br(e($reply->reply)) !!}<br/>
	    			<span class="text-muted" title="{{$reply->created_at->format('F d, Y g:i A')}}"><small><i>{{ $reply->created_at->diffForHumans() }}</i></small></span>
    			</div>
    		@endif
            {{-- Recepient message--}}
    		@if($reply->user->id != Auth::user()->id)
    			<div class="text-left"> 
    				<a href="{{ route('account.profile', ['user_id' => $sent_to->id]) }}"><span class="text-muted"><small>{{ $reply->user->first_name }} {{ $reply->user->last_name }} </small></span></a> <br/>
    				{!! nl2br(e($reply->reply)) !!}<br/>
    				<span class="text-muted" title="{{$reply->created_at->format('F d, Y g:i A')}}"><small><i>{{ $reply->created_at->diffForHumans() }}</i></small></span>
    			</div>
    		@endif
    	@endforeach