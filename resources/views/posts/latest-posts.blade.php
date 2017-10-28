@if(count($posts) < 1)
    <div class="col-md-6">
        Currently there is no post available.
    </div>
@endif

@if(count($posts) > 0)
    @foreach($posts as $post)
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" data-postid="{{ $post->id }}">        
        <div class="panel panel-primary contact-card card-view" id="div-post">
            <div class="panel-heading">
                <div class="pull-left">
                    <div class="pull-left user-img-wrap mr-15">
                        <img class="card-user-img img-circle pull-left" src="{{ route('post.image', ['filename' => $post->image_name]) }}" alt="user"/>
                    </div>
                    <div class="pull-left user-detail-wrap">    
                        <span class="block card-user-name">
                            {{ $post->title }}
                        </span>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body row">
                    <div class="user-others-details pl-15 pr-15">
                        <span class="block card-user-desn">Details:</span>
                        <div class="mb-15">
                            <i class="zmdi inline-block mr-10">Location:</i>
                            <span class="inline-block txt-dark">{{ str_limit($post->location, $limit = 22, $end = '...') }}</span>
                        </div>                        
                        <div class="mb-15">
                            <i class="zmdi inline-block mr-10">Contact No.:</i>
                            <span class="inline-block txt-dark">{{ $post->user->mobile_no }}</span>
                        </div>
                        <div class="mb-15">
                            <i class="zmdi inline-block mr-10">Description:</i>
                            <span class="inline-block txt-dark">{{ str_limit($post->body, $limit = 15, $end = '...') }}</span>
                        </div>
                    </div>
                    <hr class="light-grey-hr mt-20 mb-20"/>
                    <div class="emp-detail pl-15 pr-15">                        
                        <div>
                            <span class="inline-block capitalize-font mr-5">posted by:</span>
                            <span class="txt-dark">{{ $post->user->first_name }} {{ $post->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="mb-5">
                            <span class="inline-block capitalize-font mr-5">{{ $post->view_count }} views</span>
                        </div>
                    </div>                        
                </div>
            </div>
            <a href="{{ route('post.get', ['post_id' => $post->id]) }}"><span class="link-spanner"></span></a>
        </div>
        @if(!Auth::user() || (Auth::user() && (Auth::user()->id != $post->user->id) ))
            @if(Auth::user())
            <div class="text-center">
                <a href="{{ route('get.message-post', ['user_id' => $post->user->id, 'post_id' => $post->id]) }}" class="sendMessagePost">
                    <div class="btn btn-primary btn-anim">
                        <i class="fa fa-envelope"></i><span class="btn-text" title="Send message to this user.">Send a message</span>
                    </div>
                </a>
            </div>
            @endif    
            @if(!Auth::user())
            <div class="text-center">
                <a href="#" data-toggle="modal" data-target="#register-first">
                    <div class="btn btn-primary btn-anim">
                        <i class="fa fa-envelope"></i><span class="btn-text" title="Please register to send a message.">Send a message</span>
                    </div>
                </a>
            </div>
            @endif
        @endif
        @if(!Auth::user() || (Auth::user() && (Auth::user()->id == $post->user->id) ))
            @if(Auth::user())
            <div class="text-center">
                <a href="{{ route('post.get', ['post_id' => $post->id]) }}">
                    <div class="emp-detail pl-15 pr-15 text-center btn btn-default btn-anim">
                         <i class="fa fa-pencil"></i><span class="btn-text" title="Edit your post">edit post</span>
                    </div>
                </a>
            </div>
            @endif
        @endif
    </div>
    @endforeach()
@endif()
<div class="col-md-12 text-center">
    {{ $posts->appends(Request::except('page'))->links() }}
</div>

@include('includes.register-first')

<style type="text/css">
    #div-post{
        /*Important:*/
        position:relative;
    }

    #div-post:hover { background-color: #eff0f1; }

    /*Important:*/
    .link-spanner{
        position:absolute; 
        width:100%;
        height:100%;
        top:0;
        left: 0;
        z-index: 1;

        /* edit: fixes overlap error in IE7/8, 
        make sure you have an empty gif 
        background-image: url('empty.gif');*/
    }   
</style>

<script type="text/javascript">
    $('.sendMessagePost').on('click', function(e) {
        e.preventDefault();
        var messageLink = $(this).attr('href');
        var embedMessage = document.getElementById("getTopMessage");
        var clone = embedMessage.cloneNode(true);
        clone.setAttribute('src', messageLink);
        embedMessage.parentNode.replaceChild(clone, embedMessage);
        $("#sendMessageModal").modal()
    });
</script>