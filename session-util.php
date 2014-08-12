<?php
	/**
	 * All pages past the index requires the site token set.  Think of it as being logged in.
	 */

	define('SITE_TOKEN', "** Use your own site token!!**");
	require_once('encryption.php');
	
	function set_site_token(){
		$_SESSION['site_token'] = SITE_TOKEN;
	}
	
	function is_site_in_session(){
		return isset($_SESSION['site_token']) && $_SESSION['site_token'] == SITE_TOKEN;
	}
?>