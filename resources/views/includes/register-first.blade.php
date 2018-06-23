<!-- Modal -->
<div id="register-first" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
        <p>You must have a registered account before using this feature. <strong>REGISTER</strong> is free or you may contact them using the displayed contact details.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
        <a class="btn btn-success" href="{{ route('register') }}">Register</a>
      </div>
    </div>

  </div>
</div>