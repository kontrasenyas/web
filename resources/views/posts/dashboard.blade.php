@extends('layouts.master')

@section('content')
@include('includes.message-block')
<section class="row new-post">
	<div class="col-md-6 col-md-offset-3">
		<h3>What do you have?</h3>
		<form action="{{ route('post.create') }}" method="post"  enctype="multipart/form-data">
			<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
				<input type="text" class="form-control" placeholder="Title (Eg. Van for rent)" aria-describedby="basic-addon2" name="title" id="title" value="{{ Request::old('title') }}">
			</div>
			<div class="form-group {{ $errors->has('capacity') ? 'has-error' : '' }}">
				<input type="number" class="form-control" placeholder="Capacity" aria-describedby="basic-addon2" name="capacity" id="capacity" value="{{ Request::old('capacity') }}">
			</div>
			<div class="form-group {{ $errors->has('contact_no') ? 'has-error' : '' }}">
				<input type="text" class="form-control" placeholder="Contact No (Eg. 09051234567)" aria-describedby="basic-addon2" name="contact_no" id="contact_no" value="{{ Request::old('contact_no') }}">
			</div>
			<div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
				<input type="text" class="form-control typeahead" placeholder="Your Location" aria-describedby="basic-addon2" name="location" id="location" value="{{ Request::old('location') }}" autocomplete="off">
			</div>
			<div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
				<textarea  class="form-control" name="body" id="new-post" rows="5" placeholder="Other details (Eg. Toyota Hiace, Trip to Tagaytay.)">{{ Request::old('body') }}</textarea>				
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
			<div class="form-group div_hover col-md-12">
				<div class="col-md-6">
					<article class="post" data-postid="{{ $post->id }}">
						<p class="body text-uppercase">{{ $post->title }}</p>					
						<div class="info">
							<p class="body text-uppercase">{{ $post->location }}</p>
							Posted {{ $post->created_at->diffForHumans() }}﻿
						</div>
					</article>
				</div>
				<div class="col-md-6">
					<img src="{{ route('post.image', ['filename' => $post->image_name]) }}" alt="" class="img-responsive center-block" style="height: 110px;">
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
	</div>
</section>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script> 
<script type="text/javascript">
	var path = "{{ route('search.location') }}";
	$('input.typeahead').typeahead({
		minLength: 1,
		source:  function (query, process) {
			return $.get(path, { query: query }, function (data) {
				return process(data);
			});
		}
	}); 

	var $input = $(".typeahead");
	$input.change(function() {
		var current = $input.typeahead("getActive");
		if (current) {
			if (current.name == $input.val()) {
				console.log('2');
			} else {
				$('#location').val("");
			}
		} else {
			$('#location').val("");
		}
	});

            // $("#location").focus(function() {
            //  console.log('in');
            // }).blur(function() {
            //  console.log('out');
            // });  

</script>
@endsection