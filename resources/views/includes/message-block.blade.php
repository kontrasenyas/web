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
	$.notify.addStyle('notification', {
		html: "<div>@foreach($errors->all() as $error) <li><span data-notify-text></span>{{ $error }}</li> @endforeach</div>",
		classes: {
			base: {
				"font-weight": "bold",
				"font-size": "15px",
				"padding": "8px 15px 8px 14px",
				"text-shadow": "0 1px 0 rgba(255, 255, 255, 0.5)",
				"background-color": "#fcf8e3",
				"border": "1px solid #fbeed5",
				"border-radius": "4px",
				"white-space": "nowrap",
				"padding-left": "50px",
				"padding-right": "50px",
				"padding-top": "15px",
				"padding-bottom": "15px",
				"background-repeat": "no-repeat",
				"background-position": "3px 7px",
				"margin-bottom": "22px",
				"margin-right": "15px"
			},
			error: {
				"color": "#B94A48",
				"background-color": "#F2DEDE",
				"border-color": "#EED3D7",
				
			}			
		}
	});

	$.notify(' ', {
		style: 'notification',
		className: 'error',
		autoHide: false,
		position: 'right-bottom'		
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
	$.notify.addStyle('notification', {
		html: "<div><li>{{ Session::get('message') }}</li></div>",
		classes: {
			base: {
				"font-weight": "bold",
				"font-size": "15px",
				"padding": "8px 15px 8px 14px",
				"text-shadow": "0 1px 0 rgba(255, 255, 255, 0.5)",
				"background-color": "#fcf8e3",
				"border": "1px solid #fbeed5",
				"border-radius": "4px",
				"white-space": "nowrap",
				"padding-left": "50px",
				"padding-right": "50px",
				"padding-top": "15px",
				"padding-bottom": "15px",
				"background-repeat": "no-repeat",
				"background-position": "3px 7px",
				"margin-bottom": "22px",
				"margin-right": "15px"
			},
			success: {
				"color": "#468847",
				"background-color": "#DFF0D8",
				"border-color": "#D6E9C6",
			}	
		}
	});

	$.notify(' ', {
		style: 'notification',
		className: 'success',
		autoHide: false,
		position: 'right-bottom'
	});
</script>
@endif
