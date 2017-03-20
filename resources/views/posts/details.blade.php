@extends('layouts.master')

@section('content')
@include('includes.message-block')
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
					<button type="submit" class="btn btn-primary">Save Image</button>
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
						<p class="body" id="body">{{ $post->body }}</p>
						<p class="contact" id="contact">{{ $post->contact_no }}</p>
						<p class="location" id="location">{{ $post->location }}</p>
					</div>
					<div class="info">
						Posted by {{ $post->user->first_name }} {{ $post->user->last_name }} on {{ $post->created_at->diffForHumans() }}﻿
					</div>
					<div class="interaction">
						{{-- <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a> |
						<a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'  }}</a> --}}

						@if(Auth::user() == $post->user)
						|
						<a href="#" class="edit">Edit</a> | 
						<a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a> |
						@endif

					</div>
				</article>
			</div>
		</section>
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
						<label for="post-body">Contact Number</label>
						<input type="text" name="post-contact" id="post-contact" rows="5" class="form-control">
					</div>
					<div class="form-group">
						<label for="post-body">Location</label>
						<input type="text" name="post-location" id="post-location" rows="5" class="form-control">
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