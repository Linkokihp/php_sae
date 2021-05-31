<?php
// Notiere hier deine Funktion
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8" />
	<title>Hacken verhindern 3: Eine Funktion zum Desinfizieren</title>
	<link rel="stylesheet" href="../generalstyles.css">
</head>
<body>
	<h2 class="gelborange">Hacken verhindern 3: Eine Funktion zum Desinfizieren der Usereingaben</h2>
	<ul class="explanation">
		<li><strong>Hinweis:</strong> Der Inhalt dieser Seite entspricht im Wesentlichen der Seite &quot;Usereingaben erhalten&quot;.</li>
		<li><strong>Aufgabe:</strong> Füge eine Funktion hinzu, die alle Usereingaben &quot;desinfiziert&quot;, bevor diese weiter verarbeitet werden (vergl. letzte Seite).</li>
		<li>Die Funktion soll zusätzlich mit <a href="http://php.net/manual/de/function.trim.php" target="_blank"><code>trim()</code></a> die Eingabe &quot;putzen&quot;. Dies ist aus verschiedenen Gründen extrem sinnvoll.</li>
	</ul>
<?php
// Checke, ob der Submit-Button geklickt wurde
if (isset($_POST['go'])) {
	// ja
	echo "<div class=\"feedback_positiv\">";
	echo "Das Formular wurde verschickt";
	echo "</div>\n";
	// Füge hier deine Funktionsaufrufe hinzu
	$vornameValue = $_POST['vorname'];
	$nachnameValue = $_POST['nachname'];
	$bemerkungenValue = $_POST['bemerkungen'];
}
else {
	// nein, setzte die Variablen leer, damit beim ersten Affenschwanz-Durchgang kein Fehler generiert wird
	$vornameValue = "";
	$nachnameValue = "";
	$bemerkungenValue = "";
}
?>

	<form action="hacken_verhindern_3.php" method="post">
		<div>
			<label for="vorname">Vorname</label>
			<input type="text" id="vorname" name="vorname" value="<?=$vornameValue?>">
		</div>
		<div>
			<label for="nachname">Nachname</label>
			<input type="text" id="nachname" name="nachname" value="<?=$nachnameValue?>">
		</div>
		<div>
			<label for="bemerkungen">Bemerkungen</label>
			<textarea id="bemerkungen" name="bemerkungen" cols="50" rows="6"><?=$bemerkungenValue?></textarea>
		</div>
		<button type="submit" name="go">Formular verschicken</button>
	</form>
	<footer>
		<a href="../index.html">&lt; Home</a>
	</footer>
</body>
</html>
