<?php

	/**
		* A Bot_Command represents a command given to the bot through IRC chat.
		*/
	interface Bot_Command{
		public function getCommand();
		public function getOutput($line_tokens);
	}

	abstract class Abstract_Bot_Command implements Bot_Command{
		protected $command;
		
		public function getCommand(){
			return $this->command;
		}
		
		//abstract protected function getOutput($line_tokens);
	}
?>