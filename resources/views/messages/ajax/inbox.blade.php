<ul class="chatapp-chat-nicescroll-bar pt-20">
    @foreach($message_reply->reverse() as $reply)
        @if($reply->user->id != Auth::user()->id)
            <li class="friend">
                <div class="friend-msg-wrap">
                    <img class="user-img img-circle block pull-left"  src="dist/img/user.png" alt="user"/>
                    <div class="msg pull-left">
                        <p>{!! nl2br(e($reply->reply)) !!}</p>
                        <div class="msg-per-detail text-right">
                            <span class="msg-time txt-grey" title="{{$reply->created_at->format('F d, Y g:i A')}}">{{ $reply->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>  
            </li>
        @endif()
        @if($reply->user->id == Auth::user()->id)
            <li class="self mb-10">
                <div class="self-msg-wrap">
                    <div class="msg block pull-right">{!! nl2br(e($reply->reply)) !!}
                        <div class="msg-per-detail text-right">
                            <span class="msg-time txt-grey" title="{{$reply->created_at->format('F d, Y g:i A')}}">{{ $reply->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>  
            </li>
        @endif()
    @endforeach()
</ul>