@extends('layouts/master')

@section('title')
Libot Philippines
@endsection

@section('content')
@include('includes.message-block')
@include('includes.search')
<section class="row posts">
	<div class="col-md-6 col-md-offset-3">
		@foreach($posts as $post)
		<a href="{{ route('post.get', ['post_id' => $post->id]) }}" style="text-decoration:none">
			<div class="form-group div_hover">
				<article class="post" data-postid="{{ $post->id }}">

					<p class="body text-uppercase">{{ $post->title }}</p>
					<div class="info">
						Posted {{ $post->created_at->diffForHumans() }}﻿
					</div>
				</article>
			</div>
		</a>
	</div>
</section>
@endforeach
@endsection