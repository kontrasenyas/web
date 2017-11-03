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
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="active"><span>messages</span></li>
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
                                                            <div class="chat-body" id="chat-body" data-messages="{{ route('ajax.messages', [Auth::user()->id, 'messages']) }}">
                                                                
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
        $(document).ready(function() {
            var url = $('#chat-body').attr('data-messages');

            $.ajax({
                method: 'GET',
                url: url,
                success: function(data) {
                    $('#chat-body').html(data.html);
                }
            });
        });        
    </script>
@endsection()