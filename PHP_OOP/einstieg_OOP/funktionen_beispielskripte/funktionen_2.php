<?php
/*
- Die Funktionsdefinition ist losgelöst von der HTML-Struktur, sie steht ganz oben im Dokument
- Die Funktion arbeitet nicht mehr mit echos, sondern mit einem return
- Die Funktion ist  wiederverwendbar für das Berechnen beliebige Quadrat-Zahlen, 
denn sie wartet auf einen Parameter zum Verarbeiten
*/

function quadrat_zahl($anna) {
	$resultat = $anna * $anna;
	return $resultat;
}

$ausgabe = quadrat_zahl(2);
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8" />
	<title>Funktionen: Beispiel 2</title>
</head>
<body>
<?php
echo $ausgabe;
?>
</body>
</html>
