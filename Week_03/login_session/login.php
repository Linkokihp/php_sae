<?php
/* 
AUFGABE: das Formlar dient der Eingabe der Logindaten. 
Die Logindaten müssen mit einem gespeicherten Usernamen/Passwort verglichen werden, um eine Usersession zu erstellen, wenn diese korrekt sind.
Wenn der loginstatus gespeichert wurde, kann zum geschützten Bereich umgeleitet werden.
*/

session_start();
$hasError = false;
$message = array();

// das kommt vielleicht später aus der DB:
$username = 'admin@webshop.com';
$passwort = '$2y$10$cR3UGZfe2egANrMv4azSQeusUyw3F4gsBRL/Vh5d8fw8ipQdUHqd2'; //passwort: test1234

// wurde das Formular abgeschickt?
if( isset($_POST['username']) && isset($_POST['passwort']) ){
	// stimmen die Daten aus POST mit den gespeicherten überein?
	if($_POST['username'] === $username && password_verify($_POST['passwort'], $passwort) === true) {
		// wenn alles korrekt ist, loginstatus und timestamp in session: 
		$_SESSION['isloggedin'] = true;
		$_SESSION['login_timestamp'] = time();
		// weiterleitung in den geschützten Bereich
		header('location: geschuetzter-bereich.php');
		exit();
	} else {
		print('SOMETHINGS WRONG with your logggggin!');
		$hasError = true;
		$messages[] = 'Somethings Wooooong!';
	};
};



?>
<!DOCTYPE html>
<html lang="en-gb" dir="ltr" vocab="http://schema.org/">
<head>
	<title>Cupcake Shop Admintool</title>
	<meta name="description" content="Webshop Projekt der Klasse WDD320">
	<link href="http://localhost/WDD320/Shop/admin/css/theme.css" rel="stylesheet" />
	<link href="http://localhost/WDD320/Shop/admin/css/custom.css" rel="stylesheet" />
</head>
<body>
	<div class="tm-page">
		<!-- header mobile -->
		
	<div class="tm-header-mobile uk-hidden@m">
		<div class="uk-navbar-container">
			<nav uk-navbar="" class="uk-navbar">
				<div class="uk-navbar-left">
					<span href="/" class="uk-navbar-item uk-logo">
						Cupcake Shop
					</span>
				</div>
				<div class="uk-navbar-right">
					<a class="uk-navbar-toggle" href="#tm-mobile" uk-toggle="">
						<div uk-navbar-toggle-icon="" class="uk-icon uk-navbar-toggle-icon">
							<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="navbar-toggle-icon"><rect y="9" width="20" height="2"></rect><rect y="3" width="20" height="2"></rect><rect y="15" width="20" height="2"></rect></svg>
						</div>
					</a>
				</div>
			</nav>
		</div>
	</div>
	
		<!-- header large -->
		
		<div class="tm-header uk-visible@m" uk-header>
			<div uk-sticky media="@m" show-on-up animation="uk-animation-slide-top" cls-active="uk-navbar-sticky" sel-target=".uk-navbar-container">
					<div class="uk-navbar-container">
						<div class="uk-container uk-container-expand">
							<nav class="uk-navbar" uk-navbar="{&quot;align&quot;:&quot;left&quot;,&quot;boundary&quot;:&quot;!.uk-navbar-container&quot;,&quot;dropbar&quot;:true,&quot;dropbar-anchor&quot;:&quot;!.uk-navbar-container&quot;,&quot;dropbar-mode&quot;:&quot;slide&quot;}">
								<div class="uk-navbar-left">                                                   
									<a href="index.php" class="uk-navbar-item uk-logo">
										<img src="http://localhost/WDD320/Shop/admin/images/layout/logo-pink.png" style="height:50px;">
										Cupcake Shop
									</a>
								</div>
								
								<div class="uk-navbar-center">										
									<ul class="uk-navbar-nav"></ul>  
								</div>
								
								<div class="uk-navbar-right">
									<div class="uk-navbar-item" id="module-90">
										<div class="uk-margin-remove-last-child custom" >
											
										</div>
									</div>
								</div>  
							</nav>
						</div>
					</div>
				</div>
			
		</div>	
		<!-- login form -->
		<section class="uk-section-default uk-padding uk-width">
			<div class="uk-container uk-container-small">
			<h3>Bitte anmelden</h3>
				<form method="POST">

					<label for="fld_username">Username:</label>
					<input type="text" name="username" id="fld_username" value=""><br>
					
					<label for="fld_pw">Passwort:</label>
					<input type="password" name="passwort" id="fld_pw" value=""><br>
					
					
					<br>
					<input type="submit">
					
				</form>

			</div>
		</section>
		
		<!-- footer -->
		
	<section class="uk-section-secondary uk-section uk-section-large">
		<div class="uk-container uk-container-large">
			<div class="tm-grid-expand uk-grid-large uk-grid-margin-large uk-grid" uk-grid="">
				<div class="uk-width-1-2 uk-width-1-4@s uk-flex uk-flex-column uk-flex-end">
					<span class="uk-logo">Cupcake Shop</span>
					<span>Admintool</span>
				</div>
				
				<div class="uk-width-1-2 uk-width-3-4@s uk-first-column uk-flex uk-flex-bottom">
					<ul class="uk-subnav">
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>	</div>
</body>
</html>