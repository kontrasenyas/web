@extends('layouts.master')

@section('title')
	Dashboard
@endsection

@section('content')
<section class="row new-post">
	<div class="col-md-6 col-md-offset-3">
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
				<input type="text" class="form-control typeahead" placeholder="Your Location" aria-describedby="basic-addon2" name="location" id="location" value="{{ Request::old('location') }}" autocomplete="off">
			</div>
			<div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
				<textarea  class="form-control" name="body" id="new-post" rows="5" placeholder="Other details (Eg. Toyota Hiace, Trip to Tagaytay.)">{{ Request::old('body') }}</textarea>				
			</div>
			<div class="form-group">
				<label for="image">Photo (must be a valid image file)</label>
				<input type="file" name="image" class="form-control" id="image">
			</div>
			<button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();">Create Post</button>
			<input type="hidden" name="_token" value="{{ Session::token() }}">
		</form>
	</div>
</section>
<section class="row posts">
	<div class="col-md-12 text-center">
		<h3><a href="{{ route('user-post', ['user_id' => Auth::user()->id]) }}">My Posts ({{count($posts)}})</a></h3>
	</div>
</section>
@endsection

@section('script')
	@include('includes.places-autocomplete')
@endsection

