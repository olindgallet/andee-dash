<?php
	require_once('db-config.php');
	require_once('encryption.php');
	
	/**
	  * Webservice to check if provided username and password is in the database.
	  *
	  * POST function requires 'username' and 'password' parameters.
	  * Possible return values:
	  *   {'status_code' => '200', 'status_message' => 'Login successful.'}
	  *   {'status_code' => '400', 'status_message' => 'Login unsuccessful.'}
	  *   {'status_code' => '404', 'status_message' => 'Login check unavailable.'}
	  *   {'status_code' => '412', 'status_message' => 'Insufficient parameters.'}
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
	
	if (isset($_POST['username']) && isset($_POST['password'])){
		if (is_login_correct($_POST['username'], $_POST['password'])){
			$response = array('status_code' => '200', 'status_message' => 'Login successful.');
		} else if (!is_login_correct($_POST['username'], $_POST['password'])){
			$response = array('status_code' => '400', 'status_message' => 'Login unsuccessful.');
		} else {
			$response = array('status_code' => '404', 'status_message' => 'Login check unavailable.');
		}
		echo json_encode($response);
	} else {
		$response = array('status_code' => '412', 'status_message' => 'Insufficient parameters');
		echo json_encode($response);
	}
?>