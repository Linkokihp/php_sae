<?php

require_once('includes/config.php'); // alle Konstanten für das Projekt
require_once('includes/functions.php'); // funktionen für das Projekt
require_once('includes/sessioncheck.php'); // Sessioncheck zum schutz des Admintools vor unerlaubtem Zugriff

?>

<?php include('html/header.html.php'); ?>


		
		<!-- produkte liste -->
		<section class="uk-section-default uk-padding uk-width">
			<h1>Produkte verwalten</h1>
			<div class="uk-grid uk-grid-margin" uk-grid>
				<div class=" uk-width-1-1 uk-width-2-3@m">
					<a class="uk-button uk-button-primary" href="produkte_edit.php">Neues Produkt</a>
					<table class="uk-table uk-table-divider uk-table-striped">
						<tr>
							<th>ID</th>
							<th>Bild</th>
							<th>Name</th>
							<th>Preis</th>
							<th></th>
							<th></th>
						</tr>
						<tr>
							<td>1</td>
							<td><img src="../bilder/cupcake-erdbeer.png" style="width:40px;" /></td>
							<td>Erdbeer</td>
							<td>5.50</td>
							<td><a class="uk-button uk-button-default uk-button-small" href="produkte_edit.php">bearbeiten</a></td>
							<td><a class="uk-button uk-button-default uk-button-small" href="produkte_liste.php">löschen</a></td>
						</tr>
						<tr>
							<td>2</td>
							<td><img src="../bilder/cupcake-himbeer.png" style="width:40px;" /></td>
							<td>Himbeere</td>
							<td>6.50</td>
							<td><a class="uk-button uk-button-default uk-button-small" href="produkte_edit.php">bearbeiten</a></td>
							<td><a class="uk-button uk-button-default uk-button-small" href="produkte_liste.php">löschen</a></td>
						</tr>
					</table>
				</div>
				<div class=" uk-width-1-1 uk-width-1-3@m">
					
				</div>
			</div>
		</section>
		
<?php include('html/footer.html.php'); ?>