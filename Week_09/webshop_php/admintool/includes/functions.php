<?php

function writeHTMLHead($pageTitle='Cupcake Shop', $metaDesc='Webshop Projekt der Klasse ...'){
	$headHTML = '<title>'.$pageTitle.'</title>';
	$headHTML .= '<meta name="description" content="'.$metaDesc.'">';
	$headHTML .= '<link href="css/theme.css" rel="stylesheet" />';
	$headHTML .= '<link href="css/custom.css" rel="stylesheet" />';
	$headHTML .= '<script src="js/uikit.js"></script>';
	
	return $headHTML; 
}

function writeNavbarMobile(){
	$navHTML = '
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
	</div>';
	
	$navHTML .= '
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
	</div>';
		
	return $navHTML; 
}

function writeNavbar( $nav ){
	
	$navHTML = '
		<div class="tm-header uk-visible@m" uk-header>
			<div uk-sticky media="@m" show-on-up animation="uk-animation-slide-top" cls-active="uk-navbar-sticky" sel-target=".uk-navbar-container">
					<div class="uk-navbar-container">
						<div class="uk-container uk-container-expand">
							<nav class="uk-navbar" uk-navbar="{&quot;align&quot;:&quot;left&quot;,&quot;boundary&quot;:&quot;!.uk-navbar-container&quot;,&quot;dropbar&quot;:true,&quot;dropbar-anchor&quot;:&quot;!.uk-navbar-container&quot;,&quot;dropbar-mode&quot;:&quot;slide&quot;}">
								<div class="uk-navbar-left">                                                   
									<a href="index.php" class="uk-navbar-item uk-logo">
										<img src="images/layout/logo-pink.png" style="height:50px;">
										Cupcake Shop
									</a>
								</div>
								
								<div class="uk-navbar-center">										
									'.writeNav( $nav ).'  
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
			
		</div>';
		
	return $navHTML; 
}


function writeNav( $nav_array ){
	// print_r($_SERVER);
	$filename = substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/')+1);
	// echo $filename; 
		
	
	$nav = '<ul class="uk-navbar-nav">';
	// print_r($nav_array);
	foreach( $nav_array as $navitem ){
		if($filename ==  $navitem['link']){
			$activeClass=' class="uk-active"'; 
		}else{
			$activeClass=''; 
		}
		$nav .= '<li '.$activeClass.'><a href="'.$navitem['link'].'">'.$navitem['text'].'</a></li>';
	}
	$nav .= '</ul>';
	return $nav;
}


function writeFooter(){
	$footerHTML = '
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
	</section>';
	return $footerHTML;
}

?>