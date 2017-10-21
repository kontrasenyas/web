@extends('layouts.main')

@section('title')
Libot Philippines
@endsection

@section('css')    
    <!-- Data table CSS -->
    <link href="vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>

    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">

    <!-- Post image style -->
    <link href="{{ URL::to('css/post.css')}}" media="all" rel="stylesheet" type="text/css" />
@endsection()

@section('content')
    <div class="container-fluid pt-25">                
        <!-- Row -->
        <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Search</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="col-md-6">
                            <h4>Where are you going?</h4>
                            <form action="{{ route('search') }}" method="get" >
                                <div class="col-md-12">
                                        <div class="">
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" placeholder="Search for Car/Services/Packages" name="query" autocomplete="off" value="{{ Request::query('query') }}">
                                                </div>                          
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" placeholder="Location" name="location" id="location" autocomplete="off" value="{{ Request::query('location') }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" placeholder="Keywords" name="keywords" autocomplete="off" value="{{ Request::query('keywords') }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">                         
                                                    <button class="btn btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">Search!</button>
                                                    <input type="hidden" name="_token" value="{{ Session::token() }}">                          
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <section class="row posts">
                                <div class="col-md-12">
                                    @if(count($posts) < 1)
                                        <div class="col-md-6">
                                            No results!
                                        </div>
                                    @endif
                                    @if(count($posts) > 0)
                                        <div class="col-md-12"> <p class="info"> {{ $posts->total() }} result/s </p></div>
                                        <div class="col-md-12">
                                            @foreach($posts as $post)
                                                <p><strong>{{ $post->user->first_name }} {{ $post->user->last_name }}</strong>
                                                @if((Auth::user() && (Auth::user()->id != $post->user->id) ))
                                                    <a href="{{ route('get.message-post', ['user_id' => $post->user->id, 'post_id' => $post->id]) }}"><span class="glyphicon glyphicon-envelope text-primary" title="Send message to this user."></span></a>
                                                @endif
                                                @if(!Auth::user())
                                                <a href="#" data-toggle="modal" data-target="#register-first"><span class="glyphicon glyphicon-envelope text-primary" title="Please register to send a message."></span></a>
                                                @endif
                                                </p>
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
                                                                    <span class="text-muted">{{ $post->view_count }} views</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <img src="{{ route('post.image', ['filename' => $post->image_name]) }}" alt=""
                                                                class="img-responsive center-block img-preview">
                                                            </div>                
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                        <div class="col-md-12 text-center">
                                            {{ $posts->appends(Request::except('page'))->links() }}
                                        </div>
                                    @endif
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection()

@section('script')  
    <!-- JavaScript -->

    <!-- jQuery -->
    <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Data table JavaScript -->
    <script src="vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/dataTables-data.js"></script>

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

    @include('includes.places-autocomplete')
    @include('includes.message-block')
    @include('includes.register-first')
@endsection()

