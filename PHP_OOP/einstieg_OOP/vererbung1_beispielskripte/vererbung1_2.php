<?php
require("class/Haustier.class.php");
require("class/Katze.class.php");
// Instanziiert wird hier nur die Subklasse.
// Trotzdem stehen darauf die Mitglieder der Superklasse im Objekt zur Verfügung.
// $instanz = new Katze();

// Eigenschaften schreiben, man beachte:
// diese gehören zur Instanz der Subklasse, obwohl sie in der Superklasse definiert wurden!!!
// $instanz -> geschlecht = "weiblich";
// $instanz -> name = "Kitty";
// $instanz -> art = "katze";

// Methode der Superklasse aufrufen, man beachte:
// diese gehört zur Instanz der Subklasse, obwohl sie in der Superklasse definiert wurde!!!
// $ausgabe1 = $instanz -> WasBinIch();

// Methode der Subklasse aufrufen
// $ausgabe2 = $instanz -> miauen();
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8" />
	<title>Vererbung Teil 1: Beispiel 2</title>
</head>
<body>
<h2>Die Katze ist ein Haustier, das miauen kann</h2>
<p>Notiere eine Subklasse für die Katze, die von Haustier erbt!</p>
<?php
// echo $ausgabe1;
echo "<br>";
// echo $ausgabe2;
?>
</body>
</html>
