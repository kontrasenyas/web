<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>{{ $sent_to->first_name }} {{ $sent_to->last_name }}</title>
    <meta name="description" content="With Libot Philippines, we creates socially responsible travel experiences thus, making it more convenient to find travel packages for everyone." />
    <meta name="keywords" content="libot, libot philippines, travel, libot travel" />
    <meta name="author" content="hencework"/>

    <base href="{{ URL::to('/') }}">
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    {{-- @yield('css') --}}
    <!-- switchery CSS -->
    <link href="vendors/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" type="text/css"/>

    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">

    <link href="{{ URL::to('css/link.css')}}" rel="stylesheet" type="text/css">

</head>

<body>
    <!-- #wrapper -->
    <div class="wrapper theme-1-active pimary-color-red ma-0 pa-0">
        <!-- Main Content -->
        <div class="page-wrapper pa-0 ma-0  ">
            {{-- @yield('content') --}}
            <!-- Row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default border-panel card-view pa-0" style="
    border-top-width: 0px;">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="chat-cmplt-wrap chat-for-widgets-1">
                                    <div class="recent-chat-wrap">
                                        <div class="panel-heading ma-0 pt-15">
                                            <div class="goto-back">
                                                <a  id="goto_back_widget_1" href="javascript:void(0)" class="inline-block txt-grey">
                                                    <i class="zmdi zmdi-account-add"></i>
                                                </a>    
                                                <span class="inline-block txt-dark" id="chat-name"><a href="{{ route('account.profile', $sent_to->id) }}" target="_parent" style="float: none !important; ">{{ $sent_to->first_name }} {{ $sent_to->last_name }}</a></span>
                                                <a href="javascript:void(0)" class="inline-block text-right txt-grey"><i class="zmdi zmdi-more"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="panel-wrapper collapse in">
                                            <div class="panel-body pa-0">
                                                @if(count($message) > 0)
                                                <div class="chat-content endless-pagination" data-next-page="{{ $message_reply->nextPageUrl() }}" id="message" style="overflow-y:scroll; height: 400px;">
                                                    <ul class="chatapp-chat-nicescroll-bar pt-20">
                                                        @foreach($message_reply->reverse() as $reply)
                                                        @if($reply->user->id != Auth::user()->id)
                                                            <li class="friend">
                                                                <div class="friend-msg-wrap">
                                                                    <img class="user-img img-circle block pull-left"  src="{{ route('account.image', ['filename' => $sent_to->profile_picture_path]) }}" alt="user"/>
                                                                    <div class="msg pull-left">
                                                                        <p>{!! nl2br(e($reply->reply)) !!}</p>
                                                                        <div class="msg-per-detail text-right">
                                                                            <span class="msg-time txt-grey" title="{{$reply->created_at->format('F d, Y g:i A')}}">{{ $reply->created_at->diffForHumans() }}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>  
                                                            </li>
                                                        @endif()
                                                        @if($reply->user->id == Auth::user()->id)
                                                            <li class="self mb-10">
                                                                <div class="self-msg-wrap">
                                                                    <div class="msg block pull-right">{!! nl2br(e($reply->reply)) !!}
                                                                        <div class="msg-per-detail text-right">
                                                                            <span class="msg-time txt-grey" title="{{$reply->created_at->format('F d, Y g:i A')}}">{{ $reply->created_at->diffForHumans() }}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>  
                                                            </li>
                                                        @endif()
                                                        @endforeach()
                                                    </ul>
                                                </div>
                                                @endif()
                                                {{-- <div class="input-group">
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
                                                </div> --}}
                                                <div class="col-md-12">
                                                    <form action="{{ route('post.message', ['sent_to' => $sent_to->id]) }}" method="post">
                                                            <div class="form-group {{ $errors->has('reply') ? 'has-error' : '' }}">
                                                                <textarea class="form-control" placeholder="Message" aria-describedby="basic-addon2" name="reply" id="reply" value="{{ Request::old('reply') }}"></textarea>
                                                            </div>
                                                            <input type="text" class="form-control hidden" placeholder="id" aria-describedby="basic-addon2" name="sent_to" id="sent_to" value="{{ $sent_to->id }}">
                                                            <p class="text-muted"><small>Press Alt + Enter to send</small></p>

                                                            <button id="send" type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();">Send</button>
                                                            <input type="hidden" name="_token" value="{{ Session::token() }}">
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
            <!-- /Row -->
        </div>
        <!-- /Main Content -->
    </div>
    <!-- /#wrapper -->

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

    <script type="text/javascript" src="{{ URL::to('js/main.js')}}"></script>
    <script type="text/javascript" src="{{ URL::to('js/anchorme.js')}}"></script>
    <script type="text/javascript" src="{{ URL::to('js/message.js')}}"></script>
</body>

</html>