<header>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">Libot Philippines</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::user())
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('messages', Auth::user()->id) }}">Messages <span id="message_count" class="label label-pill label-danger"></span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle capitalize" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->first_name }}<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('moments.user', Auth::user()->id) }}">Your Moments</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('account.profile', Auth::user()->id) }}">Account</a></li>
                                <li><a href="{{ route('logout') }}">Logout</a></li>
                                {{--<li role="separator" class="divider"></li>--}}
                                {{--<li><a href="#">Separated link</a></li>--}}
                                {{--<li role="separator" class="divider"></li>--}}
                                {{--<li><a href="#">One more separated link</a></li>--}}
                            </ul>
                    @endif
                    @if(!Auth::user())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endif
                </ul>
            </div>
        </div><!-- /.container-fluid -->
    </nav>
</header>