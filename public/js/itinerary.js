var itineraryId = 0;
var itineraryTitleElement = null;
var itineraryBodyElement = null;
var itineraryLocationElement = null;
var itineraryElement = null;

$('.itinerary').find('.interaction').find('.edit').on('click', function (event) {
	event.preventDefault();

	itineraryElement = $(".itinerary");
	itineraryTitleElement = document.getElementById('title');
	itineraryBodyElement = document.getElementById('body');
	itineraryLocationElement = document.getElementById('location');

	var itineraryTitle = itineraryTitleElement.textContent;
	var itineraryBody = itineraryBodyElement.textContent;
	var itineraryLocation = itineraryLocationElement.textContent;
	itineraryId = $(".itinerary").data("itineraryid"); 

	$('#itinerary-title').val(itineraryTitle);
	$('#itinerary-body').val(itineraryBody);
	$('#post-location').val(itineraryLocation);

	$('#edit-modal').modal();
});

$('#edit-itinerary-form').on('submit', function(event) {
	event.preventDefault();
	$.ajax({
		method: 'POST',
		url: urlEdit,
		data: {
			title: $('#itinerary-title').val(),
			body: $('#itinerary-body').val(),
			location: $('#post-location').val(),
			itineraryId: itineraryId, 
			_token: token
		}
	})
	.done(function (msg) {				
		$(itineraryTitleElement).text(msg['new_title']);
		$(itineraryBodyElement).text(msg['new_body']);
		$(itineraryLocationElement).text(msg['new_location']);
		$('#edit-modal').modal('hide');
		$.toast({
			text: 'Itinerary successfully updated',
			position: 'top-right',
			loaderBg:'#f2b701',
			icon: 'success',
			hideAfter: 3500, 
			stack: 6
		});
	});
});