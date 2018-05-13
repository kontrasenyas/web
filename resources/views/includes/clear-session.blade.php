<script type="text/javascript">   
	$('.signin').on('click', function() {
		$(this).data('clicked', true);
       //console.log('clicked')
   });

	$( document ).ready(function() {
		//console.log('{{session('url.intended')}}');
	});

	function clearSession(){
		console.log('{{session('url.intended')}}');
		$.ajax({
			method: 'GET',
			url: '{{ route('clear.session',['key' => 'url.intended']) }}',
			success: function(){
            //console.log('data');
        }
    });
	}
	$(window).bind('beforeunload', function(){
		if ($("#signin_fb").data('clicked') || $("#signin").data('clicked')) {
        //console.log('clic');
    }
    else {
    	clearSession();
    }      
      //return 'Are you sure you want to leave?';
  });
</script>