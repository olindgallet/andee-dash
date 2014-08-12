<?php 
	require_once('bot-command.php');
	
	class Twitter_Bot_Command extends Abstract_Bot_Command{
		public function __construct(){
			$this->command = "!twitter";
		}
		
		public function getOutput($line_tokens){
		}
	}
?>