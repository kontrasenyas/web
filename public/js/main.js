var postId = 0;
var postBodyElement = null;
var postContactElement = null;
var postLocationElement = null;
var postElement = null;


$('.post').find('.interaction').find('.edit').on('click', function (event) {
	event.preventDefault();

	postElement = event.target.parentNode.parentNode;

	postBodyElement = postElement.childNodes[3].childNodes[1];
	postContactElement = postElement.childNodes[3].childNodes[3];
	postLocationElement = postElement.childNodes[3].childNodes[5];
	

	var postBody = postBodyElement.textContent;
	var postContact = postContactElement.textContent
	var postLocation = postLocationElement.textContent
	postId = event.target.parentNode.parentNode.dataset['postid'];

	$('#post-body').val(postBody);
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
			contactNo: $('#post-contact').val(), 
			location: $('#post-location').val(),  
			postId: postId, 
			_token: token
		}
	})
	.done(function (msg) {
		//console.log(JSON.stringify(msg));
		$(postBodyElement).text(msg['new_body']);
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