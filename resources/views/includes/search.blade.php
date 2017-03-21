<div class="form-group">
	<form action="{{ route('search') }}" method="get" >
		<div class="row">
			<div class="text-center col-md-6 col-md-offset-3">
				<div class="input-group">
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-6">
								<input type="text" class="form-control" placeholder="Search for...(Van, Bus...)" name="query" value="{{ Request::query('query') }}">
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control typeahead" placeholder="Province" name="location" id="location" autocomplete="off" value="{{ Request::query('location') }}">
							</div>
						</div>
					</div>
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit">Go!</button>
						<input type="hidden" name="_token" value="{{ Session::token() }}">
					</span>
				</div><!-- /input-group -->
			</div>
		</div>	
	</form>
</div>