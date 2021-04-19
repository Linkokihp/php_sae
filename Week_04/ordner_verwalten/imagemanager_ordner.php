
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

<?php

//foldername + foldername
$dir = 'ordner/' . $_POST['ordnername'];

//Checks if Foldername already exists and creates folder
if( is_dir($dir) === false )
{
    mkdir($dir);
} else {
	echo 'Folder already exists you fool!';
};

//Scanns and Prints the "Folderarray" (FOR TESTING ONLY)
$files = scandir('../ordner_verwalten/ordner'); 
print_r($files);

?>

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
							<li  class=""><a href="index.php">Dashboard</a></li>
							<li  class=""><a href="index.php">Produkte</a></li>
							<li  class=""><a href="index.php">Benutzer</a></li>
							<li  class=""><a href="index.php">Bestellungen</a></li>
							<li  class="uk-active"><a href="imagemanager.php">Image Manager</a></li>
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
							<nav class="uk-navbar" uk-navbar="{"align":"left","boundary":"!.uk-navbar-container","dropbar":true,"dropbar-anchor":"!.uk-navbar-container","dropbar-mode":"slide"}">
								<div class="uk-navbar-left uk-width-medium">                                                   
									<a href="index.php" class="uk-navbar-item uk-logo">
										<img src="https://training.bytekultur.net/WDD-shopmaster/admin/images/layout/logo-pink.png" style="height:50px;">
										Cupcake Shop
									</a>
								</div>
								
								<div class="uk-navbar-right">										
									<ul class="uk-navbar-nav">
										<li  class=""><a href="index.php">Dashboard</a></li>
										<li  class=""><a href="index.php">Produkte</a></li>
										<li  class=""><a href="index.php">Benutzer</a></li>
										<li  class=""><a href="index.php">Bestellungen</a></li>
										<li  class="uk-active"><a href="imagemanager.php">Image Manager</a></li>
									</ul>  
								</div>  
							</nav>
						</div>
					</div>
				</div>
			
		</div>	
		
		<!-- image manager grid -->
		<section class="uk-section-default uk-padding uk-width">
			<h1>Image Manager</h1>
			<div class="uk-grid uk-grid-match uk-grid-margin uk-child-width-expand" uk-grid>
				<div class="uk-width-1-1 uk-width-1-3@s uk-width-1-4@m">
					<div class="uk-card-default uk-card-body uk-card-small">
						<nav class="uk-navbar-container uk-margin" uk-navbar>
							<ul class="uk-nav">
								<li><a href="imagemanager_ordner.php"><span class="icon-folder-plus"></span> Neuer Ordner</a></li>
							<ul>
						</nav>
						<ul class="uk-list">
							<li><span class="icon-folder"></span>&nbsp;Home</li>
						</ul>
					</div>
				</div>
				<div class="">
					<div class="uk-card-default uk-card-body uk-card-small">
						<form method="post">
							<nav class="uk-navbar-container uk-margin" uk-navbar>
								<ul class="uk-subnav">
									<li><a class="uk-button uk-button-muted uk-button-small" href="imagemanager.php"><span class="icon-folder-plus"></span> Abbrechen</a></li>
									<li><button type="submit" class="uk-button uk-button-default uk-button-small"><span class="icon-folder-plus"></span> Speichern</button></li>
								<ul>
							</nav>
							<div>
								<label>Ordnername: </label>
								<input type="text" name="ordnername" />
								<input type="submit">
							</div>
						</form>
						
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
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>	</div>
</body>
</html>