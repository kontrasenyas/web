@extends('layouts.master')

@section('content')
@include('includes.message-block')
<section class="row new-post">
	<div class="col-md-6 col-md-offset-3">
		<h3>What do you have?</h3>
		<form action="{{ route('post.create') }}" method="post"  enctype="multipart/form-data">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Title (Eg. Van for rent)" aria-describedby="basic-addon2" name="title" id="title" value="{{ Request::old('title') }}">
			</div>
			<div class="form-group">
				<input type="number" class="form-control" placeholder="Capacity" aria-describedby="basic-addon2" name="capacity" id="capacity" value="{{ Request::old('capacity') }}">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Contact No (Eg. 09051234567)" aria-describedby="basic-addon2" name="contact_no" id="contact_no" value="{{ Request::old('contact_no') }}">
			</div>
			<div class="form-group">
				<input type="text" class="form-control typeahead" placeholder="Your Location" aria-describedby="basic-addon2" name="location" id="location" value="{{ Request::old('location') }}" autocomplete="off">
			</div>
			<div class="form-group">
				<textarea  class="form-control" name="body" id="new-post" rows="5" placeholder="Your Car details (Eg. Toyota Hiace)">{{ Request::old('body') }}</textarea>				
			</div>
			<div class="form-group">
				<label for="image">Photo (must be a valid image file)</label>
				<input type="file" name="image" class="form-control" id="image">
			</div>
			<button type="submit" class="btn btn-primary">Create Post</button>
			<input type="hidden" name="_token" value="{{ Session::token() }}">
		</form>
	</div>
</section>
<section class="row posts">
	<div class="col-md-6 col-md-offset-3">
		<h3>My post</h3>
		@foreach($posts as $post)		
		<a href="{{ route('post.get', ['post_id' => $post->id]) }}" style="text-decoration:none">
			<div class="form-group div_hover">
				<article class="post" data-postid="{{ $post->id }}">

					<p class="body text-uppercase">{{ $post->title }}</p>
					<div class="info">
						Posted {{ $post->created_at->diffForHumans() }}﻿
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

			</article>
		</div>
	</a>
	@endforeach
</div>
</section>
@endsection