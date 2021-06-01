<?php

require_once('includes/config.php'); // alle Konstanten für das Projekt
require_once('includes/functions.php'); // funktionen für das Projekt
require_once('includes/sessioncheck.php'); // Sessioncheck zum schutz des Admintools vor unerlaubtem Zugriff

?>

<?php include('html/header.html.php'); ?>
		
		<!-- produkte form -->
		<section class="uk-section-default uk-padding uk-width">
			<h1>Blogeintrag editieren</h1>
			<div class="uk-grid uk-grid-margin" uk-grid>
				<div class=" uk-width-1-1 uk-width-2-3@m">
					<form action="" method="POST" enc-type="multipart/form-data" class="uk-form-horizontal">
						<div>
							<label class="uk-form-label">Titel</label>
							<div class="uk-form-controls uk-margin"><input type="text" name="news_titel" value=""></div>
						</div>
						<div>
							<label class="uk-form-label">Status</label>
							<div class="uk-form-controls uk-margin">
								<select>
									<option value="0">Versteckt</option>
									<option value="1">Veröffentlicht</option>
									<option value="-1">Gelöscht (Papierkorb)</option>
								</select>
							</div>
						</div>
						<div>
							<label class="uk-form-label">Bild</label>
							<div class="uk-form-controls uk-margin"><input type="file" name="news_bild" value=""></div>
						</div>
						<div>
							<label class="uk-form-label">Estellungsdatum</label>
							<div class="uk-form-controls uk-margin"><input type="text" name="news_erstellt" placeholder="<?php echo strftime("%Y-%m-%d %H:%M:%S"); ?>" value=""></div>
						</div>
						<div>
							<label class="uk-form-label">Short Text</label>
							<div class="uk-form-controls uk-margin"><textarea name="news_shorttext"></textarea></div>
						</div>
						<div>
							<label class="uk-form-label">Text</label>
							<div class="uk-form-controls uk-margin"><textarea name="news_text" rows="10"></textarea></div>
						</div>
						<div>
							<label class="uk-form-label"> </label>
							<div class="uk-form-controls uk-margin">
								<input type="submit" class="uk-button uk-button-primary" value="speichern">
								<a class="uk-button uk-button-default" href="news_liste.php">zurück</a>
							</div>
						</div>
					</form>
				</div>
				<div class=" uk-width-1-1 uk-width-1-3@m">
					
				</div>
			</div>
		</section>
		
		
<?php include('html/footer.html.php'); ?>