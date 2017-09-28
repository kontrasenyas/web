<!-- Left Sidebar Menu -->
@if(Auth::user())
<div class="fixed-sidebar-left">
	<ul class="nav navbar-nav side-nav nicescroll-bar">
		<li class="navigation-header">
			<span>Main</span> 
			<i class="zmdi zmdi-more"></i>
		</li>
		<li>
			<a class="" href="{{ route('home') }}" id="home"><div class="pull-left"><i class="zmdi zmdi-home mr-20"></i><span class="right-nav-text">Home</span></div><div class="clearfix"></div></a>
		</li>
		<li>
			<a class="" href="{{ route('dashboard') }}" id="dashboard"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="clearfix"></div></a>
		</li>
		<li>
			<a class="" href="{{ route('messages', Auth::user()->id) }}" id="messages"><div class="pull-left"><i class="zmdi zmdi-email mr-20"></i><span class="right-nav-text">Messages</span></div><div class="clearfix"></div></a>
		</li>
		<li><hr class="light-grey-hr mb-10"/></li>
		<li class="navigation-header">
			<span>Other</span> 
			<i class="zmdi zmdi-more"></i>
		</li>
		<li>
			<a class="" href="{{ route('about') }}" id="about"><div class="pull-left"><i class="zmdi zmdi-info mr-20"></i><span class="right-nav-text">About Us</span></div><div class="clearfix"></div></a>
		</li>
		<li>
			<a class="" href="{{ route('contact') }}" id="contact"><div class="pull-left"><i class="zmdi zmdi-account-box-phone mr-20"></i><span class="right-nav-text">Contact Us</span></div><div class="clearfix"></div></a>
		</li>
		<li>
			<a class="" href="{{ route('help') }}" id="help"><div class="pull-left"><i class="zmdi zmdi-pin-help mr-20"></i><span class="right-nav-text">Help</span></div><div class="clearfix"></div></a>
		</li>
		<li>
			<a class="" href="{{ route('terms') }}" id="terms"><div class="pull-left"><i class="zmdi zmdi-collection-bookmark mr-20"></i><span class="right-nav-text">Terms & Condition</span></div><div class="clearfix"></div></a>
		</li>
		<li><hr class="light-grey-hr mb-10"/></li>
	</ul>
</div>
@endif()

@if(!Auth::user())
<div class="fixed-sidebar-left">
	<ul class="nav navbar-nav side-nav nicescroll-bar">
		<li class="navigation-header">
			<span>Main</span> 
			<i class="zmdi zmdi-more"></i>
		</li>
		<li>
			<a class="" href="{{ route('home') }}" id="home"><div class="pull-left"><i class="zmdi zmdi-home mr-20"></i><span class="right-nav-text">Home</span></div><div class="clearfix"></div></a>
		</li>
		<li>
			<a class="" href="{{ route('about') }}" id="about"><div class="pull-left"><i class="zmdi zmdi-info mr-20"></i><span class="right-nav-text">About Us</span></div><div class="clearfix"></div></a>
		</li>
		<li>
			<a class="" href="{{ route('contact') }}" id="contact"><div class="pull-left"><i class="zmdi zmdi-account-box-phone mr-20"></i><span class="right-nav-text">Contact Us</span></div><div class="clearfix"></div></a>
		</li>
		<li>
			<a class="" href="{{ route('help') }}" id="help"><div class="pull-left"><i class="zmdi zmdi-pin-help mr-20"></i><span class="right-nav-text">Help</span></div><div class="clearfix"></div></a>
		</li>
		<li>
			<a class="" href="{{ route('terms') }}" id="terms"><div class="pull-left"><i class="zmdi zmdi-collection-bookmark mr-20"></i><span class="right-nav-text">Terms & Condition</span></div><div class="clearfix"></div></a>
		</li>
		<li><hr class="light-grey-hr mb-10"/></li>
	</ul>
</div>
@endif()
<!-- /Left Sidebar Menu -->

<!-- Add or remove active class to menu -->
<script type="text/javascript">
	function cutUrl(url,n) {
	    return url.split('/').slice(0,n).join('/');
	}

	var currentPage = window.location.href;
	currentPage = cutUrl(currentPage, 4);
	var string = window.location.href;
	substring = currentPage;
	currentPage = (substring.split("/").pop());
	var active = document.getElementById(currentPage);

	if (string.indexOf(substring) !== -1) {
		if (active == null) {
			var active = document.getElementById('home');
			active.className += 'active';
		}
		else {
			active.className += 'active';	
		}		
	}		
</script>