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
                                                                        <a href="{{ route('get.message', ['user_id' => $each->user_two]) }}">
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
                                                                        <a href="{{ route('get.message', ['user_id' => $each->user_one]) }}">
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
                                            <div class="recent-chat-wrap">
                                                <div class="panel-heading ma-0 pt-15">
                                                    <div class="goto-back">
                                                        <a  id="goto_back_widget_1" href="javascript:void(0)" class="inline-block txt-grey">
                                                            <i class="zmdi zmdi-account-add"></i>
                                                        </a>    
                                                        <span class="inline-block txt-dark" id="chat-name">Maan Decena</span>
                                                        <a href="javascript:void(0)" class="inline-block text-right txt-grey"><i class="zmdi zmdi-more"></i></a>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                                <div class="panel-wrapper collapse in">
                                                    <div class="panel-body pa-0">
                                                        <div class="chat-content">
                                                            <ul class="chatapp-chat-nicescroll-bar pt-20">
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
                                                            <input type="text" id="input_msg_send_chatapp" name="send-msg" class="input-msg-send form-control" placeholder="Type something">
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
@endsection()