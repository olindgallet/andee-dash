<?php /** Modified from http://untame.net/2013/06/how-to-build-a-functional-login-form-with-php-twitter-bootstrap/ **/ ?>
<?php require_once('session-util.php'); ?>
<?php session_start(); ?>
<?php set_site_token(); ?>
<!html>
	<head>
		<title>AndeeBot</title>
		
		<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/css/bootstrap-theme.min.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
	</head>
	
	<body>
		<div class="row">
			<div class="col-md-2"></div>
			
			<div class="col-md-4">
				<form id="login-form" action="login.php" method="post">
					<h2>AndeeBot Login</h2>
					<ul>
						<li><label>Username:</label><input id="login-username-field" type="text" name="username" value="" require_onced/> </li>
						<li><label>Password:</label><input id="login-password-field" type="password" name="password" value="" require_onced/></li>
						<li><input type="button" id="login-button" class="btn btn-info" value="Login" /> </li>
					</ul>
					<div id="login-form-status" class="error-message"></div>
				</form>
				<form id="register-form" action="register.php" method="post">
					<h2>AndeeBot Registration</h2>
					<ul>
						<li><label>Username:</label><input id="reg-username-field" type="text" name="reg-username" value="" require_onced/> </li>
						<li><label>Password:</label><input id="reg-password-field" type="password" name="reg-password" value="" require_onced/></li>
						<li><label>Retype Password:</label><input id="reg-retype-password-field" type="password" name="reg-retype-password" value="" require_onced/></li>
						<li><label>Email:</label><input id="reg-email-field" type="email" name="reg-email" value="" require_onced/></li>
						<li><label>Twitch Channel Name:</label><input id="reg-channel-name" type="text" name="reg-channel-name" value="" require_onced/></li>
						<li><input type="button" id="register-button" class="btn btn-info" value="Register" /> </li>
					</ul>
					<div id="register-form-status" class="error-message"></div>
				</form>
				Made by <a href="http://www.olingallet.com/">Olin Gallet</a> &copy; <?php echo date("Y") ?>
			</div>
			
			<div class="col-md-3"></div>
			
			<div class="sidebar col-md-3">
				<h2>What is AndeeBot?</h2>
				<p>Andeebot is an IRC bot intended for use with <a href="http://www.twitch.tv">Twitch</a> as a way to maintain chat in channels.</p>
				
				<h2>Why use AndeeBot?</h2>
				<p>I really don't care if you do.  I know there are other robots, but the main reason I built this is to gain experience with PHP, Twitter Bootstrap, and various APIs.</p>
				
				<h2>So, why the name?</h2>
				<p>Andy is the name of my dog, but 'AndyBot' was taken as a username on Twitch.  So I went with the phonetic sound.</p>
			</div>
		</div>
		
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="scripts/login-form-validation.js"></script>
		<script type="text/javascript" src="scripts/register-form-validation.js"></script>
	</body>
</html>