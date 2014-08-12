<?php
	require_once('db-config.php');
	require_once('site-config.php');
	require_once('session-util.php');
	require_once('encryption.php');
	
    session_start();
	
	/**
	  * This page registers the user.
	  *		If registration is successful, go to the dashboard.
	  * 	If registration is unsuccessful, go home.
	  * Also note that the SITE_TOKEN session must be set.
	  *
	  */
	
	function has_username($username){
		$response = false;
		try {
			$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USERNAME, DB_PASSWORD);
			$stmt = $db->prepare('SELECT COUNT(*) FROM users WHERE username= :username');
			$stmt->bindValue(':username', $username);
			$stmt->execute();
			$response = $stmt->fetchColumn() > 0;
		} catch(PDOException $ex) {
			$response = $ex;
		}
		return $response;
	}
	
	function register_username($username, $password, $email, $channel_name){
		$response = true;
		try{
			$password = generate_hash($password);
			
			$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USERNAME, DB_PASSWORD);
			$stmt = $db->prepare("INSERT INTO users VALUES (:username, :password, :email, :channel_name, 0)");
			$stmt->bindValue(':username', $username);
			$stmt->bindValue(':password', $password);
			$stmt->bindValue(':email', $email);
			$stmt->bindValue(':channel_name', $channel_name);
			
			$stmt->execute();
			
		} catch(PDOException $ex){
			$response =  $ex;
		}
	}
	
	if (isset($_POST['reg-username']) && isset($_POST['reg-password']) && isset($_POST['reg-email']) && isset($_POST['reg-channel-name']) && is_site_in_session()){
		if (!has_username($_POST['reg-username'])){
			$_SESSION['channel-name'] = $_POST['reg-channel-name'];
			//set_user_token();
			register_username($_POST['reg-username'], $_POST['reg-password'], $_POST['reg-email'], $_POST['reg-channel-name']);
			header('Location: '.SITE_DASHBOARD);
		} else {
			//create an error page!
		}
	} else {
		header('Location: '.SITE_HOME);
	}
?>