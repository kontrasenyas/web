$(document).ready(function() {
	$('button[type="submit"]').attr('disabled', true);
	$('input[type="text"],textarea').on('keyup',function() {
		var textarea_value = $("#reply").val();
		if(textarea_value != '') {
			$('button[type="submit"]').attr('disabled' , false);
		}else{
			$('button[type="submit"]').attr('disabled' , true);
		}
	});
});

$(document).ready(function() {
	var ta = document.getElementById('reply');
	ta.onkeydown = function (event) {
		if (event.defaultPrevented) {
			return;
		}
		var handled = false;
		if (event.key !== undefined) {
			if (event.key === 'Enter' && event.altKey) {
				document.getElementById("send").click(); 
			}
		} else if (event.keyIdentifier !== undefined) {
			if (event.keyIdentifier === "Enter" && event.altKey) {
				document.getElementById("send").click(); 
			}

		} else if (event.keyCode !== undefined) {
			if (event.keyCode === 13 && event.altKey) {
				document.getElementById("send").click(); 
			}
		}
		if (handled) {
			event.preventDefault();
		};
	};
});

$(document).ready(function() {
	var message = $('#message');
	if (message[0]) {
		$("#message").scrollTop($("#message")[0].scrollHeight);
	}
});

$("#reply").focus();

$(document).ready(function() {
	var post_id = getParameterByName('post');
	var base_url = window.location.origin;
	var messageId = document.getElementById('message');

	if (messageId) {
		var message = messageId.innerHTML;
		var new_message = anchorme(message,{
			attributes:[
			{
				name:"target",
				value:"_blank"
			}
			]
		});
		document.getElementById('message').innerHTML = new_message;
	}	

	if (post_id) {
		var text = document.getElementById('reply');
		text.value +=  "Hi I'm interested in this post " + base_url + "/post/" + post_id + " ";
		$('button[type="submit"]').attr('disabled', false);
	} 
});

// Ajax load content of message
$(document).ready(function () {
	$('#message').scroll(function(){
		var msg = document.getElementById('message');
		var lastScrollHeight = msg.scrollHeight;

		if ($('#message').scrollTop() == 0){
			var page = $('.endless-pagination').data('next-page');               

			if(page !== null && page !== "") {
				clearTimeout( $.data( this, "scrollCheck" ) );

				$.data( this, "scrollCheck", setTimeout(function() {
					$.get(page, function(data){
						$('#message').prepend(data.messages);
						$('.endless-pagination').data('next-page', data.next_page);
						msg.scrollTop += (msg.scrollHeight-lastScrollHeight);
					});
				}, 350))

			}
		}
	});
});