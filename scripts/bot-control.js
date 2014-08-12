$(document).ready(function(){
	$('#start-bot').click(function(){
		$('#bot-status').html("Type !shutdown in chat to turn bot off.");
		 $.ajax({
			type: "POST",
			url: "bot.php",
			data: {channel: $('#channel-name').text()},
			success: function(msg)
		{
			$('#bot-status').html("Bot turned off.");
		}
		});
	});
});