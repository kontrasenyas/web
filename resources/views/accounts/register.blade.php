<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	    <title>Sign Up to Libot</title>
	    <meta name="description" content="Libot Philippines registration page." />
	    <meta name="keywords" content="libot, libot philippines, registration, libot registration, libot philippines registration" />
	    <meta name="author" content="libot"/>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		
		<!-- vector map CSS -->
		<link href="vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
		
		{{-- toast/notification --}}
    	<link href="vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
		
		<!-- Custom CSS -->
		<link href="dist/css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<!--Preloader-->
		<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>
		<!--/Preloader-->
		
		<div class="wrapper pa-0">
			<header class="sp-header">
				<div class="sp-logo-wrap pull-left">
					<a href="{{ route('register') }}">
						<img class="brand-img mr-10" src="dist/img/logo.png" alt="brand"/>
						<span class="brand-text">Libot</span>
					</a>
				</div>
				<div class="form-group mb-0 pull-right">
					<span class="inline-block pr-10">Already have an account?</span>
					<a class="inline-block btn btn-info btn-rounded btn-outline" href="{{ route('login') }}">Sign In</a>
				</div>
				<div class="clearfix"></div>
			</header>
			
			<!-- Main Content -->
			<div class="page-wrapper pa-0 ma-0 auth-page">
				<div class="container-fluid">
					<!-- Row -->
					<div class="table-struct full-width full-height">
						<div class="table-cell vertical-align-middle auth-form-wrap">
							<div class="auth-form  ml-auto mr-auto no-float">
								<div class="row">
									<div class="col-sm-12 col-xs-12">
										<div class="mb-30">
											<h3 class="text-center txt-dark mb-10">Sign up to Libot</h3>
											<h6 class="text-center nonecase-font txt-grey">Enter your details below</h6>
										</div>	
										<div class="form-wrap">
											<form action="{{ route('signup') }}" method="post">
												<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
													<label class="control-label mb-10" for="email">Email Address</label>
													<input type="email" class="form-control" required="" id="email" name="email" placeholder="Enter email" value="{{ Request::old('email') }}">
												</div>
												<div class="form-group {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
													<label class="control-label mb-10" for="mobile_no">Mobile Number</label>
													<input type="text" class="form-control" required="" id="mobile_no" name="mobile_no" placeholder="Enter mobile number" value="{{ Request::old('mobile_no') }}">
												</div>
												<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
													<label class="pull-left control-label mb-10" for="password">Password</label>
													<input type="password" class="form-control" required="" id="password" name="password" placeholder="Enter pwd" value="{{ Request::old('password') }}">
												</div>
												<div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
													<label class="pull-left control-label mb-10" for="first_name">First Name</label>
													<input type="text" class="form-control" required="" id="first_name" name="first_name" placeholder="Enter first name" value="{{ Request::old('first_name') }}">
												</div>
												<div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
													<label class="pull-left control-label mb-10" for="first_name">Last Name</label>
													<input type="text" class="form-control" required="" id="last_name" name="last_name" placeholder="Enter last name" value="{{ Request::old('last_name') }}">
												</div>
												<div align="center" class="g-recaptcha form-group" data-sitekey="6LfOYSAUAAAAAH-w85JaRA03LIOCowgsU3zInlhk"></div>
												<div class="form-group">
													<div class="checkbox checkbox-primary pr-10 pull-left">
														<input id="checkbox_2" required="" type="checkbox">
														<label for="checkbox_2"> I agree to all <a href="{{ route('terms')}}" target="_blank"><span class="txt-primary">Terms and Conditions</span></a></label>
													</div>
													<div class="clearfix"></div>
												</div>
												<div class="form-group text-center">
													<input type="hidden" name="_token" value="{{ Session::token() }}">
													<button type="submit" class="btn btn-info btn-rounded">sign Up</button>
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
				
			</div>
			<!-- /Main Content -->
		
		</div>
		<!-- /#wrapper -->
		
		<!-- JavaScript -->
		
		<!-- jQuery -->
		<script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>
		
		<!-- Bootstrap Core JavaScript -->
		<script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
		
		<!-- Slimscroll JavaScript -->
		<script src="dist/js/jquery.slimscroll.js"></script>
		
		<!-- Init JavaScript -->
		<script src="dist/js/init.js"></script>

		{{-- Init notification --}}
		@include('includes.message-block')

		{{-- Init Google recaptch --}}
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</body>
</html>
