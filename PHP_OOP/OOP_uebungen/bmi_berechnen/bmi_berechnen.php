<?php
// Gewicht in kg, diese Angaben sollen aus einem Formular kommen
$gewicht = 93;
// Grösse in m, auch diese Angaben sollen aus einem Formular kommen
$groesse = 1.87;

// Funktion für das Berechnen des BMI
function bmiBerechnen($anna, $berta) {
	$feedback = "";
	// Formel
	$ergebnis = $anna / ($berta * $berta);
	
	// Auswertung
	if ($ergebnis < 16) {
		$feedback = "Starkes Untergewicht";	
	}
	if ($ergebnis >= 16 && $ergebnis < 17) {
		$feedback = "Mässiges Untergewicht";
	}
	if ($ergebnis >= 17 && $ergebnis < 18.5) {
		$feedback = "Leichtes Untergewicht";	
	}
	if ($ergebnis >= 18.5 && $ergebnis < 25) {
		$feedback = "Normalgewicht";
	}
	if ($ergebnis >= 25 && $ergebnis < 30) {
		$feedback = "Präadipositas";
	}
	if ($ergebnis >= 30 && $ergebnis < 35 ) {
		$feedback = "Adipositas Grad I";
	}	
	if ($ergebnis >= 35 && $ergebnis < 40) {
		$feedback = "Adipositas Grad II";
	}
	if ($ergebnis >= 40) {
		$feedback = "Adipositas Grad III";	
	}
	return $feedback;
}

// Aufrufen der Funktion
$resultat = bmiBerechnen($gewicht, $groesse);
$ausgabe = "<div class=\"feedback_positiv\">\n";
$ausgabe .= "Auswertung Ihres BMI: <strong>".$resultat."</strong>";
$ausgabe .= "</div>\n";
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8" />
	<title>BMI berechnen</title>
	<link rel="stylesheet" href="../../generalstyles.css">
</head>
<body>
	<h2>BMI berechnen</h2>
	<p class="explanation"><img src="images/BMI.jpg" width="424" height="283" alt="BMI"></p>
	<ul class="explanation">
		<li>In diesem Dokument findest du eine einfache Funktion für die Berechnung des Body-Mass-Indexes. Allgemeine Informationen zum BMI sowie die Formel habe ich von hier: <a class="externer_link" href="http://de.wikipedia.org/wiki/Body-Mass-Index" target="_blank">de.wikipedia.org/wiki/Body-Mass-Index</a></li>
		<li>Die Funktion berechnet den BMI aus zwei Variablen, welche (vorläufig) oben im Dokument definiert, bzw. &quot;hart codiert&quot; worden sind. Dies werden wir zuerst ändern. Die Funktion soll nämlich <strong>mit Usereingaben arbeiten können</strong> und somit wiederverwertbar sein.</li>
		<li>Erstelle also ein Formular zum Eingeben des Gewichtes und der Körpergrösse.</li>
		<li>Hinweis: Die Usereingaben müssen <strong>nicht validiert werden</strong>, das gehört nicht zum Ziel der Übung.</li>
		<li>Wenn die Funktion wieder lauffähig ist, packst  den Code <strong>in eine Klasse </strong>und diese in eine Klassendatei.</li>
	</ul>
<?php
echo $ausgabe;
?>
<hr>
	<footer>
		<a href="../../index_2.html">&lt; Home</a>
	</footer>
</body>
</html>
