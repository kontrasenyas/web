@extends('layouts.base.other')

@section('title')
	Sign Up to Libot
@endsection

@section('meta_content')
	<meta name="description" content="Libot Philippines registration page." />
	<meta name="keywords" content="libot, libot philippines, registration, libot registration, libot philippines registration" />
	<meta name="author" content="libot"/>
@endsection()

@section('content')
<!--Preloader-->
<div class="preloader-it">
	<div class="la-anim-1"></div>
</div>
<!--/Preloader-->

<div class="wrapper pa-0">
	<header class="sp-header">
		<div class="sp-logo-wrap pull-left">
			<a href="{{ route('home') }}">
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
												<label for="checkbox_2"> I agree to all <a href="#" data-toggle="modal" data-target="#termsModal"><span class="txt-primary">Terms and Conditions</span></a></label>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="form-group text-center">
											<input type="hidden" name="_token" value="{{ Session::token() }}">
											<button type="submit" class="btn btn-info btn-rounded">sign Up</button>
										</div>
									</form>
									<form class="form-group text-center" action="{{ route('login.facebook') }}">
				                      <button class="loginBtn loginBtn--facebook" type="submit" onclick="this.disabled=true;this.form.submit();">Signup using facebook</button>
				                      <input type="hidden" name="_token" value="{{ Session::token() }}"> 
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

	<!-- Modal -->
	<div id="termsModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Terms and Conditions</h4>
				</div>
				<div class="modal-body">
					<p>Last updated: May 24, 2017</p>


					<p>Please read these Terms and Conditions ("Terms", "Terms and Conditions") carefully before using the https://libot-ph.com/ website (the "Service") operated by Libot ("us", "we", or "our").</p>

					<p>Your access to and use of the Service is conditioned on your acceptance of and compliance with these Terms. These Terms apply to all visitors, users and others who access or use the Service.</p>

					<p>By accessing or using the Service you agree to be bound by these Terms. If you disagree with any part of the terms then you may not access the Service. This Terms & Conditions agreement is licensed by <a href="https://termsfeed.com" rel="nofollow">TermsFeed</a> to Libot.</p>


					<h4>Accounts</h4>

					<p>When you create an account with us, you must provide us information that is accurate, complete, and current at all times. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of your account on our Service.</p>

					<p>You are responsible for safeguarding the password that you use to access the Service and for any activities or actions under your password, whether your password is with our Service or a third-party service.</p>

					<p>You agree not to disclose your password to any third party. You must notify us immediately upon becoming aware of any breach of security or unauthorized use of your account.</p>


					<h4>Links To Other Web Sites</h4>

					<p>Our Service may contain links to third-party web sites or services that are not owned or controlled by Libot.</p>

					<p>Libot has no control over, and assumes no responsibility for, the content, privacy policies, or practices of any third party web sites or services. You further acknowledge and agree that Libot shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with use of or reliance on any such content, goods or services available on or through any such web sites or services.</p>

					<p>We strongly advise you to read the terms and conditions and privacy policies of any third-party web sites or services that you visit.</p>


					<h4>Governing Law</h4>

					<p>These Terms shall be governed and construed in accordance with the laws of Philippines, without regard to its conflict of law provisions.</p>

					<p>Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights. If any provision of these Terms is held to be invalid or unenforceable by a court, the remaining provisions of these Terms will remain in effect. These Terms constitute the entire agreement between us regarding our Service, and supersede and replace any prior agreements we might have between us regarding the Service.</p>


					<h4>Changes</h4>

					<p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material we will try to provide at least 30 days notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>

					<p>By continuing to access or use our Service after those revisions become effective, you agree to be bound by the revised terms. If you do not agree to the new terms, please stop using the Service.</p>


					<h4>Contact Us</h4>

					<p>If you have any questions about these Terms, please contact us.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>

</div>
<!-- /#wrapper -->
@endsection()

{{-- Facebook button --}}
  <style type="text/css">
    /* Shared */
    .loginBtn {
      box-sizing: border-box;
      position: relative;
      /* width: 13em;  - apply for fixed size */
      margin: 0.2em;
      padding: 0 15px 0 46px;
      border: none;
      text-align: left;
      line-height: 34px;
      white-space: nowrap;
      border-radius: 0.2em;
      font-size: 16px;
      color: #FFF;
    }
    .loginBtn:before {
      content: "";
      box-sizing: border-box;
      position: absolute;
      top: 0;
      left: 0;
      width: 34px;
      height: 100%;
    }
    .loginBtn:focus {
      outline: none;
    }
    .loginBtn:active {
      box-shadow: inset 0 0 0 32px rgba(0,0,0,0.1);
    }
    /* Facebook */
    .loginBtn--facebook {
      background-color: #4C69BA;
      background-image: linear-gradient(#4C69BA, #3B55A0);
      /*font-family: "Helvetica neue", Helvetica Neue, Helvetica, Arial, sans-serif;*/
      text-shadow: 0 -1px 0 #354C8C;
    }
    .loginBtn--facebook:before {
      border-right: #364e92 1px solid;
      background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/14082/icon_facebook.png') 6px 6px no-repeat;
    }
    .loginBtn--facebook:hover,
    .loginBtn--facebook:focus {
      background-color: #5B7BD5;
      background-image: linear-gradient(#5B7BD5, #4864B1);
    }
  </style>