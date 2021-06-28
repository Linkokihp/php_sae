<?php

require_once('includes/config.php'); // alle Konstanten für das Projekt
require_once('includes/functions.php'); // funktionen für das Projekt
require_once('includes/sessioncheck.php'); // Sessioncheck zum schutz des Admintools vor unerlaubtem Zugriff

?>

<?php include('html/header.html.php'); ?>


		
		<!-- produkte liste -->
		<section class="uk-section-default uk-padding uk-width">
			<h1>Newsblog verwalten</h1>
			<div class="uk-grid uk-grid-margin" uk-grid>
				<div class=" uk-width-1-1 uk-width-2-3@m">
					<a class="uk-button uk-button-primary" href="news_edit.php">Neuer Blogeintrag</a>
					<table class="uk-table uk-table-divider uk-table-striped">
						<tr>
							<th>ID</th>
							<th>Bild</th>
							<th>Name</th>
							<th>Erstellungsdatum</th>
							<th></th>
							<th></th>
						</tr>
						<tr>
							<td>23</td>
							<td><img src="../images/content/_thumbnails/titelbild_lemon.jpg" style="width:120px;"></td>
							<td>Der Sommer kommt!</td>
							<td>2021-05-10 08:33:25</td>
							<td><a class="uk-button uk-button-default uk-button-small" href="news_edit.php">bearbeiten</a></td>
							<td><a class="uk-button uk-button-default uk-button-small" href="news_liste.php">löschen</a></td>
						</tr>
						
						<tr>
							<td>22</td>
							<td><img src="../images/content/_thumbnails/titelbild_easter-cupcakes.jpg" style="width:120px;"></td>
							<td>Schon was vor zu Ostern?</td>
							<td>2021-04-11 22:12:59</td>
							<td><a class="uk-button uk-button-default uk-button-small" href="news_edit.php">bearbeiten</a></td>
							<td><a class="uk-button uk-button-default uk-button-small" href="news_liste.php">löschen</a></td>
						</tr>
						
						<tr>
							<td>21</td>
							<td><img src="../images/content/_thumbnails/titelbild.jpg" style="width:120px;"></td>
							<td>Party vergessen?</td>
							<td>2021-05-10 08:33:25</td>
							<td><a class="uk-button uk-button-default uk-button-small" href="news_edit.php">bearbeiten</a></td>
							<td><a class="uk-button uk-button-default uk-button-small" href="news_liste.php">löschen</a></td>
						</tr>
						
					</table>
				</div>
				<div class=" uk-width-1-1 uk-width-1-3@m">
					
				</div>
			</div>
		</section>
		
<?php include('html/footer.html.php'); ?>