<?php
require("class/ValidateForm.class.php");
$instanz = new ValidateForm();
// Checke, ob der Submit-Button geklickt wurde
if (isset($_POST['go'])) {
	/* Parameter
		POST-Var (Usereingabe)
		Ist es ein obligatorisches Feld (true oder false)
		Name des Feldes in der Ausgabe des Feedbacks
		Was soll validiert werden (mehrere Werte abgetrennt mit |)?
		String für die Ausgabe des Feedbacks
	*/
	$vornameValue = $instanz -> validateElement($_POST['vorname'],true,"Vorname","min_length-3|max_length-10","Die Eingabe muss zwischen 3 und 10 Zeichen sein.");
	$nachnameValue =  $instanz -> validateElement($_POST['nachname'],true,"Nachname","min_length-3|max_length-10","Die Eingabe muss zwischen 3 und 10 Zeichen sein.");
	$strasseValue = $instanz -> validateElement($_POST['strasse'],false,"Strasse","min_length-3","Die Eingabe muss mindestens 3 Zeichen sein.");
	$emailValue =  $instanz -> validateElement($_POST['email'],true,"E-Mail Adresse","email","ist keine gültige E-Mail Adresse");
	$plzValue =  $instanz -> validateElement($_POST['plz'],true,"PLZ","plz","Ist keine gültige Postleitzahl");
	$ortValue =  $instanz -> validateElement($_POST['ort'],true,"Ort","min_length-3|max_length-10","Die Eingabe muss zwischen 3 und 10 Zeichen sein.");
	if ($instanz -> validationState) {
		// ja
		$ausgabe = "<div class=\"feedback_positiv\">";
		$ausgabe .= "Alle Formularfelder sind in Ordnung.";
		$ausgabe .=  "</div>\n";
	}
	else {
		// nein
  		$ausgabe = "<div class=\"feedback_negativ\">";
		foreach ($instanz -> feedbackArray as $out) {
			$ausgabe .=  $out."<br>";
		}
		$ausgabe .= "</div>\n";
	}
}
else {
	$ausgabe = "";
	$vornameValue = "";
	$strasseValue = "";
	$nachnameValue = "";
	$emailValue = "";
	$plzValue = "";
	$ortValue = "";
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8" />
	<title>Formular-Validierung mit OOP</title>
	<link rel="stylesheet" href="../../generalstyles.css">
</head>
<body>
	<h2>Formular-Validierung mit OOP</h2>
	<hr>
	<ul class="explanation">
		<li>In der vierten Kammer (oranger Gurt) des Shaolin Kung-Fu für Web-Applikationen ging es um die Formular-Validierung.</li>
		<li>Dort wurden einzelne Aspekte getrennt auf einzelnen Seiten behandelt. Dies wollen wir jetzt zusammenziehen und den Code in einer Klasse notieren.</li>
		<li>Damit wird dir hoffentlich ein bisschen klarer, was der Vorteil des Einsatzes von OOP sein kann.</li>
		<li>Versuche, dich mit dem Code der Klasse vertraut zu machen. Versuche auch zu verstehen, wie das Formular dieser Seite mit dem Objekt kommuniziert, bzw. wie die User-Eingaben den Weg zu den Methoden finden.</li>
		<li>Erweitere die Funktionalität: Ergänze das Formular um ein Element und füge der Klasse die Überprüfung eines Passworts (mit Regex) hinzu. Dafür sind mehrere Schritte notwendig.</li>
	</ul>
<?php
echo $ausgabe;
?>
	<form action="formular_validierung.php" method="post" novalidate>
		<h3>Registrationsformular</h3>
		<div>
			<label for="vorname">Vorname*</label>
			<input type="text" id="vorname" name="vorname" value="<?=$vornameValue?>">
			<label for="nachname">Nachname*</label>
			<input type="text" id="nachname" name="nachname" value="<?=$nachnameValue?>">
		</div>
		<div>
			<label for="strasse">Strasse</label>
			<input type="text" id="strasse" name="strasse" novalidate value="<?=$strasseValue?>">
		</div>
		<div>
			<label for="email">E-Mail Adresse*</label>
			<input type="email" id="email" name="email" novalidate value="<?=$emailValue?>">
		</div>
		<div>
		<label for="plz">PLZ*</label>
			<input type="text" id="plz" name="plz" value="<?=$plzValue?>">
		</div>
		<div>
		<label for="ort">ORT*</label>
			<input type="text" id="ort" name="ort" value="<?=$ortValue?>">
		</div>
		<button type="submit" name="go">Validate!</button>
	</form>
	<footer>
		<a href="../../index_2.html">&lt; Home</a>
	</footer>
</body>
</html>
