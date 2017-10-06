@extends('layouts.main')

@section('title')
Your Moments
@endsection

@section('css')
    <!-- Data table CSS -->
    <link href="vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    
    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">

    <link href="vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap Dropify CSS -->
    <link href="vendors/bower_components/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css"/>
@endsection()

@section('content')    
            <div class="container-fluid">
                
                <!-- Title -->
                <div class="row heading-bg">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h5 class="txt-dark">Moments</h5>
                    </div>
                    <!-- Breadcrumb -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="{{ route('home') }}">Profile</a></li>
                            <li class="active"><span>Moments</span></li>
                        </ol>
                    </div>
                    <!-- /Breadcrumb -->
                </div>
                <!-- /Title -->
                <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default card-view">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h6 class="panel-title txt-dark">Share your moments with us</h6>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <hr class="light-grey-hr mb-10"/>
                                <div  class="panel-wrapper collapse in">
                                    <div  class="panel-body pl-15">
                                        @if(Auth::check() && Auth::user()->id == $user->id)
                                        <div class="col-md-12 text-center form-group">
                                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#momentModal" id="btnMoment">What is your travel moment?</button>
                                        </div>
                                        @endif
                                        @include('moments.moment-user')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
            
            </div>

           @include('moments.moment-modal')

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
    {{-- <script src="vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script> --}}
    
    <!-- Switchery JavaScript -->
    <script src="vendors/bower_components/switchery/dist/switchery.min.js"></script>
    
    <!-- Fancy Dropdown JS -->
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>
    
    <!-- Init JavaScript -->
    <script src="dist/js/init.js"></script>  

    <!-- Form Flie Upload Data JavaScript -->
    <script src="dist/js/form-file-upload-data.js"></script>

    <!-- Bootstrap Daterangepicker JavaScript -->
    <script src="vendors/bower_components/dropify/dist/js/dropify.min.js"></script>

    <script type="text/javascript">
        @if (count($errors) > 0)
        $('#momentModal').modal('show');
        @endif
    </script> 

    <script type="text/javascript">
        $('textarea').each(function () {
            this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
        }).on('input', function () {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        $('#btnMoment').on("click", function(e){
            $("#body").height(20);
        });

        $('#momentModal').on('hidden.bs.modal', function (e) {
            var $body = $('#body').val();
            if($body != "")
            {
                $('#momentModalClose').modal('show')
            }
        });

        function clearData()
        {
            $('#momentModal')
                .find("textarea,select")
                .val('')
                .end()

            momentModalClose();
        }

        function openMomentModal()
        {
            $('#momentModal').modal('show');
        }

        function momentModalClose()
        {
            $('#momentModalClose').modal('hide');
        }
    </script>

    @include('includes.places-autocomplete')
    @include('includes.message-block')
@endsection()