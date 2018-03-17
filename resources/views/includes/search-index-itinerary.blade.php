@extends('layouts.main')

@section('meta')
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="Libot Philippines search page, we creates socially responsible travel experiences thus, making it more convenient to find travel packages and renting a car for everyone." />
    <meta name="keywords" content="libot, libot philippines, travel, libot travel, rent, search" />
    <meta name="author" content="libot-ph"/>
@endsection()

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

    <!-- bootstrap-select CSS -->
    <link href="vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
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
                            <form action="" method="get" id="search-form">
                                <div class="col-md-12">
                                        <div class="">
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    {{-- <label class="control-label mb-10">Select box</label> --}}
                                                    <select class="selectpicker" data-style="form-control btn-default btn-outline" name="search-type" id="search-type">
                                                        <option value="any" @if(Request::query('search-type') == 'any') selected @endif()>Any</option>
                                                        <option value="rental" @if(Request::query('search-type') == 'rental') selected @endif()>Rental</option>
                                                        <option value="package" @if(Request::query('search-type') == 'package') selected @endif()>Travel Package</option>
                                                        <option value="itinerary" @if(Request::query('search-type') == 'itinerary') selected @endif()>Itinerary</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" placeholder="Location" name="location" id="location" autocomplete="off" required="" value="{{ Request::query('location') }}" >
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" placeholder="Search for Car/Services/Packages" name="query" autocomplete="off" value="{{ Request::query('query') }}">
                                                </div>                          
                                            </div>                                            
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" placeholder="Keywords" name="keywords" autocomplete="off" value="{{ Request::query('keywords') }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">                         
                                                    <button id="btnSearch" class="btn btn-primary" type="submit" onclick="this.disabled=true;search();this.form.submit();">Search!</button>
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
                                    @if(count($itinerarys) < 1)
                                        <div class="col-md-6">
                                            No results!
                                        </div>
                                    @endif
                                    @if(count($itinerarys) > 0)
                                        <div class="col-md-12"> <p class="info"> {{ $itinerarys->total() }} result/s </p></div>
                                        <div class="col-md-12">
                                            @foreach($itinerarys as $itinerary)
                                                <p><strong>{{ $itinerary->user->first_name }} {{ $itinerary->user->last_name }}</strong>
                                                @if((Auth::user() && (Auth::user()->id != $itinerary->user->id) ))
                                                    <a href="{{ route('get.message-post', ['user_id' => $itinerary->user->id, 'itinerary_id' => $itinerary->id]) }}"><span class="glyphicon glyphicon-envelope text-primary" title="Send message to this user."></span></a>
                                                @endif
                                                @if(!Auth::user())
                                                <a href="#" data-toggle="modal" data-target="#register-first"><span class="glyphicon glyphicon-envelope text-primary" title="Please register to send a message."></span></a>
                                                @endif
                                                </p>
                                                <a href="{{ route('get.itinerary', ['itinerary_id' => $itinerary->id]) }}" style="text-decoration:none">
                                                    <div class="form-group div_hover col-md-12">                    
                                                        <div class="post row" data-postid="{{ $itinerary->id }}">                
                                                            <div class="col-md-6">
                                                                <h4 class="body text-uppercase">{{ str_limit($itinerary->title, $limit = 15, $end = '...') }}</h4>                
                                                                <div class="info">
                                                                    <p class="panel-title">{{ $itinerary->type }}</p>
                                                                    <p class="body text-uppercase">{{ str_limit($itinerary->location, $limit = 22, $end = '...') }}</p>
                                                                    <p>Posted by {{ $itinerary->user->first_name }} {{ $itinerary->created_at->diffForHumans() }}</p>
                                                                    <p>Description: {{ str_limit($itinerary->body, $limit = 15, $end = '...') }}</p>
                                                                    {{-- <span class="text-muted">{{ $itinerary->view_count }} views</span> --}}
                                                                </div>
                                                            </div>              
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                        <div class="col-md-12 text-center">
                                            {{ $itinerarys->appends(Request::except('page'))->links() }}
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
    <script type="text/javascript" src="{{ URL::to('js/search.js') }}"></script>

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

    <!-- Bootstrap Select JavaScript -->
    <script src="vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

    @include('includes.places-autocomplete')
    @include('includes.message-block')
    @include('includes.register-first')
@endsection()

