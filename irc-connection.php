<?php 
	/**
	 * Stole some code from here: http://www.dreamincode.net/forums/topic/82278-creating-an-irc-bot-in-php/
	 * IRC Commands:
	 * !twitter -> Displays your twitter page.
	 * !shutdown -> Shuts down the bot.
	 */
	require_once('irc-settings.php');
	require_once('bot-config.php');
	
	/**
	 *	Irc_Connection represents a connection to the IRC server.  Here is where all of the connection logic and
	 * the bot logic is located.
	 * Down the line I want to abstract commands such that commands are easier to add/remove from a list
	 * rather than going in here and navigating the code.
	**/
	
	class Irc_Connection{
		private $socket;
		private $irc_settings;
		
		private function __construct(){
			$this->irc_settings = Irc_Settings::get_default();
			$this->socket        = null;
		}
		
		public static function get_instance(){
			return new Irc_Connection();
		}
		
		//#sketchspace
		public function connect(){
			$i = 0;
			$joined = false;
			$server_response = "Could not connect :(";
			while ($i < count(Irc_Settings::$VALID_PORTS) && !$joined){
				$this->socket = @fsockopen($this->irc_settings->get_server(), $this->irc_settings->get_port());
				if ($this->socket != null){
					fputs($this->socket, "PASS ".$this->irc_settings->get_password()."\n");
					fputs($this->socket, "NICK ".$this->irc_settings->get_nick()."\n");
					$joined = true;
					$server_response = fgets($this->socket, 128);
				} 
				$i = $i + 1;
			}
			return $server_response;
		}
		
		public function join($channel){
			if (substr($channel, 0, 1) != '#'){
				$channel = '#'.$channel;
			}
			fputs($this->socket, "JOIN ".$channel."\n");
			
			$quit = false;
			// Continue the rest of the script here
			while(!$quit && $data = fgets($this->socket, 128)) {
					flush();
		 
					// Separate all data
					$ex = explode(' ', $data);
		 
					// Send PONG back to the server
					if($ex[0] == "PING"){
						fputs($this->socket, "PONG ".$this->ex[1]."\n");
					}
			
					// Say something in the channel
					$command = str_replace(array(chr(10), chr(13)), '', $ex[3]);
					if ($command == ":!twitter") {
						fputs($this->socket, "PRIVMSG ".$ex[2]." :My Twitter is: ".TWITTER_URL."\n");
					} elseif ($command == ":!shutdown"){
						fputs($this->socket, 'QUIT\n');
						fclose($this->socket);
						$quit = true;
					}
				}
 			}		
	}
?>