@extends('layouts.main')

@section('title')
Messages
@endsection

@section('css')
    <!-- switchery CSS -->
    <link href="vendors/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" type="text/css"/>
        
    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
@endsection()

@section('content')  
    <div class="container-fluid">
                <!-- Title -->
                <div class="row heading-bg">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                      <h5 class="txt-dark">chats</h5>
                    </div>
                    <!-- Breadcrumb -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                      <ol class="breadcrumb">
                        <li><a href="index.html">Dashboard</a></li>
                        <li><a href="#"><span>apps</span></a></li>
                        <li class="active"><span>chats</span></li>
                      </ol>
                    </div>
                    <!-- /Breadcrumb -->
                </div>
                <!-- /Title -->
                
                <!-- Row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default border-panel card-view pa-0">
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body pa-0">
                                    <div class="chat-cmplt-wrap chat-for-widgets-1">
                                        <div class="chat-box-wrap">
                                            <div>
                                                <form role="search" class="chat-search">
                                                    <div class="input-group">
                                                        <input id="example-input1-group21" name="example-input1-group2" class="form-control" placeholder="Search" type="text">
                                                        <span class="input-group-btn">
                                                        <button type="button" class="btn  btn-default"><i class="zmdi zmdi-search"></i></button>
                                                        </span>
                                                    </div>
                                                </form>
                                                <div class="chatapp-nicescroll-bar">
                                                    <ul class="chat-list-wrap">
                                                        <li class="chat-list">
                                                            <div class="chat-body">
                                                                @if(count($list) == 0)
                                                                    <div class="input-group pa-5"><p>There is no message. Please start conversation with others.</p></div>
                                                                @endif()
                                                                {{-- <a  href="javascript:void(0)">
                                                                    <div class="chat-data active-user">
                                                                        <img class="user-img img-circle"  src="dist/img/user.png" alt="user"/>
                                                                        <div class="user-data">
                                                                            <span class="name block capitalize-font">Clay Masse</span>
                                                                            <span class="time block truncate txt-grey">No one saves us but ourselves.</span>
                                                                        </div>
                                                                        <div class="status away"></div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                </a> --}}
                                                                @foreach($list as $each)
                                                                    @if($each->user_one == Auth::user()->id)
                                                                        <a href="{{ route('get.message', ['user_id' => $each->user_two]) }}" class="message-link">
                                                                            @if($each->latest_user_reply == Auth::user()->id)
                                                                                <div class="chat-data">
                                                                                    <img class="user-img img-circle"  src="{{ route('account.image', ['filename' => $each->profile_picture_path]) }}" alt="user"/>
                                                                                    <div class="user-data">
                                                                                        <span class="name block capitalize-font">{{ $each->first_name }} {{ $each->last_name }}</span>
                                                                                        <span class="time block truncate txt-grey">You: {{ $each->reply }}</span>
                                                                                        <span class="time block truncate txt-grey">{{ Carbon\Carbon::parse($each->mr_created)->diffForHumans() }}</span>
                                                                                    </div>
                                                                                    <div class="status away"></div>
                                                                                    <div class="clearfix"></div> 
                                                                                </div>
                                                                            @endif()
                                                                            @if($each->latest_user_reply != Auth::user()->id)
                                                                                @if($each->is_read == 0)
                                                                                    <div class="chat-data active-user">
                                                                                @endif
                                                                                @if($each->is_read == 1)
                                                                                    <div class="chat-data">  
                                                                                @endif  
                                                                                <img class="user-img img-circle"  src="{{ route('account.image', ['filename' => $each->profile_picture_path]) }}" alt="user"/>
                                                                                <div class="user-data">
                                                                                    <span class="name block capitalize-font">{{ $each->first_name }} {{ $each->last_name }}</span>
                                                                                    <span class="time block truncate txt-grey">You: {{ $each->reply }}</span>
                                                                                    <span class="time block truncate txt-grey">{{ Carbon\Carbon::parse($each->mr_created)->diffForHumans() }}</span>
                                                                                </div>
                                                                                    <div class="status away"></div>
                                                                                    <div class="clearfix"></div> 
                                                                                </div>
                                                                            @endif()
                                                                        </a>
                                                                    @endif()
                                                                    @if($each->user_two == Auth::user()->id)
                                                                        <a href="{{ route('get.message', ['user_id' => $each->user_one]) }}" class="message-link">
                                                                            @if($each->latest_user_reply == Auth::user()->id)
                                                                                <div class="chat-data">
                                                                                    <img class="user-img img-circle"  src="{{ route('account.image', ['filename' => $each->profile_picture_path]) }}" alt="user"/>
                                                                                    <div class="user-data">                                                                                    
                                                                                        <span class="name block capitalize-font">{{ $each->first_name }} {{ $each->last_name }}</span>
                                                                                        <span class="time block truncate txt-grey">You: {{ $each->reply }}</span>
                                                                                        <span class="time block truncate txt-grey">{{ Carbon\Carbon::parse($each->mr_created)->diffForHumans() }}</span>
                                                                                    </div>
                                                                                    <div class="status away"></div>
                                                                                    <div class="clearfix"></div> 
                                                                                </div>
                                                                            @endif()
                                                                            @if($each->latest_user_reply != Auth::user()->id)
                                                                                @if($each->is_read == 0)
                                                                                    <div class="chat-data active-user">
                                                                                @endif
                                                                                @if($each->is_read == 1)
                                                                                    <div class="chat-data">  
                                                                                @endif  
                                                                                <img class="user-img img-circle"  src="{{ route('account.image', ['filename' => $each->profile_picture_path]) }}" alt="user"/>
                                                                                <div class="user-data">
                                                                                    <span class="name block capitalize-font">{{ $each->first_name }} {{ $each->last_name }}</span>
                                                                                    <span class="time block truncate txt-grey">You: {{ $each->reply }}</span>
                                                                                    <span class="time block truncate txt-grey">{{ Carbon\Carbon::parse($each->mr_created)->diffForHumans() }}</span>
                                                                                </div>
                                                                                    <div class="status away"></div>
                                                                                    <div class="clearfix"></div> 
                                                                                </div>
                                                                            @endif()
                                                                        </a>
                                                                    @endif()
                                                                @endforeach()
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="recent-chat-box-wrap">
                                            <div class="recent-chat-wrap pa-0 ma-0" id="content">
                                                <embed id="getMessage" src="" height="1000px;" width="100%"></embed>
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
@endsection()

@section('script')
    <!-- JavaScript -->
    
    <!-- jQuery -->
    <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    
    <!-- Slimscroll JavaScript -->
    <script src="dist/js/jquery.slimscroll.js"></script>
    
    <!-- Owl JavaScript -->
    <script src="vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
    
    <!-- Fancy Dropdown JS -->
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>
    
    <!-- Switchery JavaScript -->
    <script src="vendors/bower_components/switchery/dist/switchery.min.js"></script>
    
    <!-- Init JavaScript -->
    <script src="dist/js/init.js"></script>

    {{-- <script type="text/javascript">
        $.ajax({
            method: 'GET',
            url: 'http://libot.local:8000/message/u/2'
        })
        .done(function (msg) {
            console.log(msg.messages)
            $('#content').html(msg.messages);
        });
    </script> --}}

    <script type="text/javascript">
        $('.message-link').on('click', function(e) {
            e.preventDefault();
            var messageLink = $(this).attr('href');
            var embedMessage = document.getElementById("getMessage");
            var clone = embedMessage.cloneNode(true);
            clone.setAttribute('src', messageLink);
            embedMessage.parentNode.replaceChild(clone, embedMessage)
        });
    </script>
@endsection()