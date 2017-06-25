@extends('layouts/master')

@section('title')
    {{ $sent_to->first_name }} {{ $sent_to->last_name }}
@endsection

@section('description', 'Libot Philippines helps you to find travel package, a car/services to use for your travel and everything you needs for travel.')
@section('meta-image', 'https://libot-ph.com/favicon.ico')

@section('content')
    <div class="col-md-12 text-center page-header">
        <h1>Inbox</h1>
        <h3>
            <a href="{{ route('account.profile', ['user_id' => $sent_to->id]) }}" style="text-decoration: none;">
            <div class="col-md-4 col-md-offset-4 text-center">
                <div class="form-group">
                <img style="padding-top: 3px;" src="{{ route('account.image', ['filename' => $sent_to->profile_picture_path]) }}" alt="" class="img-circle" width="100" height="100">
                </div>
                {{ $sent_to->first_name }} {{ $sent_to->last_name }}
            </div>
            
            </a>
        </h3>
    </div>
    <div class="col-md-12">    
    @if(count($message) > 0)
    	@foreach($message_reply as $reply)
    		@if($reply->user->id == Auth::user()->id)
    			<div class="text-right"> 
    				{!! nl2br(e($reply->reply)) !!}<br/>
	    			<span class="text-muted" title="{{$reply->created_at->format('F d, Y g:i A')}}"><small><i>{{ $reply->created_at->diffForHumans() }}</i></small></span>
    			</div>
    		@endif
    		@if($reply->user->id != Auth::user()->id)
    			<div class="text-left"> 
    				<a href="{{ route('account.profile', ['user_id' => $sent_to->id]) }}"><span class="text-muted"><small>{{ $reply->user->first_name }} {{ $reply->user->last_name }} </small></span></a> <br/>
    				{!! nl2br(e($reply->reply)) !!}<br/>
    				<span class="text-muted" title="{{$reply->created_at->format('F d, Y g:i A')}}"><small><i>{{ $reply->created_at->diffForHumans() }}</i></small></span>
    			</div>
    		@endif
    	@endforeach
    @endif
    </div>
    <div class="col-md-12">
		<form action="{{ route('post.message', ['sent_to' => $sent_to->id]) }}" method="post">
				<div class="form-group {{ $errors->has('reply') ? 'has-error' : '' }}">
					<textarea class="form-control" placeholder="Message" aria-describedby="basic-addon2" name="reply" id="reply" value="{{ Request::old('reply') }}"></textarea>
				</div>
				<input type="text" class="form-control hidden" placeholder="id" aria-describedby="basic-addon2" name="sent_to" id="sent_to" value="{{ $sent_to->id }}">
                <p class="text-muted"><small>Press Alt + Enter to send</small></p>

				<button id="send" type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();">Send</button>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
		</form>
	</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('button[type="submit"]').attr('disabled', true);
        $('input[type="text"],textarea').on('keyup',function() {
            var textarea_value = $("#reply").val();
            if(textarea_value != '') {
                $('button[type="submit"]').attr('disabled' , false);
            }else{
                $('button[type="submit"]').attr('disabled' , true);
            }
        });
    });

    $(document).ready(function() {
        var ta = document.getElementById('reply');
        ta.onkeydown = function (event) {
            if (event.defaultPrevented) {
               return;
            }
            var handled = false;
            if (event.key !== undefined) {
               if (event.key === 'Enter' && event.altKey) {
                  document.getElementById("send").click(); 
               }
            } else if (event.keyIdentifier !== undefined) {
               if (event.keyIdentifier === "Enter" && event.altKey) {
                  document.getElementById("send").click(); 
               }

            } else if (event.keyCode !== undefined) {
               if (event.keyCode === 13 && event.altKey) {
                  document.getElementById("send").click(); 
               }
            }
            if (handled) {
               event.preventDefault();
            };
        };
    });
</script>
@endsection