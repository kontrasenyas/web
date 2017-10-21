@extends('layouts.main')

@section('title')
    @if(count($posts) > 0)
        @if(Auth::user() && Auth::user()->id == $user->id)
            My Posts
        @endif
        @if(!Auth::user() || Auth::user()->id != $user->id)
            {{ $user->first_name }}'s Posts
        @endif
    @endif
@endsection

@section('css')
    <!-- Morris Charts CSS -->
    <link href="vendors/bower_components/morris.js/morris.css" rel="stylesheet" type="text/css"/>
    
    <!-- Data table CSS -->
    <link href="vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    
    <link href="vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
    
    <!-- bootstrap-select CSS -->
    <link href="vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/> 
    
    <!-- Bootstrap Switches CSS -->
    <link href="vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
        
    <!-- switchery CSS -->
    <link href="vendors/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" type="text/css"/>
    
    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
@endsection()

@section('content')  
            <div class="container-fluid pt-25">                
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-default card-view">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark">
                                        @if(count($posts) > 0)
                                            @if(Auth::user() && Auth::user()->id == $user->id)
                                                My Posts
                                            @endif
                                            @if(!Auth::user() || Auth::user()->id != $user->id)
                                                {{ $user->first_name }}'s Posts
                                            @endif
                                        @endif
                                    </h6>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    @if(count($posts) == 0)
                                        @if(!Auth::user() || Auth::user()->id != $user->id)
                                            <h4>This user doesn't have any post at the moment</h4>
                                        @endif
                                        @if(Auth::user() && Auth::user()->id == $user->id)
                                            <h4>You don't have any post at the moment</h4>
                                            <p><a href="{{ route('dashboard') }}"> Click here to create your first post. </a></p>
                                        @endif
                                    @endif

                                    @foreach($posts as $post)
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" data-postid="{{ $post->id }}"> 
                                        <div class="panel panel-primary contact-card card-view" id="div-post">
                                            <div class="panel-heading">
                                                <div class="pull-left">
                                                    <div class="pull-left user-img-wrap mr-15">
                                                        <img class="card-user-img img-circle pull-left" src="{{ route('post.image', ['filename' => $post->image_name]) }}" alt="user"/>
                                                    </div>
                                                    <div class="pull-left user-detail-wrap">    
                                                        <span class="block card-user-name">
                                                            {{ $post->title }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body row">
                                                    <div class="user-others-details pl-15 pr-15">
                                                        {{-- <span class="block card-user-desn">Details</span> --}}
                                                        <div class="mb-15">
                                                            <i class="zmdi inline-block mr-10">Location:</i>
                                                            <span class="inline-block txt-dark">{{ str_limit($post->location, $limit = 22, $end = '...') }}</span>
                                                        </div>                        
                                                        <div class="mb-15">
                                                            <i class="zmdi inline-block mr-10">Contact No.:</i>
                                                            <span class="inline-block txt-dark">{{ $post->user->mobile_no }}</span>
                                                        </div>
                                                        <div class="mb-15">
                                                            <i class="zmdi inline-block mr-10">Description:</i>
                                                            <span class="inline-block txt-dark">{{ str_limit($post->body, $limit = 15, $end = '...') }}</span>
                                                        </div>
                                                    </div>
                                                    <hr class="light-grey-hr mt-20 mb-20"/>
                                                    <div class="emp-detail pl-15 pr-15">                        
                                                        <div>
                                                            <span class="inline-block capitalize-font mr-5">posted by:</span>
                                                            <span class="txt-dark">{{ $post->user->first_name }} {{ $post->created_at->diffForHumans() }}</span>
                                                        </div>
                                                        <div class="mb-5">
                                                            <span class="inline-block capitalize-font mr-5">{{ $post->view_count }} views</span>
                                                        </div>
                                                    </div>                        
                                                </div>
                                            </div>
                                            <a href="{{ route('post.get', ['post_id' => $post->id]) }}"><span class="link-spanner"></span></a>
                                             {{-- <div class="interaction">
                                                <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a> |
                                                <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'  }}</a>

                                                @if(Auth::user() == $post->user)
                                                |
                                                <a href="#" class="edit">Edit</a> |
                                                <a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a> |
                                                @endif

                                            </div> --}}
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="col-md-12 text-center">
                                        {{ $posts->appends(Request::except('page'))->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                                            
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
    
    <!-- Data table JavaScript -->
    <script src="vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    
    <!-- Slimscroll JavaScript -->
    <script src="dist/js/jquery.slimscroll.js"></script>
    
    <!-- Fancy Dropdown JS -->
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>
    
    <!-- Sparkline JavaScript -->
    <script src="vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script>
    
    <!-- Switchery JavaScript -->
    <script src="vendors/bower_components/switchery/dist/switchery.min.js"></script>
    
    <!-- Bootstrap Select JavaScript -->
    <script src="vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    
    <!-- Init JavaScript -->
    <script src="dist/js/init.js"></script>

    @include('includes.message-block')

    <style type="text/css">
    #div-post{
        /*Important:*/
        position:relative;
    }

    #div-post:hover { background-color: #eff0f1; }

    /*Important:*/
    .link-spanner{
        position:absolute; 
        width:100%;
        height:100%;
        top:0;
        left: 0;
        z-index: 1;

        /* edit: fixes overlap error in IE7/8, 
        make sure you have an empty gif 
        background-image: url('empty.gif');*/
    }   
    </style>
@endsection()