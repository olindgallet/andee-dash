$(document).ready(function(){
	$('#login-button').click(function(){
		var username  = $('#login-username-field').val();
		var password  = $('#login-password-field').val();

		if (!username.match(/^[a-zA-Z0-9]/) || username.length < 5 || username.length > 15) {
			$('#login-form-status').text('Username can only contain letters and/or numbers and be between 5-15 characters.');
		} else if (!password.match(/^[a-zA-Z0-9!@#$%^&*]/) || password.length < 5 || password.length > 15){
			$('#login-form-status').text('Password can only contain letters, numbers, or !@#$%^& and be between 5-15 characters.');
		} else {	
			$.ajax({
					type: "POST",
					url: "check-login.php",
					data: {username: username, password: password},
					async: false,
					success: function(data)
				{
					response = $.parseJSON(data);
					namecheck_code   = response['status_code'];
					namecheck_status = response['status_message'];
					
					$('#login-form-status').text(namecheck_status);
					
					if (namecheck_code == '200'){	
						$('#login-form').submit();
					} 
				}
			});	
		}
	});
});