@extends('layouts.main')

@section('meta')
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="Libot Philippines {{ $user->first_name }} Profile" />
    <meta name="keywords" content="libot, libot philippines, travel, libot travel, rent, {{ $user->first_name }} profile, profile" />
    <meta name="author" content="libot-ph"/>
@endsection()

@section('title')
{{ $user->first_name }}
@endsection

@section('css')
<!-- Morris Charts CSS -->
<link href="vendors/bower_components/morris.js/morris.css" rel="stylesheet" type="text/css"/>

<!-- vector map CSS -->
<link href="vendors/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" type="text/css"/>

<!-- Calendar CSS -->
<link href="vendors/bower_components/fullcalendar/dist/fullcalendar.css" rel="stylesheet" type="text/css"/>

<!-- Data table CSS -->
<link href="vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>

<!-- Custom CSS -->
<link href="dist/css/style.css" rel="stylesheet" type="text/css">

<link href="vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">

<!-- Bootstrap Dropify CSS -->
<link href="vendors/bower_components/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css"/>
@endsection()

@section('content')    
<div class="container-fluid pt-25">

    <!-- Row -->
    <div class="row">
        <div class="col-lg-3 col-xs-12">
            <div class="panel panel-default card-view  pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body  pa-0">
                        <div class="profile-box">
                            <div class="profile-cover-pic">
                                @if(Auth::user() && Auth::user()->id == $user->id)
                                <div class="fileupload btn btn-default hidden">
                                    <span class="btn-text">edit</span>
                                    <input class="upload" type="file">
                                </div>
                                @endif
                                <div class="profile-image-overlay"></div>
                            </div>
                            <div class="profile-info text-center">
                                <div class="profile-img-wrap">
                                    <img class="inline-block mb-10" src="{{ route('account.image', ['filename' => $user->profile_picture_path]) }}" alt="user"/>
                                    @if(Auth::user() && Auth::user()->id == $user->id)
                                    <div class="fileupload btn btn-default">
                                        <span class="btn-text">edit</span>
                                        {{-- <a href="#" data-toggle="modal" data-target="#modalProfPic"></a> --}}
                                        <input class="upload" data-toggle="modal" data-target="#modalProfPic">
                                    </div>
                                    @endif()
                                </div>  
                                <h5 class="block mt-10 mb-5 weight-500 capitalize-font txt-danger">{{ $user->first_name }} {{ $user->last_name }}</h5>
                                <span class="counts-text block">{{ $user->mobile_no }}</span>
                                <span class="counts-text block mb-10">{{ $user->email }}</span>
                            </div>
                            <!-- Profile Pic Modal -->
                            <div id="modalProfPic" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h5 class="modal-title" id="myModalLabel">Edit Profile Picture</h5>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Row -->
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="">
                                                        <div class="panel-wrapper collapse in">
                                                            <div class="panel-body pa-0">
                                                                <div class="col-sm-12 col-xs-12">
                                                                    <div class="form-wrap">
                                                                        <form action="{{ route('account.post-image') }}" method="post" enctype="multipart/form-data">
                                                                            <div class="form-body overflow-hide">
                                                                                <div class="form-group">
                                                                                    <label class="control-label mb-10" for="first_name">Choose your photo</label>

                                                                                    <input name="image" id="input-id" type="file" class="dropify" data-preview-file-type="text">

                                                                                </div>                                                    
                                                                            </div>
                                                                            <div class="form-actions mt-10">
                                                                                <input type="hidden" value="{{ Session::token() }}" name="_token">
                                                                                <button type="submit" class="btn btn-success mr-10 mb-30" onclick="this.disabled=true;this.form.submit();">Save</button>
                                                                                <button type="button" class="btn btn-default mr-10 mb-30" data-dismiss="modal">Cancel</button>
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
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>  
                            <div class="social-info">
                                <div class="row">
                                    <div class="col-xs-4 text-center txt-primary">
                                        <a href="{{ route('user-post', ['user_id' => $user->id]) }}">
                                            <span class="counts block head-font"><span class="counter-anim txt-primary">{{count($posts)}}</span></span>
                                            <span class="counts-text block">post</span>
                                        </a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <span class="counts block head-font"><span class="counter-anim">0</span></span>
                                        <span class="counts-text block">followers</span>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="{{ route('itinerary', ['user_id' => $user->id]) }}">
                                            <span class="counts block head-font"><span class="counter-anim text-primary">{{ count($user->itinerary()->get()) }}</span></span>
                                            <span class="counts-text block">Itinerary</span>
                                        </a>
                                    </div>
                                </div>
                                @if(Auth::user() && Auth::user()->id != $user->id)
                                <button class="btn btn-default btn-block btn-outline btn-anim mt-30" data-toggle="modal" data-target="#"><i class="fa fa-plus"></i><span class="btn-text">Follow</span></button>
                                <a class="btn btn-default btn-block btn-outline btn-anim mt-30" href="{{ route('get.message', ['user_id' => $user->id]) }}" id="btnSendMessage"><i class="fa fa-inbox"></i><span class="btn-text">Send Message</span></a>
                                @endif()
                                @if(!Auth::user())
                                <a class="btn btn-default btn-block btn-outline btn-anim mt-30" href="#" data-toggle="modal" data-target="#register-first"><i class="fa fa-inbox"></i><span class="btn-text" title="Please register to send a message.">Send Message</span></a>
                                @endif()                                
                                @if(Auth::user() && Auth::user()->id == $user->id)
                                <button class="btn btn-default btn-block btn-outline btn-anim mt-30" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i><span class="btn-text">edit profile</span></button>
                                <div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h5 class="modal-title" id="myModalLabel">Edit Profile</h5>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Row -->
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="">
                                                            <div class="panel-wrapper collapse in">
                                                                <div class="panel-body pa-0">
                                                                    <div class="col-sm-12 col-xs-12">
                                                                        <div class="form-wrap">
                                                                            <form action="{{ route('account.save') }}" method="post">
                                                                                <div class="form-body overflow-hide">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label mb-10" for="first_name">First Name</label>
                                                                                        <div class="input-group">
                                                                                            <div class="input-group-addon"><i class="icon-user"></i></div>
                                                                                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="" value="{{ $user->first_name }}">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label class="control-label mb-10" for="last_name">Last Name</label>
                                                                                        <div class="input-group">
                                                                                            <div class="input-group-addon"><i class="icon-user"></i></div>
                                                                                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="" value="{{ $user->last_name }}">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label class="control-label mb-10" for="email">Email address</label>
                                                                                        <div class="input-group">
                                                                                            <div class="input-group-addon"><i class="icon-envelope-open"></i></div>
                                                                                            <input type="email" class="form-control" id="email" name="email" placeholder="xyz@gmail.com" value="{{ $user->email }}">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label class="control-label mb-10" for="mobile_no">Contact number</label>
                                                                                        <div class="input-group">
                                                                                            <div class="input-group-addon"><i class="icon-phone"></i></div>
                                                                                            <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="09051234567" value="{{ $user->mobile_no }}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-actions mt-10">
                                                                                    <input type="hidden" value="{{ Session::token() }}" name="_token">
                                                                                    <button type="submit" class="btn btn-success mr-10 mb-30">Update profile</button>
                                                                                    <button type="button" class="btn btn-default mr-10 mb-30" data-dismiss="modal">Cancel</button>
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
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                @endif()
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div  class="panel-body pb-0">
                        <div  class="tab-struct custom-tab-1">
                            <ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
                                <li class="active" role="presentation"><a  data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false"><span>profile</span></a></li>
                                <li  role="presentation" class="next hidden"><a aria-expanded="true"  data-toggle="tab" role="tab" id="follo_tab_8" href="#follo_8"><span>followers<span class="inline-block">(246)</span></span></a></li>
                                <li role="presentation" class="hidden"><a  data-toggle="tab" id="photos_tab_8" role="tab" href="#photos_8" aria-expanded="false"><span>photos</span></a></li>                                
                            </ul>
                            <div class="tab-content" id="myTabContent_8">
                                <div  id="profile_8" class="tab-pane fade active in" role="tabpanel">
                                    <div class="col-md-12">
                                        <div class="pt-20">
                                            <div class="streamline user-activity">
                                                <div class="col-md-12">
                                                    <h4>Reviews</h4>
                                                    @if(count($reviews) > 0)
                                                    <div class="col-md-12">
                                                        <h4><strong><em>{{ $rating }}</em></strong> <span class="glyphicon glyphicon-star" style="color: #ee8b2d;"></span></h4>
                                                    </div>
                                                    <div class="col-md-12"> <p class="info">There are <strong>{{ $reviews->total() }}</strong> reviews for this user. </p></div>
                                                    @foreach($reviews as $review)
                                                    <div class="form-group div_hover col-md-12" title="View user profile">
                                                        <div class="col-md-12">
                                                            <a href="{{ route('account.profile', ['$id' => $review->user->id]) }}" class="text-primary"><h5>
                                                                <strong>{{ $review->user->first_name }} {{ $review->user->last_name }}</strong></h5>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-12">                                                            
                                                            <p>
                                                                <span class="pr-5">{{ $review->rating }}</span><span class="glyphicon glyphicon-star" style="color: #ee8b2d;"></span>
                                                                @if(Auth::user() == $review->user)
                                                                <a href="{{ route('review.delete', ['review_id' => $review->id]) }}" title="Delete review" onclick="return confirm('Are you sure?')"><span class="info small txt-danger">Delete review</span></a>
                                                                @endif()
                                                            </p>
                                                            <p><em>{{ $review->comment }}</em></p>
                                                            <p class="small">{{ $review->created_at->diffForHumans() }}</p>
                                                        </div>

                                                    </div>
                                                    @endforeach
                                                    @endif
                                                    @if(count($reviews) == 0)
                                                    <div class="col-md-12">
                                                        <p><em>There is no feedback for this user.</em></p>
                                                    </div>
                                                    @endif
                                                    <div class="col-md-4 mt-0 pb-10">
                                                        @if(Auth::user() && Auth::user()->id != $user->id)
                                                        <a href="{{ route('account.review', ['user_id' => $user->id]) }}" class="text-primary" ">Write/View all reviews</a>
                                                        @endif()

                                                        @if(Auth::user() && Auth::user()->id == $user->id)
                                                        <a href="{{ route('account.review', ['user_id' => $user->id]) }}" class="text-primary" ">View all your reviews</a>
                                                        @endif()

                                                        @if(!Auth::user())
                                                            <a href="{{ route('account.review', ['user_id' => $user->id]) }}" class="text-primary" ">View all reviews</a>
                                                        @endif()
                                                        {{-- <a class="btn btn-default btn-block btn-outline btn-anim mt-30" href="{{ route('account.review', ['user_id' => $user->id]) }}"><i class="fa fa-book"></i><span class="btn-text">Reviews ({{ count($reviews)  }})</span></a> --}}
                                                    </div>                                                    
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div  id="follo_8" class="tab-pane fade" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="followers-wrap">
                                                <ul class="followers-list-wrap">
                                                    <li class="follow-list">
                                                        <div class="follo-body">
                                                            <div class="follo-data">
                                                                <img class="user-img img-circle"  src="dist/img/user.png" alt="user"/>
                                                                <div class="user-data">
                                                                    <span class="name block capitalize-font">Maan Dyosa</span>
                                                                    <span class="time block truncate txt-grey">No one saves us but ourselves.</span>
                                                                </div>
                                                                <button class="btn btn-success pull-right btn-xs fixed-btn">Follow</button>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="follo-data">
                                                                <img class="user-img img-circle"  src="dist/img/user1.png" alt="user"/>
                                                                <div class="user-data">
                                                                    <span class="name block capitalize-font">Superman</span>
                                                                    <span class="time block truncate txt-grey">Unity is strength</span>
                                                                </div>
                                                                <button class="btn btn-success btn-outline pull-right btn-xs fixed-btn">following</button>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="follo-data">
                                                                <img class="user-img img-circle"  src="dist/img/user2.png" alt="user"/>
                                                                <div class="user-data">
                                                                    <span class="name block capitalize-font">{{ $user->first_name }} {{ $user->last_name }}</span>
                                                                    <span class="time block truncate txt-grey">Respect yourself if you would have others respect you.</span>
                                                                </div>
                                                                <button class="btn btn-success btn-outline pull-right btn-xs fixed-btn">following</button>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="follo-data">
                                                                <img class="user-img img-circle"  src="dist/img/user3.png" alt="user"/>
                                                                <div class="user-data">
                                                                    <span class="name block capitalize-font">Batman</span>
                                                                    <span class="time block truncate txt-grey">I’m thankful.</span>
                                                                </div>
                                                                <button class="btn btn-success pull-right btn-xs fixed-btn">Follow</button>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="follo-data">
                                                                <img class="user-img img-circle"  src="dist/img/user.png" alt="user"/>
                                                                <div class="user-data">
                                                                    <span class="name block capitalize-font">Spiderman</span>
                                                                    <span class="time block truncate txt-grey">Patience is bitter.</span>
                                                                </div>
                                                                <button class="btn btn-success pull-right btn-xs fixed-btn">Follow</button>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="follo-data">
                                                                <img class="user-img img-circle"  src="dist/img/user1.png" alt="user"/>
                                                                <div class="user-data">
                                                                    <span class="name block capitalize-font">Captain America</span>
                                                                    <span class="time block truncate txt-grey">Genius is eternal patience.</span>
                                                                </div>
                                                                <button class="btn btn-success btn-outline pull-right btn-xs fixed-btn">following</button>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div  id="photos_8" class="tab-pane fade" role="tabpanel">
                                    <div class="col-md-12 pb-20">
                                        <div class="gallery-wrap">
                                            <div class="portfolio-wrap project-gallery">
                                                <ul id="portfolio_1" class="portf auto-construct  project-gallery" data-col="4">
                                                    <li  class="item"   data-src="dist/img/gallery/equal-size/mock1.jpg" data-sub-html="<h6>Bagwati</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>" >
                                                        <a href="">
                                                            <img class="img-responsive" src="dist/img/gallery/equal-size/mock1.jpg"  alt="Image description" />
                                                            <span class="hover-cap">Bagwati</span>
                                                        </a>
                                                    </li>
                                                    <li class="item" data-src="dist/img/gallery/equal-size/mock2.jpg"   data-sub-html="<h6>Not a Keyboard</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
                                                        <a href="">
                                                            <img class="img-responsive" src="dist/img/gallery/equal-size/mock2.jpg"  alt="Image description" />
                                                            <span class="hover-cap">Not a Keyboard</span>
                                                        </a>
                                                    </li>
                                                    <li class="item" data-src="dist/img/gallery/equal-size/mock3.jpg" data-sub-html="<h6>Into the Woods</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
                                                        <a href="">
                                                            <img class="img-responsive" src="dist/img/gallery/equal-size/mock3.jpg"  alt="Image description" />
                                                            <span class="hover-cap">Into the Woods</span>
                                                        </a>
                                                    </li>
                                                    <li class="item" data-src="dist/img/gallery/equal-size/mock4.jpg"  data-sub-html="<h6>Ultra Saffire</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
                                                        <a href="">
                                                            <img class="img-responsive" src="dist/img/gallery/equal-size/mock4.jpg"  alt="Image description" />
                                                            <span class="hover-cap"> Ultra Saffire</span>
                                                        </a>
                                                    </li>

                                                    <li class="item" data-src="dist/img/gallery/equal-size/mock5.jpg" data-sub-html="<h6>Happy Puppy</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
                                                        <a href="">
                                                            <img class="img-responsive" src="dist/img/gallery/equal-size/mock5.jpg"  alt="Image description" /> 
                                                            <span class="hover-cap">Happy Puppy</span>
                                                        </a>
                                                    </li>
                                                    <li class="item" data-src="dist/img/gallery/equal-size/mock6.jpg"  data-sub-html="<h6>Wooden Closet</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
                                                        <a href="">
                                                            <img class="img-responsive" src="dist/img/gallery/equal-size/mock6.jpg"  alt="Image description" />
                                                            <span class="hover-cap">Wooden Closet</span>
                                                        </a>
                                                    </li>
                                                    <li class="item" data-src="dist/img/gallery/equal-size/mock7.jpg" data-sub-html="<h6>Happy Puppy</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
                                                        <a href="">
                                                            <img class="img-responsive" src="dist/img/gallery/equal-size/mock7.jpg"  alt="Image description" /> 
                                                            <span class="hover-cap">Happy Puppy</span>
                                                        </a>
                                                    </li>
                                                    <li class="item" data-src="dist/img/gallery/equal-size/mock8.jpg"  data-sub-html="<h6>Wooden Closet</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
                                                        <a href="">
                                                            <img class="img-responsive" src="dist/img/gallery/equal-size/mock8.jpg"  alt="Image description" />
                                                            <span class="hover-cap">Wooden Closet</span>
                                                        </a>
                                                    </li>
                                                </ul>
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

    <!-- Row -->
    <div class="row hidden">
        @if(Auth::user() && Auth::user()->id == $user->id)
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default border-panel card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title pull-left">users</h6>
                    </div>
                    <div class="pull-right">
                        <a href="#" class="pull-left inline-block mr-15">
                            <i class="zmdi zmdi-search"></i>
                        </a>
                        <a class="pull-left inline-block" href="#" data-effect="fadeOut">
                            <i class="zmdi zmdi-plus"></i>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body row pa-0">
                        <div class="chat-cmplt-wrap chat-for-widgets">
                            <div class="chat-box-wrap">
                                <div>
                                    <div class="users-nicescroll-bar">
                                        <ul class="chat-list-wrap">
                                            <li class="chat-list">
                                                <div class="chat-body">
                                                    <a  href="javascript:void(0)">
                                                        <div class="chat-data">
                                                            <img class="user-img img-circle"  src="dist/img/user.png" alt="user"/>
                                                            <div class="user-data">
                                                                <span class="name block capitalize-font">Clay Masse</span>
                                                                <span class="time block truncate txt-grey">No one saves us but ourselves.</span>
                                                            </div>
                                                            <div class="status away"></div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                    <a  href="javascript:void(0)">
                                                        <div class="chat-data">
                                                            <img class="user-img img-circle"  src="dist/img/user1.png" alt="user"/>
                                                            <div class="user-data">
                                                                <span class="name block capitalize-font">Evie Ono</span>
                                                                <span class="time block truncate txt-grey">Unity is strength</span>
                                                            </div>
                                                            <div class="status offline"></div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                    <a  href="javascript:void(0)">
                                                        <div class="chat-data">
                                                            <img class="user-img img-circle"  src="dist/img/user2.png" alt="user"/>
                                                            <div class="user-data">
                                                                <span class="name block capitalize-font">{{ $user->first_name }} {{ $user->last_name }}</span>
                                                                <span class="time block truncate txt-grey">Respect yourself if you would have others respect you.</span>
                                                            </div>
                                                            <div class="status online"></div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                    <a  href="javascript:void(0)">
                                                        <div class="chat-data">
                                                            <img class="user-img img-circle"  src="dist/img/user3.png" alt="user"/>
                                                            <div class="user-data">
                                                                <span class="name block capitalize-font">Mitsuko Heid</span>
                                                                <span class="time block truncate txt-grey">I’m thankful.</span>
                                                            </div>
                                                            <div class="status online"></div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                    <a  href="javascript:void(0)">
                                                        <div class="chat-data">
                                                            <img class="user-img img-circle"  src="dist/img/user.png" alt="user"/>
                                                            <div class="user-data">
                                                                <span class="name block capitalize-font">Ezequiel Merideth</span>
                                                                <span class="time block truncate txt-grey">Patience is bitter.</span>
                                                            </div>
                                                            <div class="status offline"></div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                    <a  href="javascript:void(0)">
                                                        <div class="chat-data">
                                                            <img class="user-img img-circle"  src="dist/img/user1.png" alt="user"/>
                                                            <div class="user-data">
                                                                <span class="name block capitalize-font">Jonnie Metoyer</span>
                                                                <span class="time block truncate txt-grey">Genius is eternal patience.</span>
                                                            </div>
                                                            <div class="status online"></div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                    <a  href="javascript:void(0)">
                                                        <div class="chat-data">
                                                            <img class="user-img img-circle"  src="dist/img/user2.png" alt="user"/>
                                                            <div class="user-data">
                                                                <span class="name block capitalize-font">Angelic Lauver</span>
                                                                <span class="time block truncate txt-grey">Every burden is a blessing.</span>
                                                            </div>
                                                            <div class="status away"></div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                    <a  href="javascript:void(0)">
                                                        <div class="chat-data">
                                                            <img class="user-img img-circle"  src="dist/img/user3.png" alt="user"/>
                                                            <div class="user-data">
                                                                <span class="name block capitalize-font">Priscila Shy</span>
                                                                <span class="time block truncate txt-grey">Wise to resolve, and patient to perform.</span>
                                                            </div>
                                                            <div class="status online"></div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                    <a  href="javascript:void(0)">
                                                        <div class="chat-data">
                                                            <img class="user-img img-circle"  src="dist/img/user4.png" alt="user"/>
                                                            <div class="user-data">
                                                                <span class="name block capitalize-font">Linda Stack</span>
                                                                <span class="time block truncate txt-grey">Our patience will achieve more than our force.</span>
                                                            </div>
                                                            <div class="status away"></div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="recent-chat-box-wrap">
                                <div class="recent-chat-wrap">
                                    <div class="panel-heading ma-0 pt-15">
                                        <div class="goto-back">
                                            <a  id="goto_back_widget" href="javascript:void(0)" class="inline-block txt-grey">
                                                <i class="zmdi zmdi-chevron-left"></i>
                                            </a>    
                                            <span class="inline-block txt-dark">ryan</span>
                                            <a href="javascript:void(0)" class="inline-block text-right txt-grey"><i class="zmdi zmdi-more"></i></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body pa-0">
                                            <div class="chat-content">
                                                <ul class="users-chat-nicescroll-bar pt-20">
                                                    <li class="friend">
                                                        <div class="friend-msg-wrap">
                                                            <img class="user-img img-circle block pull-left"  src="dist/img/user.png" alt="user"/>
                                                            <div class="msg pull-left">
                                                                <p>Hello Jason, how are you, it's been a long time since we last met?</p>
                                                                <div class="msg-per-detail text-right">
                                                                    <span class="msg-time txt-grey">2:30 PM</span>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>  
                                                    </li>
                                                    <li class="self mb-10">
                                                        <div class="self-msg-wrap">
                                                            <div class="msg block pull-right"> Oh, hi Sarah I'm have got a new job now and is going great.
                                                                <div class="msg-per-detail text-right">
                                                                    <span class="msg-time txt-grey">2:31 pm</span>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>  
                                                    </li>
                                                    <li class="self">
                                                        <div class="self-msg-wrap">
                                                            <div class="msg block pull-right">  How about you?
                                                                <div class="msg-per-detail text-right">
                                                                    <span class="msg-time txt-grey">2:31 pm</span>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>  
                                                    </li>
                                                    <li class="friend">
                                                        <div class="friend-msg-wrap">
                                                            <img class="user-img img-circle block pull-left"  src="dist/img/user.png" alt="user"/>
                                                            <div class="msg pull-left"> 
                                                                <p>Not too bad.</p>
                                                                <div class="msg-per-detail  text-right">
                                                                    <span class="msg-time txt-grey">2:35 pm</span>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>  
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="input-group">
                                                <input type="text" id="input_msg_send_widget" name="send-msg" class="input-msg-send form-control" placeholder="Type something">
                                                <div class="input-group-btn emojis">
                                                    <div class="dropup">
                                                        <button type="button" class="btn  btn-default  dropdown-toggle" data-toggle="dropdown" ><i class="zmdi zmdi-mood"></i></button>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="javascript:void(0)">Action</a></li>
                                                            <li><a href="javascript:void(0)">Another action</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="javascript:void(0)">Separated link</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="input-group-btn attachment">
                                                    <div class="fileupload btn  btn-default"><i class="zmdi zmdi-attachment-alt"></i>
                                                        <input type="file" class="upload">
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
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default border-panel card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">todo</h6>
                    </div>
                    <div class="pull-right">
                        <div class="pull-left inline-block dropdown mr-15">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="zmdi zmdi-more-vert"></i></a>
                            <ul class="dropdown-menu bullet dropdown-menu-right"  role="menu">
                                <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i>Edit</a></li>
                                <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i>Clear All</a></li>
                                <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i>Select All</a></li>
                            </ul>
                        </div>
                        <a class="pull-left inline-block close-panel" href="#" data-effect="fadeOut">
                            <i class="zmdi zmdi-close"></i>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body row pa-0">
                        <div class="todo-box-wrap">
                            <!-- Todo-List -->
                            <ul class="todo-list todo-box-nicescroll-bar">
                                <li class="todo-item">
                                    <div class="checkbox checkbox-default">
                                        <input type="checkbox" id="checkbox001"/>
                                        <label for="checkbox001">Record The First Episode</label>
                                    </div>
                                </li>
                                <li>
                                    <hr class="light-grey-hr"/>
                                </li>
                                <li class="todo-item">
                                    <div class="checkbox checkbox-pink">
                                        <input type="checkbox" id="checkbox002"/>
                                        <label for="checkbox002">Prepare The Conference Schedule</label>
                                    </div>
                                </li>
                                <li>
                                    <hr class="light-grey-hr"/>
                                </li>
                                <li class="todo-item">
                                    <div class="checkbox checkbox-warning">
                                        <input type="checkbox" id="checkbox003" checked/>
                                        <label for="checkbox003">Decide The Live Discussion Time</label>
                                    </div>
                                </li>
                                <li>
                                    <hr class="light-grey-hr"/>
                                </li>
                                <li class="todo-item">
                                    <div class="checkbox checkbox-success">
                                        <input type="checkbox" id="checkbox004" checked/>
                                        <label for="checkbox004">Prepare For The Next Project</label>
                                    </div>
                                </li>
                                <li>
                                    <hr class="light-grey-hr"/>
                                </li>
                                <li class="todo-item">
                                    <div class="checkbox checkbox-danger">
                                        <input type="checkbox" id="checkbox005" checked/>
                                        <label for="checkbox005">Finish Up AngularJs Tutorial</label>
                                    </div>
                                </li>
                                <li>
                                    <hr class="light-grey-hr"/>
                                </li>
                                <li class="todo-item">
                                    <div class="checkbox checkbox-purple">
                                        <input type="checkbox" id="checkbox006" checked/>
                                        <label for="checkbox006">Finish Infinity Project</label>
                                    </div>
                                </li>
                                <li>
                                    <hr class="light-grey-hr"/>
                                </li>
                            </ul>
                            <!-- /Todo-List -->

                            <!-- New Todo -->
                            <div class="new-todo">
                                <div class="input-group">
                                    <input type="text" id="add_todo" name="example-input2-group2" class="form-control" placeholder="Add new task">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-success"><i class="zmdi zmdi-plus txt-success"></i></button>
                                    </span> 
                                </div>
                            </div>
                            <!-- /New Todo -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="calendar-wrap">
                          <div id="calendar_small" class="small-calendar"></div>
                      </div>
                  </div>
              </div>
          </div>  
      </div>
      @endif()
</div>
<!-- /Row -->

</div>
@endsection()

@section('script')
<!-- JavaScript -->

<!-- jQuery -->
<script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Vector Maps JavaScript -->
<script src="vendors/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="vendors/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="dist/js/vectormap-data.js"></script>

<!-- Calender JavaScripts -->
<script src="vendors/bower_components/moment/min/moment.min.js"></script>
<script src="vendors/jquery-ui.min.js"></script>
<script src="vendors/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="dist/js/fullcalendar-data.js"></script>

<!-- Counter Animation JavaScript -->
<script src="vendors/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="vendors/bower_components/jquery.counterup/jquery.counterup.min.js"></script>

<!-- Data table JavaScript -->
<script src="vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>

<!-- Slimscroll JavaScript -->
<script src="dist/js/jquery.slimscroll.js"></script>

<!-- Fancy Dropdown JS -->
<script src="dist/js/dropdown-bootstrap-extended.js"></script>

<!-- Sparkline JavaScript -->
<script src="vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script>

<script src="vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
<script src="dist/js/skills-counter-data.js"></script>

<!-- Morris Charts JavaScript -->
<script src="vendors/bower_components/raphael/raphael.min.js"></script>
<script src="vendors/bower_components/morris.js/morris.min.js"></script>
<script src="dist/js/morris-data.js"></script>

<!-- Owl JavaScript -->
<script src="vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>

<!-- Switchery JavaScript -->
<script src="vendors/bower_components/switchery/dist/switchery.min.js"></script>

<!-- Data table JavaScript -->
<script src="vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>

<!-- Gallery JavaScript -->
<script src="dist/js/isotope.js"></script>
<script src="dist/js/lightgallery-all.js"></script>
<script src="dist/js/froogaloop2.min.js"></script>
<script src="dist/js/gallery-data.js"></script>

<!-- Spectragram JavaScript -->
<script src="dist/js/spectragram.min.js"></script>

<!-- Init JavaScript -->
<script src="dist/js/init.js"></script>
<script src="dist/js/widgets-data.js"></script>

<!-- Form Flie Upload Data JavaScript -->
<script src="dist/js/form-file-upload-data.js"></script>

<!-- Bootstrap Daterangepicker JavaScript -->
<script src="vendors/bower_components/dropify/dist/js/dropify.min.js"></script>

@include('includes.message-block')
@include('includes.register-first')

<script type="text/javascript">
    $('#btnSendMessage').on('click', function(e) {
        e.preventDefault();
        var messageLink = $(this).attr('href');
        var embedMessage = document.getElementById("getTopMessage");
        var clone = embedMessage.cloneNode(true);
        clone.setAttribute('src', messageLink);
        embedMessage.parentNode.replaceChild(clone, embedMessage);
        $("#sendMessageModal").modal()
    });
</script>
@endsection()