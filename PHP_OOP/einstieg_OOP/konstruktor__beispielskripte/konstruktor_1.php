<?php
require("class/Konstruktiv.class.php");
/*
- Die Konstruktormethode wird beim Instanziieren automatisch abgearbeitet
- Sie wird also nicht explizit aufgerufen
*/
$instanz = new Konstruktiv();


?>
<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8" />
	<title>Die Konstruktormethode: Beispiel 1</title>
</head>
<body>
<?php
echo $instanz -> ausgabe;
?>
</body>
</html>
