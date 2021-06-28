<?php

require_once('includes/config.php'); // alle Konstanten für das Projekt
require_once('includes/functions.php'); // funktionen für das Projekt

session_name(CUSTOM_SESSIONNAME); // key meinEigenerSessionCookieKey statt PHPSESSID - vor session_start() und in einer App immer gleich (da sonst die Session nicht mehr gefunden wird)
session_start(); // Session Zugriff starten / Array bereitstellen mit Session-Daten, wenn vorhanden
session_regenerate_id(); // neue ID für meine Session - hacker kann die alte nun nicht mehr brauchen, falls er sie hat.

$hasError = false; 
$messages = array(); 

// das kommt vielleicht später aus der DB:
$username = 'admin@webshop.com';
$passwort = '$2y$10$7AqoGP6s4/.19j3iMImc4Od8G2/p28b7RzC7dGywExEqYnotP.lHa'; // Resultat von password_hash() mit dem Passwort 'test1234'

// wurde das Frmular abgeschickt?
if( isset($_POST['username']) && isset($_POST['passwort']) ){
	// stimmen die Daten aus POST mit den gespeicherten überein?
	
	// wenn alles korrekt ist, loginstatus und timestamp in session: 
	if( $_POST['username'] == $username && password_verify($_POST['passwort'], $passwort)==true ){ // password_verify() kann den User Input wieder zum gleichen Hash umwandeln, und so mit dem vorher gespeicherten Resultat aus password_hash() vergleichen
		$_SESSION['isloggedin'] = true;
		$_SESSION['login_timestamp'] = time();
		header('Location: index.php');
	
	}else{
		$hasError = true; 
		$messages[] = 'Logindaten sind nicht korrekt';
	}
}


?>
<!DOCTYPE html>
<html lang="en-gb" dir="ltr" vocab="http://schema.org/">
<head>
	<title>Cupcake Shop Admintool</title>
	<meta name="description" content="Webshop Projekt der Klasse WDD320">
	<link href="https://training.bytekultur.net/WDD-shopmaster/css/theme.css" rel="stylesheet" />
	<link href="https://training.bytekultur.net/WDD-shopmaster/css/custom.css" rel="stylesheet" />
	<script src="https://training.bytekultur.net/WDD-shopmaster/js/uikit.js"></script>
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
				</div>
			</nav>
		</div>
	</div>
	
		<!-- header large -->
		
		<div class="tm-header uk-visible@m" uk-header>
			<div uk-sticky media="@m" show-on-up animation="uk-animation-slide-top" cls-active="uk-navbar-sticky" sel-target=".uk-navbar-container">
					<div class="uk-navbar-container">
						<div class="uk-container uk-container-expand">
							<nav class="uk-navbar uk-width-1-4@m" uk-navbar="{"align":"left","boundary":"!.uk-navbar-container","dropbar":true,"dropbar-anchor":"!.uk-navbar-container","dropbar-mode":"slide"}">
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
			
			<?php if( count($messages)>0 ){ ?>
			<hr>
			<div class="uk-alert error">
				<?php echo implode('<br>', $messages); ?>
			</div>
			<hr>
			<?php } ?>
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
	
<?php include('html/footer.html.php'); ?>