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
        <a class="navbar-brand" href="{{ route('dashboard') }}">Libot Philippines</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <ul class="nav navbar-nav navbar-right">
        @if(Auth::user())
        <li><a href="{{ route('account') }}">Account</a></li>
        <li><a href="{{ route('logout') }}">Logout</a></li>
      </ul>
      @endif
    </div><!-- /.container-fluid -->
  </nav>
</header>