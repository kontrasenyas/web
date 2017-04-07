<header>
	<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
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
          <li><a href="{{ route('account.profile', Auth::user()->id) }}">Account</a></li>
          <li><a href="{{ route('logout') }}">Logout</a></li>
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