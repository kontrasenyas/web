<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({
                google_ad_client: "ca-pub-8604489693205973",
                enable_page_level_ads: true
            });
        </script>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="@yield('description')">
        <meta property="og:image" content="@yield('meta-image')">

        <title>@yield('title')</title>
        <link rel="shortcut icon" href="{{ URL::to('favicon.ico') }}">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/main.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/footer.css') }}">

        <style type="text/css">
            body { padding-top: 70px; }
        </style>

        <style type="text/css">
            .navbar-default {
                background-color: #009dff;
                border-color: #55beff;
            }
            .navbar-default .navbar-nav > li:hover { 
                background-color: #55beff; 
            }

            .navbar-default .navbar-brand {
                color: #ffffff;
            }
            .navbar-default .navbar-brand:hover,
            .navbar-default .navbar-brand:focus {
                color: #0073ba;
            }
            .navbar-default .navbar-text {
                color: #ffffff;
            }
            .navbar-default .navbar-nav > li > a {
                color: #ffffff;
            }
            .navbar-default .navbar-nav > li > a:hover,
            .navbar-default .navbar-nav > li > a:focus {
                color: #0073ba;
            }
            .navbar-default .navbar-nav > li > .dropdown-menu {
                background-color: #009dff;
            }
            .navbar-default .navbar-nav > li > .dropdown-menu > li > a {
                color: #ffffff;
            }
            .navbar-default .navbar-nav > li > .dropdown-menu > li > a:hover,
            .navbar-default .navbar-nav > li > .dropdown-menu > li > a:focus {
                color: #0073ba;
                background-color: #55beff;
            }
            .navbar-default .navbar-nav > li > .dropdown-menu > li > .divider {
                background-color: #55beff;
            }
            .navbar-default .navbar-nav .open .dropdown-menu > .active > a,
            .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover,
            .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus {
                color: #0073ba;
                background-color: #55beff;
            }
            .navbar-default .navbar-nav > .active > a,
            .navbar-default .navbar-nav > .active > a:hover,
            .navbar-default .navbar-nav > .active > a:focus {
                color: #0073ba;
                background-color: #55beff;
            }
            .navbar-default .navbar-nav > .open > a,
            .navbar-default .navbar-nav > .open > a:hover,
            .navbar-default .navbar-nav > .open > a:focus {
                color: #0073ba;
                background-color: #55beff;
            }
            .navbar-default .navbar-toggle {
                border-color: #55beff;
            }
            .navbar-default .navbar-toggle:hover,
            .navbar-default .navbar-toggle:focus {
                background-color: #55beff;
            }
            .navbar-default .navbar-toggle .icon-bar {
                background-color: #ffffff;
            }
            .navbar-default .navbar-collapse,
            .navbar-default .navbar-form {
                border-color: #ffffff;
            }
            .navbar-default .navbar-link {
                color: #ffffff;
            }
            .navbar-default .navbar-link:hover {
                color: #0073ba;
            }

            @media (max-width: 767px) {
                .navbar-default .navbar-nav .open .dropdown-menu > li > a {
                    color: #ffffff;
                }
                .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover,
                .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
                    color: #0073ba;
                }
                .navbar-default .navbar-nav .open .dropdown-menu > .active > a,
                .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover,
                .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus {
                    color: #0073ba;
                    background-color: #55beff;
                }
            }
        </style>
        

    </head>
    <body>
        @include('includes/header')

        <div class="container">           
          @yield('content')
        </div>
        <script src="https://code.jquery.com/jquery-3.0.0.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://code.jquery.com/jquery-migrate-3.0.0.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>

        <script type="text/javascript" src="{{ URL::to('js/main.js')}}"></script> 
        @include('includes.message-block')
        @include('includes/footer')
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
                        $('#message_count').removeClass('label-danger');
                        $('#message_count').addClass('label-default');                        
                    }                   
                }
            );
        </script>
        @endif
        {{-- End --}}
    </body>
</html>