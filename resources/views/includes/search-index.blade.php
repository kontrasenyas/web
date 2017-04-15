@extends('layouts/master')

@section('title')
    Libot Philippines
@endsection

@section('content')
    @include('includes.search')
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            @if(count($posts) < 1)
                <div class="col-md-6">
                    No results!
                </div>
            @endif
            @if(count($posts) > 0)
                <div class="col-md-12"> <p class="info"> {{ $posts->count() }} result/s </p></div>
                <div class="col-md-12">
                    @foreach($posts as $post)
                        <a href="{{ route('post.get', ['post_id' => $post->id]) }}" style="text-decoration:none">
                            <div class="form-group div_hover col-md-12">
                                <div class="col-md-6">
                                    <article class="post" data-postid="{{ $post->id }}">
                                        <p class="body text-uppercase">{{ $post->title }}</p>
                                        <div class="info">
                                            <p class="body text-uppercase">{{ $post->location }}</p>
                                            Posted by {{ $post->user->first_name }} {{ $post->created_at->diffForHumans() }}
                                        </div>
                                    </article>
                                </div>
                                <div class="col-md-6">
                                    <img src="{{ route('post.image', ['filename' => $post->image_name]) }}" alt=""
                                         class="img-responsive center-block" style="height: 110px;">
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="col-md-12 text-center">
                    {{ $posts->appends(Request::except('page'))->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection