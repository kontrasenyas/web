<div class="form-group">
	<form action="{{ route('search') }}" method="get" >
		<div class="row">
			<div class="text-center col-md-6 col-md-offset-3">
				<div class="">
					<div class="row form-group">
						<div class="col-md-12">
							<div class="col-md-6">
								<input type="text" class="form-control" placeholder="Search for Car/Services/Packages" name="query" autocomplete="off" value="{{ Request::query('query') }}">
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control typeahead" placeholder="Province" name="location" id="location" autocomplete="off" value="{{ Request::query('location') }}">
							</div>
						</div>						
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<div class="col-md-12">
								<input type="text" class="form-control" placeholder="Keywords/Travel destination.." name="keywords" autocomplete="off" value="{{ Request::query('keywords') }}">
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">							
							<button class="btn btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">Search!</button>
							<input type="hidden" name="_token" value="{{ Session::token() }}">							
						</div>
					</div>
				</div><!-- /input-group -->
			</div>
		</div>	
	</form>
</div>

@section('script')
	@include('includes.places-autocomplete')
@endsection