@extends('layouts.main')

@section('title')
Change Password
@endsection

@section('content')    
<!-- Main Content -->
    <div class="container-fluid">
        <!-- Row -->
        <div class="table-struct full-width">
            <div class="table-cell vertical-align-middle auth-form-wrap">
                <div class="auth-form  ml-auto mr-auto no-float">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="mb-30">
                                <h3 class="text-center txt-dark mb-10">Change Password</h3>
                            </div>  
                            <div class="form-wrap">
                                <form action="{{ route('account.post-change-password') }}" method="post">
                                    <div class="form-group {{ $errors->has('current-password') ? 'has-error' : '' }}">
                                        <label class="pull-left control-label mb-10" for="current-password">Old Password</label>
                                        <input type="password" class="form-control" required="" id="current-password" name="current-password" placeholder="Enter pwd">
                                    </div>
                                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                        <label class="pull-left control-label mb-10" for="password">New Password</label>
                                        <input type="password" class="form-control" required="" id="password" name="password" placeholder="Enter New pwd">
                                    </div>
                                    <div class="form-group {{ $errors->has('confirm-password') ? 'has-error' : '' }}">
                                        <label class="pull-left control-label mb-10" for="confirm-password">Confirm Password</label>
                                        <input type="password" class="form-control" required="" id="confirm-password" name="confirm-password" placeholder="Re-Enter pwd">
                                    </div>
                                    <div class="form-group text-center">
                                        <input type="hidden" value="{{ Session::token() }}" name="_token">
                                        <button type="submit" class="btn btn-info btn-rounded">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row -->   
    </div>
<!-- /Main Content -->
@endsection()