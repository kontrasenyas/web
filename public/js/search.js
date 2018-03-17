function search()
{
	var type = $('#search-type').val();			
	var searchItinerary = 'search-itinerary';
	var search = 'search';

	if (type == 'itinerary') {    			
		$('#search-form').attr('action', searchItinerary);
	}
	else {    			  	
		$('#search-form').attr('action', search);		
	}
}