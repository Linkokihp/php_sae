<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8" />
	<title>POST-Vars ausgeben (in der Beta-Phase)</title>
	<link rel="stylesheet" href="../generalstyles.css">
</head>
<body>
	<h2 class="gelborange">POST-Vars ausgeben (sinnvoll in der Beta-Phase)</h2>
	<ul class="explanation">
		<li>In der Entwicklungs-Phase macht es Sinn, die POST-Variablen als Ganzes mit <code>print_r($_POST)</code> auszugeben.</li>
		<li><strong>Aufgabe:</strong> Füge hier weitere Formular-Elemente hinzu, insbesondere Checkboxen und Radio-Buttons!<br>
		Wenn keine User-Eingabe erfolgt und das Formular trotzdem abgeschickt wird: <strong>Welche Elemente werden von PHP erfasst, welche nicht?</strong> Fülle die untenstehende &quot;Fallen-Box&quot; mit deinem Fazit aus!</li>
		<li>Leider bleiben die User-Eingaben im Formular noch nicht erhalten, dies wird im nächsten Schritt dieser Übungssequenz behandelt.</li>
	</ul>
	<div class="falle">
		<p><strong>Vorsicht Falle:</strong> ...</p>
	</div>
<?php
// Checke, ob der Submit-Button geklickt wurde
if (isset($_POST['go'])) {
	// ja
	echo "<div class=\"feedback_positiv\">";
	echo "<p>Das Formular wurde verschickt.</p>";
	echo "<p>PHP kennt jetzt die folgenden Variablen (bzw. Array):</p>";
	echo "<pre>";
	print_r($_POST); //Zum Entwickeln POST-Variable ausgeben
	echo "</pre>";
	echo "</div>\n";
}
else {
	// nein
	echo "<div class=\"feedback_negativ\">";
	echo "Das Formular wurde noch nicht verschickt. Klicke den Submit-Button!";
	echo "</div>\n";
}
?>

	<form action="post_vars_ausgeben.php" method="post">
		<div>
			<label for="vorname">Vorname</label>
			<input type="text" id="vorname" name="vorname">
		</div>
		<div>
			<label for="passwort">Passwort</label>
			<input type="password" id="passwort" name="passwort">
		</div>
		<div>
			<label for="bemerkungen">Bemerkungen</label>
			<!-- Hier wäre es eigentlich besser und exakter, die Breite mit CSS zu formatieren -->
			<textarea id="bemerkungen" name="bemerkungen" cols="50" rows="6"></textarea>
		</div>
			<input type="radio" id="herr" name="anrede" value="Herr">
			<label for="herr">Herr</label>
			<br>
			<input type="radio" id="frau" name="anrede" value="Frau">
			<label for="frau">Frau</label>
			<br>
			<input type="radio" id="andere" name="anrede" value="Andere">
			<label for="andere">Andere</label>
		</div>
		<div>
			<input type="checkbox" id="surfen" name="surfen" value="Surfen">
			<label for="surfen">Surfen</label>
			<br>
			<input type="checkbox" id="rudern" name="rudern" value="Rudern">
			<label for="rudern">Rudern</label>
			<br>
			<input type="checkbox" id="segeln" name="segeln" value="Segeln">
			<label for="segeln">Segeln</label>
		</div>
		<button type="submit" name="go">Formular verschicken</button>
	</form>
	<footer>
		<a href="../index.html">&lt; Home</a>
	</footer>
</body>
</html>
