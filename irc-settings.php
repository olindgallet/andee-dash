<?php 
	/**
	 * IRC Settings.
	 */
	class Irc_Settings{
		private $server;
		private $port;
		private $nick;
		private $name;
		private $password;
		public static $VALID_PORTS = Array(80, 443, 6667);
		
		private function __construct($server, $port, $nick, $name, $password){
			$this->server     = $server;
			$this->port        = $port;
			$this->nick        = $nick;
			$this->name      = $name;
			$this->password = $password;
		}
		
		public static function get_default(){
			return new Irc_Settings('irc.twitch.tv','443','**username**','**same as username**','**This is your oAuth Key**');
		}
		
		public function get_server(){
			return $this->server;
		}
		
		public function get_port(){
			return $this->port;
		}
		
		public function get_nick(){
			return $this->nick;
		}
		
		public function get_name(){
			return $this->name;
		}
		
		public function get_password(){
			return $this->password;
		}
	}
?>