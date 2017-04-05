<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js"></script>
@if(count($errors) > 0)
<!-- <div class="row form-group">
	<div class="col-md-4 col-md-offset-4 error">
		<ul>
			@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
</div> -->
<script type="text/javascript">
 	$(document).ready( function () {
        $.bootstrapGrowl('<ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',{
            type: 'danger',
            delay: 4000,
            width: 300,
            align: 'center'
        });
    });
</script>
@endif

@if(Session::has('message'))
<!-- <div class="row form-group">
	<div class="col-md-4 col-md-offset-4 success">
		{{ Session::get('message') }}
	</div>

</div> -->
<script type="text/javascript">
 	$(document).ready( function () {
        $.bootstrapGrowl('{{ Session::get('message') }}',{
            type: 'success',
            delay: 4000,
            width: 300,
            align: 'center'
        });
    });
</script>
@endif

