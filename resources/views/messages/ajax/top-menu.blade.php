@if(count($list) == 0)
    <div class="input-group pa-5"><p>There is no message. Please start conversation with others.</p></div>
@endif()
@foreach($list as $each)
@if($each->user_one == Auth::user()->id)
<a href="{{ route('get.message', ['user_id' => $each->user_two]) }}" class="message-link">
    @if($each->latest_user_reply == Auth::user()->id)
    <div class="sl-item">
		<div class="icon bg-green">
			<i class="zmdi zmdi-flag"></i>
		</div>
		<div class="sl-content">
			<span class="inline-block capitalize-font  pull-left truncate head-notifications">{{ $each->first_name }} {{ $each->last_name }}</span>
			<span class="inline-block font-11  pull-right notifications-time">{{ Carbon\Carbon::parse($each->mr_created)->diffForHumans() }}</span>
			<div class="clearfix"></div>
			<p class="truncate">You: {{ $each->reply }}</p>
		</div>  
	</div>
	<hr class="light-grey-hr ma-0"/>
    @endif()
    @if($each->latest_user_reply != Auth::user()->id)
    @if($each->is_read == 0)
    <div class="sl-item active-user">
        @endif
        @if($each->is_read == 1)
        <div class="sl-item">
            @endif
				<div class="icon bg-green">
					<i class="zmdi zmdi-flag"></i>
				</div>
				<div class="sl-content">
					<span class="inline-block capitalize-font  pull-left truncate head-notifications">{{ $each->first_name }} {{ $each->last_name }}</span>
					<span class="inline-block font-11  pull-right notifications-time">{{ Carbon\Carbon::parse($each->mr_created)->diffForHumans() }}</span>
					<div class="clearfix"></div>
					<p class="truncate">You: {{ $each->reply }}</p>
				</div>   
			</div>
			<hr class="light-grey-hr ma-0"/>
        @endif()
</a>
@endif()
@if($each->user_two == Auth::user()->id)
    <a href="{{ route('get.message', ['user_id' => $each->user_one]) }}" class="message-link">
        @if($each->latest_user_reply == Auth::user()->id)
        <div class="sl-item">
			<div class="icon bg-green">
				<i class="zmdi zmdi-flag"></i>
			</div>
			<div class="sl-content">
				<span class="inline-block capitalize-font  pull-left truncate head-notifications">{{ $each->first_name }} {{ $each->last_name }}</span>
				<span class="inline-block font-11  pull-right notifications-time">{{ Carbon\Carbon::parse($each->mr_created)->diffForHumans() }}</span>
				<div class="clearfix"></div>
				<p class="truncate">{{ $each->reply }}</p>
			</div>  
		</div>
		<hr class="light-grey-hr ma-0"/>
        @endif()
        @if($each->latest_user_reply != Auth::user()->id)
        @if($each->is_read == 0)
        <div class="sl-item active-user">
            @endif
            @if($each->is_read == 1)
            <div class="sl-item">
                @endif                
					<div class="icon bg-green">
						<i class="zmdi zmdi-flag"></i>
					</div>
					<div class="sl-content">
						<span class="inline-block capitalize-font  pull-left truncate head-notifications">{{ $each->first_name }} {{ $each->last_name }}</span>
						<span class="inline-block font-11  pull-right notifications-time">{{ Carbon\Carbon::parse($each->mr_created)->diffForHumans() }}</span>
						<div class="clearfix"></div>
						<p class="truncate">{{ $each->reply }}</p>
					</div>  
				</div>
				<hr class="light-grey-hr ma-0"/>
            @endif()
        </a>
@endif()
@endforeach()

<script type="text/javascript">
	$('.message-link').on('click', function(e) {
        e.preventDefault();
        var messageLink = $(this).attr('href');
        var embedMessage = document.getElementById("getTopMessage");
        var clone = embedMessage.cloneNode(true);
        clone.setAttribute('src', messageLink);
        embedMessage.parentNode.replaceChild(clone, embedMessage);
		$("#sendMessageModal").modal()
    });
</script>