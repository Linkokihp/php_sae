<?php
/*
- Beachte die Kommentare in der Klassendatei
*/
require("class/QuadratZahl2.class.php");
$instanz = new QuadratZahl2();
/* 
- Hier wird auf Eigenschaft "von aussen" gelesen
*/
$ausgabe = $instanz -> AntwortSatz;
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8" />
	<title>Einfache Klassen: Beispiel 4</title>
</head>
<body>
<?php
echo $ausgabe;
?>
</body>
</html>
