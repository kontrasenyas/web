var postId = 0;
var postBodyElement = null;
var postCapacityElement = null;
var postContactElement = null;
var postLocationElement = null;
var postElement = null;


$('.post').find('.interaction').find('.edit').on('click', function (event) {
	event.preventDefault();

	postElement = event.target.parentNode.parentNode;

	postBodyElement = document.getElementById('body');
	postCapacityElement = document.getElementById('capacity');
	postContactElement = document.getElementById('contact');
	postLocationElement = document.getElementById('location');

	var postBody = postBodyElement.textContent;
	var postCapacity = postCapacityElement.textContent;
	var postContact = postContactElement.textContent;
	var postLocation = postLocationElement.textContent;
	postId = event.target.parentNode.parentNode.dataset['postid'];

	$('#post-body').val(postBody);
	$('#post-capacity').val(postCapacity);
	$('#post-contact').val(postContact);
	$('#post-location').val(postLocation);
	$('#edit-modal').modal();
});

$('#modal-save').on('click', function() {
	$.ajax({
		method: 'POST',
		url: urlEdit,
		data: {
			body: $('#post-body').val(),
			capacity: $('#post-capacity').val(),
			contactNo: $('#post-contact').val(),
			location: $('#post-location').val(),  
			postId: postId, 
			_token: token
		}
	})
	.done(function (msg) {
		//console.log(JSON.stringify(msg));
		$(postBodyElement).text(msg['new_body']);
		$(postCapacityElement).text(msg['new_capacity']);
		$(postContactElement).text(msg['new_contact']);
		$(postLocationElement).text(msg['new_location']);
		$(postElement).effect("highlight", {color: '#eff0f1'}, 5000);
		$('#edit-modal').modal('hide');
		//$('.body').effect("highlight", {color: '#eff0f1'}, 5000);
		//$( "div" ).effect( "bounce", "slow" );
		//postBodyElement.effect = ["highlight", {color: '#eff0f1'}, 5000];
		//$(this).css("background-color", "red");
		// postBodyElement.style.backgroundColor = '#eff0f1';
		// setTimeout(function() {
		// 	postBodyElement.style.backgroundColor = 'white';
		// }, 2000);
	});
});

$('.like').on('click', function(event) {
	event.preventDefault();
	postId = event.target.parentNode.parentNode.dataset['postid'];
	var isLike = event.target.previousElementSibling == null;
	$.ajax({
		method: 'POST',
		url: urlLike,
		data: {isLike: isLike, postId: postId, _token: token}
	})
	.done(function() {
		event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this post' : 'Like' : event.target.innerText == 'Dislike' ? 'You don\'t like this post' : 'Dislike';
		if (isLike) {
			event.target.nextElementSibling.innerText = 'Dislike';
		} else {
			event.target.previousElementSibling.innerText = 'Like';
		}
	});
});

function getParameterByName(name, url) {
	if (!url) url = window.location.href;
	name = name.replace(/[\[\]]/g, "\\$&");
	var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
	results = regex.exec(url);
	if (!results) return null;
	if (!results[2]) return '';
	return decodeURIComponent(results[2].replace(/\+/g, " "));
}
