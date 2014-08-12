<?php
	set_time_limit(0);
	
	require_once('irc-connection.php');
	
	/** 
	 * Web service to connect the bot a specific channel.
	 */
	
	function connect($channel){
		$connection = Irc_Connection::get_instance();
		$connection->connect();
		$connection->join($channel);
	}
	
	if (isset($_POST['channel'])){
		connect($_POST['channel']);
	} 
?>