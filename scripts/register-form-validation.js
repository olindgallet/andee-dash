$(document).ready(function(){
	$('#register-button').click(function(){
		var username  = $('#reg-username-field').val();
		var email         =  $('#reg-email-field').val();
		var password  = $('#reg-password-field').val();
		var rpassword = $('#reg-retype-password-field').val();
		var channel     = $('#reg-channel-name').val();

		if (!username.match(/^[a-zA-Z0-9]/) || username.length < 5 || username.length > 15) {
			$('#register-form-status').text('Username can only contain letters and/or numbers and be between 5-15 characters.');
		} else if (!password.match(/^[a-zA-Z0-9!@#$%^&*]/) || password.length < 5 || password.length > 15){
			$('#register-form-status').text('Password can only contain letters, numbers, or !@#$%^& and be between 5-15 characters.');
		} else if (!(rpassword === password)){
			$('#register-form-status').text('Passwords do not match.');
		} else if (email.indexOf('@') == -1){
			$('#register-form-status').text('Invalid email.');
		} else if (!channel.match(/^[a-zA-Z0-9-_]/) || channel.length <= 0){
			$('#register-form-status').text('Twitch channel is invalid.');
		} else {	
			$.ajax({
					type: "POST",
					url: "check-username.php",
					data: {username: username},
					async: false,
					success: function(data)
				{
					response = $.parseJSON(data);
					namecheck_code   = response['status_code'];
					namecheck_status = response['status_message'];
					
					console.log(namecheck_code);
					console.log(namecheck_status);
					$('#register-form-status').text(namecheck_status);
					if (namecheck_code == '200'){	
						$('#register-form').submit();
					}
				}
			});	
		}
	});
});