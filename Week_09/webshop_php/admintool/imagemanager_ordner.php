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
							<li class="uk-active"><a href=""><span class="icon-folder"></span>&nbsp;Home</a></li>
							<li><a href=""><span class="icon-folder"></span>&nbsp;Blogposts</a></li>
							<li><a href=""><span class="icon-folder"></span>&nbsp;Specials</a></li>
						</ul>
					</div>
				</div>
				<div class="">
					<div class="uk-card-default uk-card-body uk-card-small">
						<form>
							<nav class="uk-navbar-container uk-margin" uk-navbar>
								<ul class="uk-subnav">
									<li><a class="uk-button uk-button-muted uk-button-small" href="imagemanager.php"><span class="icon-folder-plus"></span> Abbrechen</a></li>
									<li><button type="submit" class="uk-button uk-button-default uk-button-small"><span class="icon-folder-plus"></span> Speichern</button></li>
								<ul>
							</nav>
							<div>
								<label>Ordnername: </label>
								<input type="text" name="ordnername" />
							</div>
						</form>
						
					</div>
				</div>
					
				</div>
			</div>
		</section>
		

<?php include('html/footer.html.php'); ?>
	