@extends('layouts.main')

@section('title')
{{ $post->title }}
@endsection

@section('css')
	<!-- jquery-steps css -->
	<link rel="stylesheet" href="vendors/bower_components/jquery.steps/demo/css/jquery.steps.css">

	<!-- bootstrap-touchspin CSS -->
	<link href="vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css"/>

	<!-- Custom CSS -->
	<link href="dist/css/style.css" rel="stylesheet" type="text/css">

	<!-- File Upload CSS -->
	<link href="{{ URL::to('plugins/file-upload/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css" />
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
				<li><a href="index.html">Dashboard</a></li>
				<li><a href="#"><span>e-commerce</span></a></li>
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
											<li data-target="#carousel-example-captions-1" data-slide-to="0" class="active"></li>
											<li data-target="#carousel-example-captions-1" data-slide-to="1"></li>
										</ol>
										<div role="listbox" class="carousel-inner">
											<div class="item active"> <img src="{{ route('post.image', ['filename' => $post->image_name]) }}" alt="First slide image"> </div>
											<div class="item"> <img src="dist/img/gallery/mock4.jpg" alt="Second slide image"> </div>
										</div>
									</div>
									<!-- END carousel-->
									@if(Auth::user() == $post->user)
									<div class="form-group text-center">
										<form action="{{ route('post.image-update') }}" method="post"  enctype="multipart/form-data">
											<div class="form-group">
												<label for="input-id" class="info">Change photo (must be a valid image file)</label>
											</div>
											<div class="form-group">
												<input name="image" id="input-id" type="file" class="file" data-preview-file-type="text">
											</div>
											<input type="post_id" name="post_id" hidden value="{{ $post->id }}">
											<div class="form-group">
												<button type="submit" class="btn btn-primary hidden" onclick="this.disabled=true;this.form.submit();">Save Image</button>
											</div>
											<input type="hidden" name="_token" value="{{ Session::token() }}">
										</form>
									</div>
									@endif
								</div>
							</div>

							<div class="col-md-9">
								<div class="product-detail-wrap post" data-postid="{{ $post->id }}">
									<div class="product-rating inline-block mb-10">
										<a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star-outline"></a>
									</div>
									<div class="average-review inline-block mb-10">&nbsp;(<span class="review-count">5</span> customer review)</div>
									<h3 class="mb-20 weight-500">{{ $post->title }}</h3>
									{{-- <div class="product-price head-font mb-30">$ 1234</div> --}}
									<div class="mb-20 info">Posted by <a href="{{ route('account.profile', ['id' => $post->user->id]) }}">{{ $post->user->first_name }} {{ $post->user->last_name }}</a> on {{ $post->created_at->diffForHumans() }}﻿</div>

									<div class="mb-20" id="details">
										<p><strong>Description: </strong><br/><span id="body">{!! nl2br(e($post->body)) !!}</span></p>
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
									<div class="btn-group wishlist mb-20">
										<button class="btn btn-warning btn-outline btn-anim"><i class="icon-heart"></i><span class="btn-text">add to wishlist</span></button>
									</div>
									@endif()
									<p class="text-muted">{{ $post->view_count }} views</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Row -->

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
									<p class="pt-15">Activist, criteria planned giving dignity, committed democratizing the global financial system progressive. Nelson Mandela equal opportunity change accelerate pathway to a better life invest our ambitions catalyst. Making progress contribution compassion Ford Foundation, cross-agency coordination Bill and Melinda Gates development. Overcome injustice tackling activism, promising development equality hack meaningful working families. Foundation; open source; organization volunteer, replicable think tank carbon emissions reductions.</p>
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

	@include('includes.message-block')
	@include('includes.places-autocomplete')
@endsection()