<?php
/*
AUFGABE: Der Bereich darf nur angezeigt werden, wenn eine Session besteht, die den Loginstatus enthält und noch nicht abgelaufen ist.
Ist die Session (loginstatus) nicht vorhanden oder abgelaufen, muss das Script abgebrochen werden, und auf das Login umgeleitet werden.
*/
session_start();

$session_laufzeit = 5*60; // so lange zurück darf der session timestamp liegen
$localtime = time();

// prüfen, ob es eine Session mit isloggedin ($_SESSION['isloggedin']) gibt und den Timestamp von jetzt aus time() mit dem Wert aus $_SESSION['login_timestamp'] vergleichen
if( isset($_SESSION['isloggedin'])){
	if($_SESSION['isloggedin'] != true || ($_SESSION['login_timestamp'] + $session_laufzeit) < $localtime) {
		// wenn die Session nicht existiert oder der timestamp weiter zurückliegt als die erlaubte laufzeit (= kein Zugriff), soll auf das login umgeleitet werden
		header('location: login.php');
		exit;// Tipp: das Script darf im Fall, dass kein Zugriff besteht, nciht weiterlaufen, hierfür sollte exit() oder die() verwendet werden
	};
}	else{
	// wenn die Session nicht existiert oder der timestamp weiter zurückliegt als die erlaubte laufzeit (= kein Zugriff), soll auf das login umgeleitet werden
		header('location: login.php');
		exit;// Tipp: das Script darf im Fall, dass kein Zugriff besteht, nciht weiterlaufen, hierfür sollte exit() oder die() verwendet werden
};




?><!DOCTYPE html>
<html lang="en-gb" dir="ltr" vocab="http://schema.org/">
<head>
	<title>Cupcake Shop Admintool</title>
	<meta name="description" content="Webshop Projekt der Klasse WDD320">
	<link href="http://localhost/WDD320/Shop/admin/css/theme.css" rel="stylesheet" />
	<link href="http://localhost/WDD320/Shop/admin/css/custom.css" rel="stylesheet" />
	<script src="http://localhost/WDD320/Shop/js/uikit.js"></script>
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
	<div id="tm-mobile" uk-offcanvas mode="push" overlay flip>
		<div class="uk-offcanvas-bar">
			<button class="uk-offcanvas-close" type="button" uk-close></button>
			<div class="uk-child-width-1-1" uk-grid>
				<div>
					<div class="uk-panel" id="module-menu-mobile">
						<ul class="uk-nav uk-nav-default">
							<li class="uk-active"><a href="">Home</a></li>
							<li><a href="">Bekleidung</a></li>
							<li><a href="">Schuhe</a></li>
						</ul>    
					</div>
				</div>
			</div>
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
									<ul class="uk-navbar-nav"><li  class="uk-active"><a href="index.php">Dashboard</a></li><li ><a href="logout.php">Logout</a></li></ul>  
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
		
		<!-- produkte liste -->
		<section class="uk-section-default uk-padding uk-width">
			<h1>Dashboard</h1>
			<div class="uk-grid uk-grid-match">
				<div>
					<div class="uk-card uk-card-default">
						<div class="uk-card-body uk-text-center">
							<span class="icon-cart"></span><br>	
							<strong>Produkte</strong>	
							<br>
							<a class="uk-button uk-button-text">Produkte verwalten</a>
						</div>
					</div>
				</div>
				
				<div>
					<div class="uk-card uk-card-default">
						<div class="uk-card-body uk-text-center">
							<span class="icon-user"></span><br>
							<strong>Benutzer</strong>	
							<br>
							<a class="uk-button uk-button-text">Benutzer verwalten</a>
						</div>
					</div>
				</div>
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
						<li><a href="login.php">Logout</a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>	</div>
</body>
</html>