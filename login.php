<?php
	require_once('db-config.php');
	require_once('encryption.php');
	require_once('site-config.php');
	require_once('session-util.php');
	
	session_start();
	
	/**
	  * This page logins the user.
	  *		If login is successful, go to the dashboard.
	  * 	If login is unsuccessful, go home.
	  * Also note that the SITE_TOKEN session must be set.
	  *
	  */
	  
	function is_login_correct($username, $password){
		$response = false;
		try {
			$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USERNAME, DB_PASSWORD);
			$stmt = $db->prepare('SELECT password FROM users WHERE username=:username');
			$stmt->bindValue(':username', $username);
			$stmt->execute();
			$result = current($stmt->fetch());
			if ($result != null){
				$response = validate_pw($password, $result);
			}
		} catch(PDOException $ex) {
			$response = $ex;
		}
		return $response;
	}
	
	function get_channel_name($username){
		$response = false;
		try{
			$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USERNAME, DB_PASSWORD);
			$stmt = $db->prepare('SELECT channel_name FROM users WHERE username=:username');
			$stmt->bindValue(':username', $username);
			$stmt->execute();
			$response = current($stmt->fetch());
		} catch (PDOException $ex){
			$response = $ex;
		}
		return $response;
	}
	
	if (isset($_POST['username']) && isset($_POST['password']) && is_site_in_session()){
		if (is_login_correct($_POST['username'], $_POST['password'])){
			$channel = get_channel_name($_POST['username']);
			if ($channel != null){
				$_SESSION['channel-name'] = $channel;
				header('Location: '.SITE_DASHBOARD);
			} else {
				//error page.
			}
		} else {
			//create an error page!
		}
	} else {
		header('Location: '.SITE_HOME);
	}
?>