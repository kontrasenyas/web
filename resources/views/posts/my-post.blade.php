@extends('layouts.master')

@section('title')
    My Posts
@endsection

@section('content')
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <h3>My Posts</h3>
            @foreach($posts as $post)
                <a href="{{ route('post.get', ['post_id' => $post->id]) }}" style="text-decoration:none">
                    <div class="form-group div_hover col-md-12">
                        <article class="post row" data-postid="{{ $post->id }}">
                            <div class="col-md-12"><p class="body text-uppercase text-center">{{ $post->title }}</p>
                            </div>
                            <div class="col-md-6">
                                <div class="info">
                                    <p class="body text-uppercase">{{ $post->location }}</p>
                                    Posted by {{ $post->user->first_name }} {{ $post->created_at->diffForHumans() }}﻿
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img src="{{ route('post.image', ['filename' => $post->image_name]) }}" alt=""
                                     class="img-responsive center-block" style="height: 70px;">
                            </div>
                        </article>
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