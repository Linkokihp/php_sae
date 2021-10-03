<?php
	// session_set_cookie_params(0);
    session_start();
?>
<?php require_once('../config.php') ?>
<?php require '../vendor/autoload.php'; ?>
<?php require_once(ROOT_PATH . '/includes/head_section.php') ?>
		<meta charset="utf-8">
		<title>Ninjatt</title>
		<link rel="stylesheet" href="style/style.css">
	</head>
<?php
	$session_laufzeit = 5*60;  //5*60
	$localtime = time();
	include "../classes.php";


	if( isset($_SESSION['isloggedin'])){
	if($_SESSION['isloggedin'] != true || ($_SESSION['login_timestamp'] + $session_laufzeit) < $localtime) {
		$user = new user();
		$user->userLogout($_SESSION['UserMail']);
		echo '<script>alert("Your session has been expired! Please login again!")</script>';
		$_SESSION['logoutmessage'] = "Your session has been expired! Please login again!";
		header('location: ../index.php');
		header('location: ../logout.php');
		exit;
	};
	}	else{
		echo '<script>alert("Your session has been expired! Please login again!")</script>';
		$_SESSION['logoutmessage'] = "Your session has been expired! Please login again!";
		$user = new user();
		$user->userLogout($_SESSION['UserMail']);
		header('location: ../index.php');
		header('location: ../logout.php');
		exit;
};
?>
	<body onload="startTheGame()">

		<div class='welcome_msg'><h2>Welcome <span id="playerName"><?php echo $_SESSION['UserName']?></span> to Phil's Ninjatt</h2></div>

		<a class="logout" href="<?php echo BASE_URL . '/logout.php'; ?>" class="btn btn-flat">Sign out</a>

		<!-- USER ONLINESTATE -->
		<div class="onlineStateList">
			<p>Online:</p>
			<ul class="onlineState">
			</ul>
		</div>

		<!-- NinjaOutfit -->
		<div class="ninjaFit">
			<p>Select your Ninjatt-Outfit</p>
			<form id="ninjaFit" method="POST">
					<input type="radio" name="outfit" value="default" /> Default
					<input type="radio" name="outfit" value="red" /> Red
					<button type="submit" name="saveRadio" class="outfitBtn btn btn-primary">Save Ninjatt-Fit</button>
			</form>
		</div>

		<div class="frame">
			<div id="game-wrapper" class="container-fluid" style="display: none;">
				<div class="corner_topleft"></div>
				<div class="corner_topright"></div>
				<div class="corner_bottomleft"></div>
				<div class="corner_bottomright"></div>

				<div class="row">
					<div class="col-sm-4" style="min-width: 512px;">
						<div id="game"></div>
						<div id="chat" class="form-inline">
							<label>Message:</label>
							<input id="message" type="text" name="message" class="form-control" />
							<input type="button" id="sendMsg" value="Send" onclick="sendMessage();" class="btn btn-primary" />
						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="js/autobahn.min.js"></script>
		<script src="js/game.js"></script>
	</body>
</html>
