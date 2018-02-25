@extends('layouts.main')

@section('meta')
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="Libot Philippines -  {{ $post->title }} .. {{ $post->body }}" />
    <meta name="keywords" content="libot, libot philippines, travel, libot travel, rent, {{ $post->title }}, {{ $post->body }}" />
    <meta name="author" content="libot-ph"/>

    <meta property="fb:app_id"      content="1236189279823899" />
    <meta property="og:url"           content="{{ url()->current() }}" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="Libot Philippines  -  {{ $post->title }}" />
	<meta property="og:description"   content="{{ $post->body }}" />
	<meta property="og:image"         content="{{ route('post.image', ['filename' => $post->image_name]) }}" />
@endsection()

@section('title')
{{ $post->title }}
@endsection

@section('css')
	<!-- jquery-steps css -->
	<link rel="stylesheet" href="vendors/bower_components/jquery.steps/demo/css/jquery.steps.css">

	<!-- bootstrap-touchspin CSS -->
	<link href="vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css"/>

	<link href="vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">

	<!-- Custom CSS -->
	<link href="dist/css/style.css" rel="stylesheet" type="text/css">

	<!-- File Upload CSS -->
	<link href="{{ URL::to('plugins/file-upload/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css" />

	<style type="text/css">
		#body {
		    white-space: pre;
		}
	</style>
@endsection()

@section('content')
<div class="container-fluid">
	<!-- Title -->
	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h5 class="txt-dark">post detail</h5>
		</div>
		<!-- Breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="{{ route('home') }}">Home</a></li>
				<li><a href="{{ route('user-post', ['user_id' => $post->user->id]) }}"><span>post</span></a></li>
				<li class="active"><span>post detail</span></li>
			</ol>
		</div>
		<!-- /Breadcrumb -->
	</div>
	<!-- /Title -->

	<!-- Row -->
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default card-view">
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
						<div class="row">
							<div class="col-md-3">
								<div class="item-big">
									<!-- START carousel-->
									<div id="carousel-example-captions-1" data-ride="carousel" class="carousel slide">
										<ol class="carousel-indicators">
											@foreach($post_photos as $post_photo)
												@if($loop->first)
													<li data-target="#carousel-example-captions-1" data-slide-to="{{$loop->index}}" class="active"></li>
												@endif()
												@if(!$loop->first)
													<li data-target="#carousel-example-captions-1" data-slide-to="{{$loop->index}}"></li>
												@endif()
											@endforeach
										</ol>
										<div role="listbox" class="carousel-inner">
											@if(count($post_photos) == 0)
												<div class="item active"> <img src="{{ route('post.image', ['filename' => $post->image_name]) }}" alt="First slide image"> </div>
											@endif()
											@foreach($post_photos as $post_photo)
												@if($loop->first)
													<div class="item active">
														@if(Auth::user() == $post->user)
															<div style="position:absolute;right:0;top:0;">
																<form action="{{ route('post.image-delete', ['filename' => $post_photo->filename]) }}" method="get">
																	<button class="btn btn-info btn-icon-anim btn-circle" href="{{ route('post.image-delete', ['filename' => $post_photo->filename]) }}" class="btn btn-danger btn-anim" onclick="return confirm('Are you sure?')" title="Delete this photo">
																	<i class="icon-trash"></i>
																	</button>
																	<input type="hidden" name="_token" value="{{ Session::token() }}">
																</form>
															</div>
														@endif()
														<img src="{{ route('post.image', ['filename' => $post_photo->filename]) }}" alt="{{ $post->title }}">
													</div>
												@endif
												@if(!$loop->first)
													<div class="item">
														@if(Auth::user() == $post->user)
															<div style="position:absolute;right:0;top:0;">
																<form action="{{ route('post.image-delete', ['filename' => $post_photo->filename]) }}" method="get">
																	<button class="btn btn-info btn-icon-anim btn-circle" class="btn btn-danger btn-anim" onclick="return confirm('Are you sure?')" title="Delete this photo">
																	<i class="icon-trash"></i>
																	</button>
																	<input type="hidden" name="_token" value="{{ Session::token() }}">
																</form>
															</div>
														@endif()
														<img src="{{ route('post.image', ['filename' => $post_photo->filename]) }}" alt="{{ $post->title }}">
													</div>
												@endif
											@endforeach
										</div>
									</div>
									<!-- END carousel-->

								</div>
							</div>	

							<div class="col-md-9">
								<div class="product-detail-wrap post" data-postid="{{ $post->id }}">									
									<h3 class="mb-20 weight-500">{{ $post->title }}</h3>
									{{-- <div class="product-price head-font mb-30">$ 1234</div> --}}
									<div class="mb-0 info">Posted by <a href="{{ route('account.profile', ['id' => $post->user->id]) }}">{{ $post->user->first_name }} {{ $post->user->last_name }}</a>  on {{ $post->created_at->diffForHumans() }}﻿</div>
									<div class="product-rating inline-block mt-0">
										{{ $rating }}&nbsp;<a href="javascript:void(0);" class="zmdi zmdi-star"></a>
									</div>
									<div class="average-review inline-block mb-10">(<span class="review-count">{{count($reviews) }}</span> user review)</div>
									<div class="mb-20" id="details">
										<!-- <p><strong>Description: </strong><br/><span id="body">{!! nl2br(e($post->body)) !!}</span></p> -->
										<p><span id="location" class="panel-title txt-dark">{{ $post->type }}</span></p>
										<p><strong>Capacity: </strong><span id="capacity">{{ $post->capacity }}</span></p>
										<p><strong>Contact No: </strong><span id="contact">{{ $post->contact_no }}</span></p>
										<p><strong>Destination: </strong><span id="location">{{ $post->location }}</span></p>
									</div>
									<div class="interaction mr-10 mb-20">
											{{-- <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a> |
											<a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'  }}</a> --}}										
											@if(Auth::user() == $post->user)
											<div class="btn-group mr-10">
												<a class="edit btn btn-success btn-anim"><i class="fa fa-pencil"></i><span class="btn-text">Edit</span></a>
											</div>
											<div class="btn-group mr-10">
												<a href="{{ route('post.delete', ['post_id' => $post->id]) }}" class="btn btn-danger btn-anim" onclick="return confirm('Are you sure?')"><i class="fa fa-minus-square-o"></i><span class="btn-text">Delete</span></a>
											</div>
											@endif											
									</div>

									{{-- <input class="vertical-spin" type="text" data-bts-button-down-class="btn btn-default"   data-bts-button-up-class="btn btn-default" value="1" name="vertical-spin"> --}}
									@if(Auth::user() != $post->user)
									{{-- <div class="btn-group wishlist mb-20">
										<button class="btn btn-warning btn-outline btn-anim"><i class="icon-heart"></i><span class="btn-text">add to wishlist</span></button>
									</div> --}}
									@endif()
									@if(!Auth::user() || (Auth::user() && (Auth::user()->id != $post->user->id) ))
							            @if(Auth::user())
							            <div class="btn-group wishlist mb-20">
							                <a href="{{ route('get.message-post', ['user_id' => $post->user->id, 'post_id' => $post->id]) }}" class="sendMessagePost">
							                    <div class="btn btn-primary btn-anim">
							                        <i class="fa fa-envelope"></i><span class="btn-text" title="Send message to this user.">Send a message</span>
							                    </div>
							                </a>
							            </div>
							            @endif    
							            @if(!Auth::user())
							            <div class="btn-group wishlist mb-20">
							                <a href="#" data-toggle="modal" data-target="#register-first">
							                    <div class="btn btn-primary btn-anim">
							                        <i class="fa fa-envelope"></i><span class="btn-text" title="Please register to send a message.">Send a message</span>
							                    </div>
							                </a>
							            </div>
							            @endif
							        @endif
									<p class="text-muted">{{ $post->view_count }} views</p>
									<div id="fb-root"></div>
									<script>(function(d, s, id) {
									    var js, fjs = d.getElementsByTagName(s)[0];
									    if (d.getElementById(id)) return;
									    js = d.createElement(s); js.id = id;
									    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId=1236189279823899&autoLogAppEvents=1";
									    fjs.parentNode.insertBefore(js, fjs);
									 }(document, 'script', 'facebook-jssdk'));</script>

									<!-- Your share button code -->
									<div class="fb-share-button" data-href="{{ url()->current() }}" data-layout="button_count"></div>
								</div>
							</div>
							<div class="col-md-12 mt-10">
								@if(Auth::user() == $post->user)
									<div class="form-group text-center">										
										<div class="form-group col-md-3">
											<a href="#" class="info text-primary" data-toggle="modal" data-target="#modalPhotos">Add more photos</a>
										</div>											
									</div>
								@endif
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Row -->

	<!-- Modal Photos-->
	<div id="modalPhotos" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Add more photos</h4>
	      </div>
	      <div class="modal-body">
	        <form action="{{ route('post.image-update') }}" method="post"  enctype="multipart/form-data">
	        	<div class="form-group">
					{{-- <input name="image" id="input-id" type="file" class="file" data-preview-file-type="text"> --}}
					<input name="images[]" id="input-id" type="file" class="file" style="width: 40px;" data-preview-file-type="text" multiple>
				</div>
				<input type="post_id" name="post_id" hidden value="{{ $post->id }}">
				<div class="form-group">
					<button type="submit" class="btn btn-primary hidden" onclick="this.disabled=true;this.form.submit();">Save Image</button>
				</div>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Row -->
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default card-view">
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
						<div  class="tab-struct custom-tab-1 product-desc-tab">
							<ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_7">
								<li class="active" role="presentation"><a aria-expanded="true"  data-toggle="tab" role="tab" id="descri_tab" href="#descri_tab_detail"><span>Description</span></a></li>
								<li role="presentation" class=""><a  data-toggle="tab" id="review_tab" role="tab" href="#review_tab_detail" aria-expanded="false"><span>Review<span class="inline-block">(<span class="review-count">0</span>)</span></span></a></li>
							</ul>
							<div class="tab-content" id="myTabContent_7">
								<div  id="descri_tab_detail" class="tab-pane fade active in pt-0" role="tabpanel">
									<!-- <p class="pt-15" id="body">{!! nl2br(e($post->body)) !!}</p> -->
									<p class="pt-15" id="body">{{ $post->body }}</p>
								</div>							
								<div  id="review_tab_detail" class="tab-pane pt-0 fade" role="tabpanel">
									<p class="muted review-tag pt-15">No reviews yet.</p>
									<div class="row mt-40">
										<div class="col-sm-6">
											<div class="form-wrap">
												<form>
													<div class="form-group">
														<label class="control-label mb-10" for="review">Your rating</label>
														<div class='product-rating starrr' id='star1'></div>
													</div>
													<div class="form-group">
														<label class="control-label mb-10" for="review">Your review</label>
														<textarea class="form-control" id="review" placeholder="add review"></textarea>
													</div>
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<label class="control-label mb-10" for="exampleInputuname_2">User Name</label>
																<input type="text" class="form-control" id="exampleInputuname_2" placeholder="Username"/>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
																<label class="control-label mb-10" for="exampleInputEmail_2">Email address</label>
																<input type="email" class="form-control" id="exampleInputEmail_2" placeholder="Enter email">
															</div>
														</div>
													</div>

													<div class="form-group mb-0">
														<button type="submit" class="btn btn-success  mr-10">Submit</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Row -->
</div>
<!-- Edit Modal -->
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
@endsection()

@section('script')		
	<!-- JavaScript -->

	<!-- jQuery -->
	<script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

	<!-- Form Wizard JavaScript -->
	<script src="vendors/bower_components/jquery.steps/build/jquery.steps.min.js"></script>

	<!-- Bootstrap Touchspin JavaScript -->
	<script src="vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>

	<!-- Starrr JavaScript -->
	<script src="dist/js/starrr.js"></script>

	<!-- Product Detail Data JavaScript -->
	<script src="dist/js/product-detail-data.js"></script>

	<!-- Slimscroll JavaScript -->
	<script src="dist/js/jquery.slimscroll.js"></script>

	<!-- Owl JavaScript -->
	<script src="vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>

	<!-- Switchery JavaScript -->
	<script src="vendors/bower_components/switchery/dist/switchery.min.js"></script>

	<!-- Fancy Dropdown JS -->
	<script src="dist/js/dropdown-bootstrap-extended.js"></script>

	<!-- Init JavaScript -->
	<script src="dist/js/init.js"></script>
	<script type="text/javascript" src="{{ URL::to('js/main.js')}}"></script>

	<!-- File Upload -->
	<script src="{{ URL::to('plugins/file-upload/js/plugins/piexif.min.js')}}" type="text/javascript"></script>
	<script src="{{ URL::to('plugins/file-upload/js/plugins/sortable.min.js')}}" type="text/javascript"></script>
	<script src="{{ URL::to('plugins/file-upload/js/plugins/purify.min.js')}}" type="text/javascript"></script>
	<script src="{{ URL::to('plugins/file-upload/js/fileinput.min.js')}}" type="text/javascript"></script>

	<!-- Post Javascript -->
	<script type="text/javascript">
		var token = '{{ Session::token() }}';
		var urlEdit = '{{ route('edit') }}';
		var urlLike = '{{ route('like') }}';
	</script>
	<script type="text/javascript" src="{{ URL::to('js/anchorme.js')}}"></script>
	<script type="text/javascript">
		var innerHTML = document.getElementById('body').innerHTML;
		var result = anchorme(innerHTML,{
			attributes:[
			{
				name:"target",
				value:"_blank"
			}
			]
		});
		document.getElementById('body').innerHTML = result;
	</script>
	<script>
	$(document).on('ready', function() {
	    $("#input-id").fileinput({showCaption: false});
	});
	</script>

	<script type="text/javascript">
    $('.sendMessagePost').on('click', function(e) {
        e.preventDefault();
        var messageLink = $(this).attr('href');
        var embedMessage = document.getElementById("getTopMessage");
        var clone = embedMessage.cloneNode(true);
        clone.setAttribute('src', messageLink);
        embedMessage.parentNode.replaceChild(clone, embedMessage);
        $("#sendMessageModal").modal()
    });
	</script>
	
	@include('includes.register-first')
	@include('includes.message-block')
	@include('includes.places-autocomplete')
@endsection()