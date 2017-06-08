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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script> 
<script type="text/javascript">
	var path = "{{ route('search.location') }}";
	$('input.typeahead').typeahead({
		minLength: 1,
		source:  function (query, process) {
			return $.get(path, { query: query }, function (data) {
				return process(data);
			});
		}
	}); 

	var $input = $(".typeahead");
	$input.change(function() {
		var current = $input.typeahead("getActive");
		if (current) {
			if (current.name == $input.val()) {
				console.log('2');
			} else {
				$('#location').val("");
			}
		} else {
			$('#location').val("");
		}
	});
</script>
@endsection