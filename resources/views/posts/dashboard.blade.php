@extends('layouts.master')

@section('title')
	Dashboard
@endsection

@section('content')
<section class="row new-post">
	<div class="col-md-6">
		<h3>What do you have?</h3>
		<form action="{{ route('post.create') }}" method="post"  enctype="multipart/form-data">
			<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
				<input type="text" class="form-control" placeholder="Title" aria-describedby="basic-addon2" name="title" id="title" value="{{ Request::old('title') }}">
			</div>
			<div class="form-group {{ $errors->has('capacity') ? 'has-error' : '' }}">
				<input type="number" class="form-control" placeholder="Capacity" aria-describedby="basic-addon2" name="capacity" id="capacity" value="{{ Request::old('capacity') }}">
			</div>
			<div class="form-group {{ $errors->has('contact_no') ? 'has-error' : '' }}">
				<input type="text" class="form-control" placeholder="Contact No (Eg. 09051234567)" aria-describedby="basic-addon2" name="contact_no" id="contact_no" value="{{ Request::old('contact_no') }}">
			</div>
			<div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
				<input type="text" class="form-control" placeholder="Destination" aria-describedby="basic-addon2" name="location" id="location" value="{{ Request::old('location') }}" autocomplete="off">
			</div>
			<div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
				<textarea  class="form-control" name="body" id="new-post" rows="5" placeholder="Other details (Eg. Toyota Hiace, Trip to Tagaytay.)">{{ Request::old('body') }}</textarea>				
			</div>
			<div class="form-group">
				<label for="input-id">Photo (must be a valid image file)</label>
				{{-- <input type="file" name="image" class="form-control" id="image"> --}}
				<input name="image" id="input-id" type="file" class="file" data-preview-file-type="text">
			</div>
			<button type="submit" class="btn btn-success" onclick="this.disabled=true;this.form.submit();">Create Post</button>
			<input type="hidden" name="_token" value="{{ Session::token() }}">
		</form>
	</div>
	<div class="col-md-6 posts">
		<div class="col-md-12" style="min-height: 480px;">
		<h3>My Recent Posts</h3>
		@if(count($posts) == 0)               
            @if(Auth::user())
				<h4>You don't have any post at the moment</h4><br/>
				<label for="title"><span class="glyphicon glyphicon-arrow-left"></span> Create your first post. </label>
            @endif
        @endif
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
                <div class="col-md-12 text-center">
					<h5><a href="{{ route('user-post', ['user_id' => Auth::user()->id]) }}">You have ({{$posts->total()}}) total posts</a></h5>
					<span class="text-muted">You have {{$posts->sum('view_count')}} total views</span>
				</div>
            </div>
	</div>
</section>
<section class="row posts">
	<div class="col-md-12 text-center">
		<h4><a href="{{ route('account.review', ['user_id' =>Auth::user()->id]) }}">You have ({{$reviews->total()}}) total reviews</a></h4>
	</div>
</section>
@endsection

@section('script')
	@include('includes.places-autocomplete')
@endsection