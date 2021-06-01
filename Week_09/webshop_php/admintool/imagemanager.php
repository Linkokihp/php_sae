<?php

require_once('includes/config.php'); // alle Konstanten für das Projekt
require_once('includes/functions.php'); // funktionen für das Projekt
require_once('includes/sessioncheck.php'); // Sessioncheck zum schutz des Admintools vor unerlaubtem Zugriff

?>

<?php include('html/header.html.php'); ?>	
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
						<li class="uk-active"><a href="?folder=Home"><span class="icon-folder"></span>&nbsp;Home</a></li>
						<li><a href="?folder=Blogposts"><span class="icon-folder"></span>&nbsp;Blogposts</a></li>
						<li><a href="?folder=Specials"><span class="icon-folder"></span>&nbsp;Specials</a></li>
					</ul>
				</div>
			</div>
			<div class="">
				<div class="uk-card-default uk-card-body uk-card-small uk-text-center">
					<nav class="uk-navbar-container uk-margin" uk-navbar>
						<ul class="uk-nav">
							<li><a href="imagemanager_upload.php"><span class="icon-upload"></span> Hochladen</a></li>
						<ul>
					</nav>
					<div class="uk-grid uk-grid-match uk-grid-margin uk-child-width-1-1 uk-child-width-1-3@s uk-child-width-1-6@m" uk-grid>
						<div>
							<a href="../images/content/_thumbnails/titelbild_easter-cupcakes.jpg" target="_blank"><img src="../images/content/_thumbnails/titelbild_easter-cupcakes.jpg"></a>
						</div>
						<div>
							<a href="../images/content/_thumbnails/titelbild_lemon.jpg" target="_blank"><img src="../images/content/_thumbnails/titelbild_lemon.jpg"></a>
						</div>
						<div>
							<a href="../images/content/_thumbnails/titelbild.jpg" target="_blank"><img src="../images/content/_thumbnails/titelbild.jpg"></a>
						</div>
						<div>
							<a href="../images/content/_thumbnails/titelbild_rolo-cupcakes-dixie.jpg" target="_blank"><img src="../images/content/_thumbnails/titelbild_rolo-cupcakes-dixie.jpg"></a>
						</div>
						<div>
							<a href="../images/content/_thumbnails/titelbild-vanilla-cupcake.jpg" target="_blank"><img src="../images/content/_thumbnails/titelbild-vanilla-cupcake.jpg"></a>
						</div>
						<div>
							<a href="../images/content/_thumbnails/titelbild_strawberry.jpg" target="_blank"><img src="../images/content/_thumbnails/titelbild_strawberry.jpg"></a>
						</div>
						<div>
							<a href="../images/content/_thumbnails/titelbild_white-chocolate.jpg" target="_blank"><img src="../images/content/_thumbnails/titelbild_white-chocolate.jpg"></a>
						</div>
					</div>
				</div>
			</div>
				
			</div>
		</div>
	</section>
		

<?php include('html/footer.html.php'); ?>
	