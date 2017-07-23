<h2>Recent posts</h2>
<div class="col-md-12">
    @if(count($posts) < 1)
    <div class="col-md-6">
        Currently there is no post available.
    </div>
    @endif
    @if(count($posts) > 0)
    @foreach($posts as $post)    
    <p><strong>{{ $post->user->first_name }} {{ $post->user->last_name }}</strong>
    @if(Auth::user() || (Auth::user() && (Auth::user()->id != $post->user->id) ))
    <a href="{{ route('get.message-post', ['user_id' => $post->user->id, 'post_id' => $post->id]) }}"><span class="glyphicon glyphicon-envelope text-primary" title="Send message to this user."></span></a>
    @endif
    @if(!Auth::user())
    <a href="#" data-toggle="modal" data-target="#register-first"><span class="glyphicon glyphicon-envelope text-primary" title="Please register to send a message."></span></a>
    @endif
    </p>
    <a href="{{ route('post.get', ['post_id' => $post->id]) }}" style="text-decoration:none">
        <div class="form-group div_hover col-md-12">                    
            <div class="post row" data-postid="{{ $post->id }}">                
                <div class="col-md-6">
                    <h4 class="body text-uppercase">{{ $post->title }}</h4>                
                    <div class="info">
                        <p class="body text-uppercase">{{ str_limit($post->location, $limit = 22, $end = '...') }}</p>
                        <p>Posted by {{ $post->user->first_name }} {{ $post->created_at->diffForHumans() }}</p>
                        <p>Contact No: {{ $post->user->mobile_no }}</p>
                        <p>Description: {{ str_limit($post->body, $limit = 15, $end = '...') }}</p>
                        <h6>{{ $post->view_count }} views</h6>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="{{ route('post.image', ['filename' => $post->image_name]) }}" alt=""
                    class="img-responsive center-block" style="width: : 100%;">
                </div>                
            </div>
        </div>
    </a>
    @endforeach
    @endif
    <div class="text-center">
        {{ $posts->appends(Request::except('page'))->links() }}
    </div>
</div>

@include('includes.register-first')