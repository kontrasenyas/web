@section('title')
{{ $post->title }}
@endsection

@extends('layouts.master')

@section('content')
<div class="row">
	<div class="col-md-12 text-center page-header">
		<h1 class="text-uppercase">{{ $post->title }}</h1>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			@if(Auth::user() == $post->user)
			<label for="image" style="display: block;">
				@endif
				<img src="{{ route('post.image', ['filename' => $post->image_name]) }}" alt="" class="img-responsive center-block" width="50%" height="50%">
			</label>
		</div>
		@if(Auth::user() == $post->user)
		<div class="form-group text-center">
			
			{{-- <input type="file" name="image" class="form-control" id="image"> --}}
			<form action="{{ route('post.image-update') }}" method="post"  enctype="multipart/form-data">
				<div class="form-group">
					<label for="image" class="info">Change photo (must be a valid image file)</label>
				</div>
				<div class="form-group">
					<label class="btn btn-default btn-file">
						Browse <input type="file" hidden id="image" name="image">
					</label>
				</div>
				<input type="post_id" name="post_id" hidden value="{{ $post->id }}">
				<div class="form-group">
					<button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();">Save Image</button>
				</div>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
			</form>
		</div>
		@endif
	</div>
	<div class="col-md-6">
		<section class="row posts">
			<div class="col-md-12">
				<article class="post" data-postid="{{ $post->id }}">
					<div class="page-header">
						<h3>Details</h3>
					</div>
					{{-- <p class="body">Details</p> --}}
					<div class="col-md-12" id="details">
						<p class="body col-md-12" id="body">{{ $post->body }}</p>
						<p class="capacity col-md-12" id="capacity">{{ $post->capacity }}</p>
						<p class="contact col-md-12 form-group" id="contact">{{ $post->contact_no }}</p>
						<p class="location col-md-12 form-group" id="location">{{ $post->location }}</p>
					</div>
					<div class="info">
						Posted by <a href="{{ route('account.profile', ['id' => $post->user->id]) }}">{{ $post->user->first_name }} {{ $post->user->last_name }}</a> on {{ $post->created_at->diffForHumans() }}﻿
					</div>					
					<div class="interaction">
						{{-- <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a> |
						<a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'  }}</a> --}}						
						
						
						@if(Auth::user() == $post->user)
						|
						<a href="#" class="edit">Edit</a> | 
						<a href="{{ route('post.delete', ['post_id' => $post->id]) }}" onclick="return confirm('Are you sure?')">Delete</a> |
						@endif
					</div>

				</article>
			</div>
		</section>
	</div>
</div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Edit Post</h4>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label for="post-body">Details</label>
						<textarea name="post-body" id="post-body" rows="5" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<label for="post-body">Capacity</label>
						<input type="number" name="post-capacity" id="post-capacity" rows="5" class="form-control">
					</div>
					<div class="form-group">
						<label for="post-body">Contact Number</label>
						<input type="text" name="post-contact" id="post-contact" rows="5" class="form-control">
					</div>
					<div class="form-group">
						<label for="post-body">Location</label>
						<input type="text" name="post-location" id="post-location" rows="5" class="form-control typeahead">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	var token = '{{ Session::token() }}';
	var urlEdit = '{{ route('edit') }}';
	var urlLike = '{{ route('like') }}';


</script>
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
</script>
@endsection