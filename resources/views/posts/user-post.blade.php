@extends('layouts.master')

@section('title')
    @if(count($posts) > 0)
        @if(Auth::user() && Auth::user()->id == $user->id)
            My Posts
        @endif
        @if(!Auth::user() || Auth::user()->id != $user->id)
            {{ $user->first_name }}'s Posts
        @endif
    @endif
@endsection

@section('content')
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            @if(count($posts) == 0)
                @if(!Auth::user() || Auth::user()->id != $user->id)
                    <h4>This user doesn't have any post at the moment</h4>
                @endif
                @if(Auth::user() && Auth::user()->id == $user->id)
                    <h4>You don't have any post at the moment</h4>
                    <p><a href="{{ route('dashboard') }}"> Click here to create your first post. </a></p>
                @endif
            @endif
            @if(count($posts) > 0)
                @if(Auth::user() && Auth::user()->id == $user->id)
                    <h3>My Posts</h3>
                @endif
                @if(!Auth::user() || Auth::user()->id != $user->id)
                    <h3>{{ $user->first_name }}'s Posts</h3>
                @endif
            @endif
            @foreach($posts as $post)
                <a href="{{ route('post.get', ['post_id' => $post->id]) }}" style="text-decoration:none">
                            <div class="form-group div_hover col-md-12">
                                <div class="col-md-6">
                                    <article class="post" data-postid="{{ $post->id }}">
                                        <p class="body text-uppercase">{{ $post->title }}</p>
                                        <div class="info">
                                            <p class="body text-uppercase">{{ $post->location }}</p>
                                            Posted by {{ $post->user->first_name }} {{ $post->created_at->diffForHumans() }}
                                            <h6>{{ $post->view_count }} views</h6>
                                        </div>
                                    </article>
                                </div>
                                <div class="col-md-6">
                                    <img src="{{ route('post.image', ['filename' => $post->image_name]) }}" alt=""
                                         class="img-responsive center-block" style="height: 80px;">
                                </div>
                            </div>
                        
                    {{-- <div class="interaction">
                    <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a> |
                    <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'  }}</a>

                    @if(Auth::user() == $post->user)
                    |
                    <a href="#" class="edit">Edit</a> |
                    <a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a> |
                    @endif

                </div> --}}
                </a>
            @endforeach
            <div class="text-center">
                {{ $posts->links() }}
            </div>
        </div>
    </section>
@endsection