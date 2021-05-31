<?php
// include der Klassendatei
require("class/QuadratZahl1.class.php");

/*
- Instanziierung
- in PHP-Tutorials wird manchmal auch der Begriff "Referenzierung" gewählt
*/
$instanz = new QuadratZahl1();

// Eine Methode wird aufgerufen, diese enstpricht im Wesentlichen der Funktion des letzten Teils
$ausgabe = $instanz -> rechne(5);
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8" />
	<title>Einfache Klassen: Beispiel 1</title>
</head>
<body>
<?php
echo $ausgabe;
?>
</body>
</html>
