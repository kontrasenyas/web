<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109991283-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-109991283-1');
    </script>

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-8604489693205973",
        enable_page_level_ads: true
      });
    </script>

    @yield('meta')

    <title>@yield('title')</title>

    <base href="{{ URL::to('/') }}">
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    @yield('css')

</head>

<body>
	<!--Preloader-->
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <!--/Preloader-->

    <!-- #wrapper -->
    <div class="wrapper theme-1-active pimary-color-red">
    	@include('layouts.partials.top-menu-items')
    	@include('layouts.partials.right-sidebar')
    	@include('layouts.partials.left-sidebar')

    	<!-- Main Content -->
    	<div class="page-wrapper" style="padding-bottom: 40px;">
    		@yield('content')

    		<!-- Footer -->
			<footer class="footer container-fluid pl-30 pr-30">
			    <div class="row">
			        <div class="col-sm-12">
			            <p>2017 &copy; Libot. Created by Joseph Alcantara</p>
			        </div>
			    </div>
			</footer>
			<!-- /Footer -->

    	</div>
    	<!-- /Main Content -->
    </div>
	<!-- /#wrapper -->
    @yield('script')
    {{-- For message count in header.blade.php --}}
        @if(Auth::check())
        <script type="text/javascript">
            var theUrl = "{{ route('count.message', ['user_id' =>  Auth::user()->id]) }}"
            $.get(
                theUrl,                
                function(data) {
                    document.getElementById("message_count").innerHTML = data;

                    if (data == 0) {
                        $('#message_count').remove();
                        // $('#message_count').removeClass('label-danger');
                        // $('#message_count').addClass('label-default');                        
                    }                   
                }
            );
        </script>
        @endif
    {{-- End --}}
</body>

</html>