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
                                                        <span class="inline-block txt-dark" id="chat-name">Ezequiel</span>
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
                
                <!-- Row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default card-view panel-refresh">
                            <div class="refresh-container">
                                <div class="la-anim-1"></div>
                            </div>
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark">chat history</h6>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="pull-left inline-block refresh">
                                        <i class="zmdi zmdi-replay"></i>
                                    </a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body pa-0 row">
                                    <div class="mail-box chat-history">
                                        <div class="row">
                                            <aside class="col-md-12">
                                                <div class="inbox-body">
                                                    <div class="mail-option pl-15 pr-15">
                                                        <div class="chk-all">
                                                            <div class="checkbox checkbox-default inline-block">
                                                                <input type="checkbox" id="checkbox051"/>
                                                                <label for="checkbox051"></label>
                                                            </div>
                                                            <div class="btn-group">
                                                                <a data-toggle="dropdown" href="#" class="btn  all" aria-expanded="false">
                                                                All
                                                                <i class="fa fa-angle-down "></i>
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#"> None</a></li>
                                                                    <li><a href="#"> Read</a></li>
                                                                    <li><a href="#"> Unread</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="btn-group">
                                                                <a data-toggle="dropdown" href="#" class="btn  blue" aria-expanded="false">
                                                                More
                                                                <i class="fa fa-angle-down "></i>
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#"><i class="fa fa-pencil"></i> Mark as Read</a></li>
                                                                    <li><a href="#"><i class="fa fa-ban"></i> Spam</a></li>
                                                                    <li class="divider"></li>
                                                                    <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        
                                                        <ul class="unstyled inbox-pagination">
                                                            <li><span>1-10 of 234</span></li>
                                                            <li>
                                                                <a class="pl-15 pr-15" href="#"><i class="fa fa-angle-left  pagination-left"></i></a>
                                                            </li>
                                                            <li>
                                                                <a  href="#"><i class="fa fa-angle-right pagination-right"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table table-inbox table-hover mb-0">
                                                            <tbody>
                                                                <tr class="unread">
                                                                    <td class="inbox-small-cells">
                                                                        <div class="checkbox checkbox-default inline-block">
                                                                            <input type="checkbox" id="checkbox012"/>
                                                                            <label for="checkbox012"></label>
                                                                        </div>
                                                                        <i class="zmdi zmdi-star inline-block font-16"></i>
                                                                    </td>
                                                                    <td class="view-message  dont-show">Clay Masse</td>
                                                                    <td class="view-message ">Added a new class: Login Class Fast Site</td>
                                                                    <td class="view-message  text-right">
                                                                        <i class="zmdi zmdi-quote inline-block mr-15 font-16"></i>
                                                                        <span  class="time-chat-history inline-block">9:27 AM</span>
                                                                    </td>
                                                                </tr>
                                                                <tr class="unread">
                                                                    <td class="inbox-small-cells">
                                                                        <div class="checkbox checkbox-default inline-block">
                                                                            <input type="checkbox" id="checkbox013"/>
                                                                            <label for="checkbox013"></label>
                                                                        </div>
                                                                        <i class="zmdi zmdi-star inline-block font-16"></i>
                                                                    </td>
                                                                    
                                                                    <td class="view-message dont-show">Evie Ono</td>
                                                                    <td class="view-message">Improve the search presence of WebSite</td>
                                                                    <td class="view-message text-right">
                                                                        <i class="zmdi zmdi-quote inline-block mr-15 font-16"></i>
                                                                        <span  class="time-chat-history inline-block">April 01</span>
                                                                    </td>
                                                                </tr>
                                                                <tr class="">
                                                                    <td class="inbox-small-cells">
                                                                        <div class="checkbox checkbox-default inline-block">
                                                                            <input type="checkbox" id="checkbox014"/>
                                                                            <label for="checkbox014"></label>
                                                                        </div>
                                                                        <i class="zmdi zmdi-star inline-block font-16"></i>
                                                                    </td>
                                                                    
                                                                    <td class="view-message dont-show">Madalyn Rascon</td>
                                                                    <td class="view-message">Last Chance: Upgrade to Pro for </td>
                                                                    <td class="view-message text-right">
                                                                        <i class="zmdi zmdi-quote inline-block mr-15 font-16"></i>
                                                                        <span  class="time-chat-history inline-block">March 15</span>
                                                                    </td>
                                                                </tr>
                                                                <tr class="">
                                                                    <td class="inbox-small-cells">
                                                                        <div class="checkbox checkbox-default inline-block">
                                                                            <input type="checkbox" id="checkbox015"/>
                                                                            <label for="checkbox015"></label>
                                                                        </div>
                                                                        <i class="zmdi zmdi-star inline-block font-16"></i>
                                                                    </td>
                                                                    
                                                                    <td class="view-message dont-show">Mitsuko Heid</td>
                                                                    <td class="view-message">Boost Your Website Traffic</td>
                                                                    <td class="view-message text-right">
                                                                        <i class="zmdi zmdi-quote inline-block mr-15 font-16"></i>
                                                                        <span  class="time-chat-history inline-block">April 01</span>
                                                                    </td>
                                                                </tr>
                                                                <tr class="">
                                                                    <td class="inbox-small-cells">
                                                                        <div class="checkbox checkbox-default inline-block">
                                                                            <input type="checkbox" id="checkbox016"/>
                                                                            <label for="checkbox016"></label>
                                                                        </div>
                                                                        <i class="zmdi zmdi-star inline-block font-16"></i>
                                                                    </td>
                                                                    <td class="view-message dont-show">Ezequiel Merideth</td>
                                                                    <td class="view-message">Stop wasting your visitors </td>
                                                                    <td class="view-message text-right">
                                                                        <i class="zmdi zmdi-quote inline-block mr-15 font-16"></i>
                                                                        <span  class="time-chat-history inline-block">March 01</span>
                                                                    </td>
                                                                </tr>
                                                                <tr class="">
                                                                    <td class="inbox-small-cells">
                                                                        <div class="checkbox checkbox-default inline-block">
                                                                            <input type="checkbox" id="checkbox0016"/>
                                                                            <label for="checkbox0016"></label>
                                                                        </div>
                                                                        <i class="zmdi zmdi-star inline-block font-16"></i>
                                                                    </td>
                                                                    <td class="view-message dont-show">Jonnie Madalyn </td>
                                                                    <td class="view-message">New WOW Slider v7.8 - 67% off</td>
                                                                    <td class="view-message text-right">
                                                                        <i class="zmdi zmdi-quote inline-block mr-15 font-16"></i>
                                                                        <span  class="time-chat-history inline-block">March 14</span>
                                                                    </td>
                                                                </tr>
                                                                <tr class="unread">
                                                                    <td class="inbox-small-cells">
                                                                        <div class="checkbox checkbox-default inline-block">
                                                                            <input type="checkbox" id="checkbox018"/>
                                                                            <label for="checkbox018"></label>
                                                                        </div>
                                                                        <i class="zmdi zmdi-star inline-block font-16"></i>
                                                                    </td>
                                                                    <td class="view-message dont-show">Angelic Lauver</td>
                                                                    <td class="view-message">The One Sign Your Co-Worker Will Stab</td>
                                                                    <td class="view-message text-right">
                                                                        <i class="zmdi zmdi-quote inline-block mr-15 font-16"></i>
                                                                        <span  class="time-chat-history inline-block">Feb 19</span>
                                                                    </td>
                                                                </tr>
                                                                <tr class="unread">
                                                                    <td class="inbox-small-cells">
                                                                        <div class="checkbox checkbox-default inline-block">
                                                                            <input type="checkbox" id="checkbox019"/>
                                                                            <label for="checkbox019"></label>
                                                                        </div>
                                                                        <i class="zmdi zmdi-star inline-block font-16"></i>
                                                                    </td>
                                                                    
                                                                    <td class="view-message dont-show">Priscila Shy</td>
                                                                    <td class="view-message view-message">Welcome to the Drupal Community</td>
                                                                    <td class="view-message text-right">
                                                                        <i class="zmdi zmdi-quote inline-block mr-15 font-16"></i>
                                                                        <span  class="time-chat-history inline-block">March 04</span>
                                                                    </td>
                                                                </tr>
                                                                <tr class="">
                                                                    <td class="inbox-small-cells">
                                                                        <div class="checkbox checkbox-default inline-block">
                                                                            <input type="checkbox" id="checkbox022"/>
                                                                            <label for="checkbox022"></label>
                                                                        </div>
                                                                        <i class="zmdi zmdi-star inline-block font-16"></i>
                                                                    </td>
                                                                    
                                                                    <td class="view-message dont-show">Linda Stack</td>
                                                                    <td class="view-message view-message">Somebody requested a new password </td>
                                                                    <td class="view-message text-right">
                                                                        <i class="zmdi zmdi-quote inline-block mr-15 font-16"></i>
                                                                        <span  class="time-chat-history inline-block">June 13</span>
                                                                    </td>
                                                                </tr>
                                                                <tr class="">
                                                                    <td class="inbox-small-cells">
                                                                        <div class="checkbox checkbox-default inline-block">
                                                                            <input type="checkbox" id="checkbox032"/>
                                                                            <label for="checkbox032"></label>
                                                                        </div>
                                                                        <i class="zmdi zmdi-star inline-block font-16"></i>
                                                                    </td>
                                                                    
                                                                    <td class="view-message dont-show">John Doe</td>
                                                                    <td class="view-message view-message">Password successfully changed</td>
                                                                    <td class="view-message text-right">
                                                                        <i class="zmdi zmdi-quote inline-block mr-15 font-16"></i>
                                                                        <span  class="time-chat-history inline-block">April 01</span>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </aside>
                                        </div>
                                    </div>
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