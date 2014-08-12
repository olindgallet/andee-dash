<?php require_once('session-util.php'); ?>
<?php require_once('site-config.php'); ?>
<?php session_start(); ?>
<?php if (!is_site_in_session() || !isset($_SESSION['channel-name'])){
	header('Location: '.SITE_HOME);
} ?>

<!html>
	<head>
		<title>AndeeBot | Dashboard</title>
		
		<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/css/bootstrap-theme.min.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
	</head>
	
	<body>
		<div class="row">
			<div class="titlebar col-md-9">`</div>
			<div class="titlebar col-md-3">
				Made by <a href="http://www.olingallet.com/">Olin Gallet</a> &copy; <?php echo date("Y") ?>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-1"></div>
				
			<div class="menu col-md-3">
				<h2>Chat</h2>
				<iframe frameborder="0" 
					scrolling="no" 
					id="chat_embed" 
					src="http://twitch.tv/chat/embed?channel=<?php echo $_SESSION['channel-name']; ?>&amp;popout_chat=true" 
					height="500" 
					width="100%">
				</iframe>
			</div>
			
			<div class="col-md-1"></div>
			
			<div id="twitch-player" class="menu col-md-3">
				<h2>Video</h2>
				<object bgcolor='#000000' 
					data='http://www.twitch.tv/widgets/archive_embed_player.swf' 
					height='500' 
					id='clip_embed_player_flash' 
					type='application/x-shockwave-flash' 
					width='100%'> 
					<param  name='movie' 
					value='http://www.twitch.tv/widgets/archive_embed_player.swf' /> 
					<param  name='allowScriptAccess' 
					value='always' /> 
					<param  name='allowNetworking' 
					value='all' /> 
					<param  name='allowFullScreen' 
					value='true' /> 
					<param  name='flashvars' 
					value='channel=<?php echo $_SESSION['channel-name']; ?>&start_volume=50&auto_play=false' />
				</object>
			</div>
			
			<div class="col-md-1"></div>
			
			<div class="menu col-md-3">
				<h2><span id="channel-name"><?php echo $_SESSION['channel-name']; ?></span></h2>
				<ul>
					<li><a class="glossy" href="logout.php">Logout</a></li>
					<li><a id="start-bot" class="glossy" href="#">Start Bot</a></li>
				</ul>
				
				<div id="bot-status"></div>
			</div>
			
		</div>
		
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="scripts/bot-control.js"></script>
	</body>
</html>