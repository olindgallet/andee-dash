<?php
	require_once('db-config.php');
	
	/**
	  * Webservice to check if provided username and password is in the database.
	  *
	  * POST function requires 'username' and 'password' parameters.
	  * Possible return values:
	  *   {'status_code' => '200', 'status_message' => 'Username not used.'}
	  *   {'status_code' => '400', 'status_message' => 'Username is used.  Select another username.'}
	  *   {'status_code' => '404', 'status_message' => 'Username registration is unavailable.'}
	  *   {'status_code' => '412', 'status_message' => 'Insufficient parameters.'}
	  */
	  
	function has_username($username){
		$response = false;
		try {
			$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USERNAME, DB_PASSWORD);
			$stmt = $db->prepare('SELECT COUNT(*) FROM users WHERE username=:username');
			$stmt->bindValue(':username', $username);
			$stmt->execute();
			$response = $stmt->fetchColumn() > 0;
		} catch(PDOException $ex) {
			$response = $ex;
		}
		return $response;
	}
	
	if (isset($_POST['username'])){
		if (!has_username($_POST['username'])){
			$response = array('status_code' => '200', 'status_message' => 'Username not used.');
		} else if (has_username($_POST['username'])){
			$response = array('status_code' => '400', 'status_message' => 'Username is used.  Select another username.');
		} else {
			$response = array('status_code' => '404', 'status_message' => 'Username registration is unavailable.');
		}
		echo json_encode($response);
	} else {
		$response = array('status_code' => '412', 'status_message' => 'Insufficient parameters.');
		echo json_encode($response);
	}
?>