<div class="form-group">
	<form action="{{ route('search') }}" method="get" >
		<div class="row">
			<div class="text-center col-md-6 col-md-offset-3">
				<div class="input-group">

					<input type="text" class="form-control" placeholder="Search for..." name="query">
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit">Go!</button>
						<input type="hidden" name="_token" value="{{ Session::token() }}">
					</span>
				</div><!-- /input-group -->
			</div>
		</div>	
	</form>
</div>