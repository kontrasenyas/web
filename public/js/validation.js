$('#email').keyup(function(){
	var email = $('#email').val();
	var url = "register/ajax/get-email/" + email;
	$("#email-availability-status").html('');
	$("#email-loader").show();
	
	if (email == "") {
		$("#email-loader").hide();
		$("#email-availability-status").html('Please enter Email address');
		$("#email-availability-status").removeClass();
		$("#email-availability-status").addClass('text-danger');
	}
	else {
		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))  
		{		
			$.ajax({
				type: "GET",
				url: url,
				success: function (data) {
					$("#email-loader").hide();

					if (data == 1) {
						$("#email-availability-status").html('Email address is available');
						$("#email-availability-status").removeClass();
						$("#email-availability-status").addClass('text-success');

					}
					else {
						$("#email-availability-status").html('Email address is not available');
						$("#email-availability-status").removeClass();
						$("#email-availability-status").addClass('text-danger');
					}
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});		
		}
		else {
			$("#email-loader").hide();
			$("#email-availability-status").html('Please enter valid Email address');
			$("#email-availability-status").removeClass();
			$("#email-availability-status").addClass('text-danger'); 
		}
	}
});

$('#mobile_no').keyup(function(){
	var mobile_no = $('#mobile_no').val();
	var url = "register/ajax/get-mobileno/" + mobile_no;
	$("#mobile_no-availability-status").html('');
	$("#mobile_no-loader").show();
	
	if (mobile_no == "") {
		$("#mobile_no-loader").hide();
		$("#mobile_no-availability-status").html('Please enter Mobile number');
		$("#mobile_no-availability-status").removeClass();
		$("#mobile_no-availability-status").addClass('text-danger');
	}
	else {
		if (/^\s*-?[0-9]{11,11}\s*$/.test(mobile_no))  
		{		
			$.ajax({
				type: "GET",
				url: url,
				success: function (data) {
					$("#mobile_no-loader").hide();

					if (data == 1) {
						$("#mobile_no-availability-status").html('Mobile number is available');
						$("#mobile_no-availability-status").removeClass();
						$("#mobile_no-availability-status").addClass('text-success');

					}
					else {
						$("#mobile_no-availability-status").html('Mobile number is not available');
						$("#mobile_no-availability-status").removeClass();
						$("#mobile_no-availability-status").addClass('text-danger');
					}
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});		
		}
		else {
			$("#mobile_no-loader").hide();
			$("#mobile_no-availability-status").html('Please enter valid Mobile number');
			$("#mobile_no-availability-status").removeClass();
			$("#mobile_no-availability-status").addClass('text-danger'); 
		}
	}
});

$('#re-password').keyup(function () {
	var password = $('#password').val();
	var rePassword = $('#re-password').val();

	if (password != '') {
		if (password != rePassword) {
			$("#re-enter-password-status").removeClass();
			$("#re-enter-password-status").addClass('text-danger'); 
			$('#re-enter-password-status').html('Password does not match');
		}
		else {
			$("#re-enter-password-status").removeClass();
			$('#re-enter-password-status').html('');
		}
	}
	else {
		$("#re-enter-password-status").removeClass();
		$('#re-enter-password-status').html('');
	}
});