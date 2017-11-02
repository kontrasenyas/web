@if(count($list) == 0)
    <div class="input-group pa-5"><p>There is no message. Please start conversation with others.</p></div>
@endif()
<!-- <a  href="javascript:void(0)">
<div class="chat-data active-user">
    <img class="user-img img-circle"  src="dist/img/user.png" alt="user"/>
    <div class="user-data">
        <span class="name block capitalize-font">Clay Masse</span>
        <span class="time block truncate txt-grey">No one saves us but ourselves.</span>
    </div>
    <div class="status away"></div>
    <div class="clearfix"></div>
</div>
</a> -->
@foreach($list as $each)
@if($each->user_one == Auth::user()->id)
<a href="{{ route('get.message', ['user_id' => $each->user_two]) }}" class="message-link">
    @if($each->latest_user_reply == Auth::user()->id)
    <div class="chat-data">
        <img class="user-img img-circle"  src="{{ route('account.image', ['filename' => $each->profile_picture_path]) }}" alt="user"/>
        <div class="user-data">
            <span class="name block capitalize-font">{{ $each->first_name }} {{ $each->last_name }}</span>
            <span class="time block truncate txt-grey">You: {{ $each->reply }}</span>
            <span class="time block truncate txt-grey">{{ Carbon\Carbon::parse($each->mr_created)->diffForHumans() }}</span>
        </div>
        <div class="status online"></div>
        <div class="clearfix"></div> 
    </div>
    @endif()
    @if($each->latest_user_reply != Auth::user()->id)
    @if($each->is_read == 0)
    <div class="chat-data active-user">
        @endif
        @if($each->is_read == 1)
        <div class="chat-data">  
            @endif  
            <img class="user-img img-circle"  src="{{ route('account.image', ['filename' => $each->profile_picture_path]) }}" alt="user"/>
            <div class="user-data">
                <span class="name block capitalize-font">{{ $each->first_name }} {{ $each->last_name }}</span>
                <span class="time block truncate txt-grey">You: {{ $each->reply }}</span>
                <span class="time block truncate txt-grey">{{ Carbon\Carbon::parse($each->mr_created)->diffForHumans() }}</span>
            </div>
            <div class="status online"></div>
            <div class="clearfix"></div> 
        </div>
        @endif()
</a>
@endif()
@if($each->user_two == Auth::user()->id)
    <a href="{{ route('get.message', ['user_id' => $each->user_one]) }}" class="message-link">
        @if($each->latest_user_reply == Auth::user()->id)
        <div class="chat-data">
            <img class="user-img img-circle"  src="{{ route('account.image', ['filename' => $each->profile_picture_path]) }}" alt="user"/>
            <div class="user-data">                                                                                    
                <span class="name block capitalize-font">{{ $each->first_name }} {{ $each->last_name }}</span>
                <span class="time block truncate txt-grey">{{ $each->reply }}</span>
                <span class="time block truncate txt-grey">{{ Carbon\Carbon::parse($each->mr_created)->diffForHumans() }}</span>
            </div>
            <div class="status online"></div>
            <div class="clearfix"></div> 
        </div>
        @endif()
        @if($each->latest_user_reply != Auth::user()->id)
        @if($each->is_read == 0)
        <div class="chat-data active-user">
            @endif
            @if($each->is_read == 1)
            <div class="chat-data">  
                @endif  
                <img class="user-img img-circle"  src="{{ route('account.image', ['filename' => $each->profile_picture_path]) }}" alt="user"/>
                <div class="user-data">
                    <span class="name block capitalize-font">{{ $each->first_name }} {{ $each->last_name }}</span>
                    <span class="time block truncate txt-grey">{{ $each->reply }}</span>
                    <span class="time block truncate txt-grey">{{ Carbon\Carbon::parse($each->mr_created)->diffForHumans() }}</span>
                </div>
                <div class="status online"></div>
                <div class="clearfix"></div> 
            </div>
            @endif()
        </a>
@endif()
@endforeach()

<script type="text/javascript">
    $('.message-link').on('click', function(e) {
        e.preventDefault();
        var messageLink = $(this).attr('href');
        var embedMessage = document.getElementById("getMessage");
        var clone = embedMessage.cloneNode(true);
        clone.setAttribute('src', messageLink);
        embedMessage.parentNode.replaceChild(clone, embedMessage)
    });
    $('.chatapp-nicescroll-bar').slimscroll({height:'543px',size: '4px',color: '#878787',disableFadeOut : true,borderRadius:0});
</script>