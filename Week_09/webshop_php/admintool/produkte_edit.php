<?php

require_once('includes/config.php'); // alle Konstanten für das Projekt
require_once('includes/functions.php'); // funktionen für das Projekt
require_once('includes/sessioncheck.php'); // Sessioncheck zum schutz des Admintools vor unerlaubtem Zugriff

?>

<?php include('html/header.html.php'); ?>
		
		<!-- produkte form -->
		<section class="uk-section-default uk-padding uk-width">
			<h1>Produkt editieren</h1>
			<div class="uk-grid uk-grid-margin" uk-grid>
				<div class=" uk-width-1-1 uk-width-2-3@m">
					<form action="" method="POST" enc-type="multipart/form-data" class="uk-form-horizontal">
						<div>
							<label class="uk-form-label">Produktname</label>
							<div class="uk-form-controls uk-margin"><input type="text" name="produkt_name" value=""></div>
						</div>
						<div>
							<label class="uk-form-label">Bild</label>
							<div class="uk-form-controls uk-margin"><input type="file" name="produkt_bild" value=""></div>
						</div>
						<div>
							<label class="uk-form-label">Preis</label>
							<div class="uk-form-controls uk-margin"><input type="text" name="produkt_preis" value=""></div>
						</div>
						<div>
							<label class="uk-form-label"> </label>
							<div class="uk-form-controls uk-margin">
								<input type="submit" class="uk-button uk-button-primary" value="speichern">
								<a class="uk-button uk-button-default" href="produkte_liste.php">zurück</a>
							</div>
						</div>
					</form>
				</div>
				<div class=" uk-width-1-1 uk-width-1-3@m">
					
				</div>
			</div>
		</section>
		
		
<?php include('html/footer.html.php'); ?>