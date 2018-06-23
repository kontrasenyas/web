<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        (function(e,t,n,i,s,a,c){e[n]=e[n]||function(){(e[n].q=e[n].q||[]).push(arguments)}
        ;a=t.createElement(i);c=t.getElementsByTagName(i)[0];a.async=true;a.src=s
        ;c.parentNode.insertBefore(a,c)
        })(window,document,"galite","script","https://cdn.jsdelivr.net/npm/ga-lite@2/dist/ga-lite.min.js");

        galite('create', 'UA-109991283-1', 'auto');
        galite('send', 'pageview');
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

    <link href="{{ URL::to('css/modal-center.css')}}" rel="stylesheet" type="text/css">

    @include('includes.places-autocomplete')

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
            @include('includes.modal-update-mobile')

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
    {{-- For facebook login, update mobile number from 00000000000 to valid mobile number --}}
        @if(Auth::check())
        <script type="text/javascript">
            $(document).ready(function(){
                var mobileNo = '{{ Auth::user()->mobile_no }}';

                if (mobileNo == '00000000000') {
                    $("#mobileModal").modal('show');
                }
            });
        </script>
        @endif
    {{-- End --}}
</body>
</html>