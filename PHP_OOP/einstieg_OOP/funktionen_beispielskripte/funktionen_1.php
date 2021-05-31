<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8" />
	<title>Funktionen: Beispiel 1</title>
</head>
<body>
<?php
/* 
- Die Funktionsdefinition steht im body
- Sie arbeitet mit echos
- Sie ist so nicht wiederverwendbar, es muss in die Funktion gecodet werden,
falls mit einer anderen Zahl gerechnet werden soll
*/

// Funktionsdefinition
function quadrat_zahl() {
	$zahl = 6;
	$resultat = $zahl * $zahl;
	echo $resultat;
}
// Funktionsaufruf
quadrat_zahl();
?>
</body>
</html>
