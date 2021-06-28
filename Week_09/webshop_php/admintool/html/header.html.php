<?php
include('includes/nav.php');

$mein_url = $_SERVER['PHP_SELF'];
echo basename($mein_url); 

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
							<?php
							foreach($mainnav as $navitem) {
								
								// andere Schreibweise, die genau das gleiche ausführt wie das IF/ELSE Konstrukt oben
								$class = (basename($mein_url) == $navitem['link'] ) ? 'uk-active' : '';
							?>
							<li class="<?php echo $class ?>"><a href="<?php echo $navitem['link'] ?>"><?php echo $navitem['name'] ?></a></li>
							<?php } ?>
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
										<img src="http://training.bytekultur.net/WDD-shopmaster/admin/images/layout/logo-pink.png" style="height:50px;">
										Cupcake Shop
									</a>
								</div>
								
								<div class="uk-navbar-right">										
									<ul class="uk-navbar-nav">									
										<?php
										foreach($mainnav as $navitem) {
											// andere Schreibweise, die genau das gleiche ausführt wie das IF/ELSE Konstrukt oben
											$class = (basename($mein_url) == $navitem['link'] ) ? 'uk-active' : '';
										?>
										<li class="<?php echo $class ?>"><a href="<?php echo $navitem['link'] ?>"><?php echo $navitem['name'] ?></a></li>
										<?php } ?>
									</ul>  
								</div>
								 
							</nav>
						</div>
					</div>
				</div>
			
		</div>