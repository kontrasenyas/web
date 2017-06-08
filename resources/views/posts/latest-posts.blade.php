<h2>Latest Posts</h2>
<section class="row posts">
    <div class="col-md-12 col-md-offset-0">
        @if(count($posts) < 1)
            <div class="col-md-6">
                Currently there is no post available.
            </div>
        @endif
        @if(count($posts) > 0)
            @foreach($posts as $post)
                <a href="{{ route('post.get', ['post_id' => $post->id]) }}" style="text-decoration:none">
                    <div class="form-group div_hover col-md-4">
                        <article class="post row" data-postid="{{ $post->id }}">
                            <div class="col-md-12"><p class="body text-uppercase text-center">{{ $post->title }}</p></div>
                            <div class="col-md-6">
                                <div class="info">
                                    <p class="body text-uppercase">{{ $post->location }}</p>
                                    Posted by {{ $post->user->first_name }} {{ $post->created_at->diffForHumans() }}
                                    <h6>{{ $post->view_count }} views</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img src="{{ route('post.image', ['filename' => $post->image_name]) }}" alt=""
                                     class="img-responsive center-block" style="height: 110px;">
                            </div>
                        </article>
                    </div>
                </a>
            @endforeach
        @endif
    </div>
</section>
<div class="text-center">
    {{ $posts->appends(Request::except('page'))->links() }}
</div>