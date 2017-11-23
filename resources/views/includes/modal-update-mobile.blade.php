<!-- Modal -->
<div class="modal fade" id="mobileModal" role="dialog"  data-backdrop="static" data-keyboard="false">
	<div class="vertical-alignment-helper">
		<div class="modal-dialog vertical-align-center">    
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					{{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
					<h4 class="modal-title">Update your Mobile Number</h4>
				</div>
				<form action="{{ route('account.save-mobile') }}" method="post">
					<div class="modal-body">
						<div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">                        
							<label class="control-label mb-10" for="mobile_no">Mobile Number</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="icon-phone"></i></div>
								<input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="09051234567" value="{{ Request::old('mobile_no') }}">
							</div>                        
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" value="{{ Session::token() }}" name="_token">
						<button type="submit" class="btn btn-success">Update profile</button>
						<a href="{{ route('logout') }}" class="btn btn-default">Cancel</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>