var postId = 0;
var postTitleElement = null;
var postBodyElement = null;
var postCapacityElement = null;
var postContactElement = null;
var postLocationElement = null;
var postRadioTypeElement = null;
var postElement = null;


$('.post').find('.interaction').find('.edit').on('click', function (event) {
	event.preventDefault();

	postElement = $(".post");//postElement = event.target.parentNode.parentNode;
	postTitleElement = document.getElementById('title');
	postBodyElement = document.getElementById('body');
	postCapacityElement = document.getElementById('capacity');
	postContactElement = document.getElementById('contact');
	postLocationElement = document.getElementById('location');
	postRadioTypeElement = document.getElementById('type');

	var postTitle = postTitleElement.textContent;
	var postBody = postBodyElement.textContent;
	var postCapacity = postCapacityElement.textContent;
	var postContact = postContactElement.textContent;
	var postLocation = postLocationElement.textContent;
	var postRadioType = postRadioTypeElement.textContent;
	postId = $(".post").data("postid"); //postId = event.target.parentNode.parentNode.dataset['postid'];

	$('#post-title').val(postTitle);
	$('#post-body').val(postBody);
	$('#post-capacity').val(postCapacity);
	$('#post-contact').val(postContact);
	$('#post-location').val(postLocation);
	//$('#post-type').val(postRadioType);

	if(postRadioType == 'rental')
	{
		$("#radio_rental").prop("checked", true);
	}
	else if(postRadioType == 'package')
	{
		$("#radio_package").prop("checked", true);
	}

	$('#edit-modal').modal();
});

$('#edit-post-form').on('submit', function(event) {
	event.preventDefault();
	$.ajax({
		method: 'POST',
		url: urlEdit,
		data: {
			title: $('#post-title').val(),
			body: $('#post-body').val(),
			capacity: $('#post-capacity').val(),
			contactNo: $('#post-contact').val(),
			location: $('#post-location').val(),
			radioType: $('input[name=radio_type]:checked').val(),
			postId: postId, 
			_token: token
		}
	})
	.done(function (msg) {
		//console.log(JSON.stringify(msg));
		$(postTitleElement).text(msg['new_title']);
		$(postBodyElement).text(msg['new_body']);
		$(postCapacityElement).text(msg['new_capacity']);
		$(postContactElement).text(msg['new_contact']);
		$(postLocationElement).text(msg['new_location']);
		$(postRadioTypeElement).text(msg['new_radioType']);
		//$(postElement).effect("highlight", {color: '#eff0f1'}, 5000);
		$('#edit-modal').modal('hide');
		$.toast({
            //heading: 'Welcome to Magilla',
            text: 'Post successfully updated',
            position: 'top-right',
            loaderBg:'#f2b701',
            icon: 'success',
            hideAfter: 3500, 
            stack: 6
          });
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
