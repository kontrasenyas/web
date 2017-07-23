@extends('layouts/master')

@section('title')
    Libot Philippines
@endsection

@section('content')
    <div class="col-md-6 col-md-offset-3">
        @include('includes.search')
    </div>
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            @if(count($posts) < 1)
                <div class="col-md-6">
                    No results!
                </div>
            @endif
            @if(count($posts) > 0)
                <div class="col-md-12"> <p class="info"> {{ $posts->total() }} result/s </p></div>
                <div class="col-md-12">
                    @foreach($posts as $post)
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
                </div>
                <div class="col-md-12 text-center">
                    {{ $posts->appends(Request::except('page'))->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection