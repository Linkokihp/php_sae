<?php
$feedback = "";
$goon = true;
function validateStrLength($str, $field, $min, $max) {
	global $feedback;
	global $goon;
	// Notieren Sie hier ihre Funktion
	if(strlen($str) < $min){
		$feedback = "Das Feld &quot;" . $field . "&quot; muss mehr als " . $min . " Zeichen haben!";
		// Mit dieser Variablen zeigen Sie an, ob alles in Ordnung ist. Nur wenn sie auf true gesetzt wird, geht es weiter (s.u.)
		$goon = false;
	}
	else if(strlen($str) > $max){
		$feedback = "Das Feld &quot;" . $field . "&quot; darf maximal " . $max . " Zeichen haben!";
		$goon = false;	
	}
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8" />
	<title>Stringlänge validieren (Required fields) - Übung für Chuck-Norris-Fans</title>
	<link rel="stylesheet" href="../generalstyles.css">
</head>
<body>
	<h2 class="orange">Stringlänge validieren (Required fields) - Übung für Chuck-Norris-Fans</h2>
	<p><img src="../img/chuck_norris.gif" width="250" height="170" alt="chuck_norris"></p>
	<ul class="explanation"> 
		<li>Auf dieser Seite hat es nun zwei Felder, die es zu überprüfen gilt</li>
		<li><strong>Aufgabe:</strong> Schreibe eine Funktion, die für die Validierung von <strong>beiden</strong> Eingaben verwendet werden kann.</li>
		<li>Zusätzlich soll es möglich sein, eine Minimal- und Maximalzahl für die Länge des Eingabe-Strings zu definieren.</li>
		<li>Der User soll bei nicht erfolgreicher Validation wissen, was sein Fehler war (Ausgabe eines Feedbacks).</li>
		<li>Ich habe den Code schon etwas vorbereitet ...</li>
		<li>Eine mögliche Lösung findest du auf der nächsten Seite.</li>
	</ul>

<?php
// Checke, ob der Submit-Button geklickt wurde
if (isset($_POST['go'])) {
	// Desinfektion der Eingaben
	$vornameValue = filter_var($_POST['vorname'], FILTER_SANITIZE_STRING);
	$nachnameValue = filter_var($_POST['nachname'], FILTER_SANITIZE_STRING);
	// Felder validieren (Funktionsaufruf)
	validateStrLength($vornameValue,"Vorname",3,30);
	validateStrLength($nachnameValue,"Nachname",2,40);
	
	// Sind die Eingaben gültig (die Überprüfung soll in der Funktion erfolgen)? 
	if ($goon) {
		// ja
		echo "<div class=\"feedback_positiv\">";
		echo "Vielen Dank für Ihre Angaben, ihre Namen sind gültig.";
		echo "</div>\n";
	}
	else {
		// nein
  		echo "<div class=\"feedback_negativ\">";
		echo $feedback;
		echo "</div>\n";
	}
}
else {
	$vornameValue = "";
	$nachnameValue = "";
}
?>
	<form action="" method="post">
		<div>
			<label for="vorname">Vorname</label>
			<input type="text" id="vorname" name="vorname" value="<?=$vornameValue?>">
		</div>
		<div>
			<label for="nachname">Nachname</label>
			<input type="text" id="nachname" name="nachname" value="<?=$nachnameValue?>">
		</div>
		<button type="submit" name="go">Validate!</button>
	</form>
	<footer>
		<a href="../index.html">&lt; Home</a>
	</footer>
</body>
</html>