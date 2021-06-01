<?php

require_once('includes/config.php'); // alle Konstanten für das Projekt
require_once('includes/functions.php'); // funktionen für das Projekt
require_once('includes/sessioncheck.php'); // Sessioncheck zum schutz des Admintools vor unerlaubtem Zugriff

?>

<?php include('html/header.html.php'); ?>


		<!-- dashboard -->
		<section class="uk-section-default uk-padding uk-width">
			<h1>Dashboard</h1>
			<div class="uk-grid uk-grid-match uk-grid-margin uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-4@m uk-text-center" uk-grid>
				<div>
					<div class="uk-card uk-card-default">
						<div class="uk-card-body uk-text-center">
							<span class="icon-cart"></span><br>	
							<strong>Produkte</strong>	
							<br>
							<a class="uk-button uk-button-link" href="produkte_liste.php" >Produkte verwalten</a>
						</div>
					</div>
				</div>
				
				<div>
					<div class="uk-card uk-card-default">
						<div class="uk-card-body uk-text-center">
							<span class="icon-user"></span><br>
							<strong>Benutzer</strong>	
							<br>
							<a class="uk-button uk-button-link">Benutzer verwalten</a>
						</div>
					</div>
				</div>
				
				<div>
					<div class="uk-card uk-card-default">
						<div class="uk-card-body uk-text-center">
							<span class="icon-list"></span><br>
							<strong>Bestellungen</strong>	
							<br>
							<a class="uk-button uk-button-link">Bestellungen verwalten</a>
						</div>
					</div>
				</div>
				
				<div>
					<div class="uk-card uk-card-default">
						<div class="uk-card-body uk-text-center">
							<span class="icon-image"></span><br>
							<strong>Bilder</strong>	
							<br>
							<a class="uk-button uk-button-link" href="imagemanager.php">Bilder verwalten</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		
<?php include('html/footer.html.php'); ?>
	