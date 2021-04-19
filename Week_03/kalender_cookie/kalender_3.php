<?php
/* Achtung: GET und POST enthalten nicht immer Werte! Nur wenn wir diese geschickt haben! */

// standardwert setzen, falls keine übermittelte Sprache vorhanden (Formular nicht abgeschickt, zum Beispiel) - so können wir voraussetzen, dass IMMER eine Variable existiert, die wir prüfen können
$sprache = 'de'; 

// wurde eine Sprache übermittelt, wird die Variable mit dem übermittelten Wert überschrieben
if( isset( $_GET['sprache'] )){
	$sprache = $_GET['sprache']; 
}

// Set Locale je nach Wert von $sprache ausführen - switch ist eine Alternative zu IF/ELSE, die hier zum gleichen Resultat führt, aber etwas übersichtilcher wirkt
switch( $sprache ){
	case 'de': // müsste eigentlich nicht abgehandelt werden, da Standard...
	setlocale(LC_ALL, 'deu_deu', 'de', 'de_DE');
	break;
	
	case 'en':
	setlocale(LC_ALL, 'eng_eng', 'en', 'en_GB');
	break;
	
	case 'fr':
	setlocale(LC_ALL, 'fra_fra', 'fr', 'fr_FR');
	break;
	
	case 'it':
	setlocale(LC_ALL, 'ita_ita', 'it', 'it_IT');
	break;
}

$_SESSION['testsession']['sprache'] = 'de';
$_SESSION['testsession']['timestamp'] = time();

$cookieDuration = 10; // sekunden, die das Cookie bestehen bleibt
setcookie('testcookie', 'Kalender Test!', time()+$cookieDuration, '/');

echo '<pre>SESSION Array: ';
print_r($_SESSION);
echo '</pre>';

echo '<pre>COOKIE Array: ';
print_r($_COOKIE);
echo '</pre>';
?>
<html>
<head>
	<title>MINI KALENDER</title>
	<meta charset="UTF-8">
</head>
<body>

<h3 style="color:#999999;">MINI KALENDER</h3>

<div style="border:1px solid black;border-top:5px solid #000000; width:200px; height:250px;text-align:center;">
	<h2><?php echo strftime("%A"); ?></h2>
	<form method="GET">
		<!-- onchange ersetzt hier den Submit button -->
		<select name="sprache" onchange="submit()">
			<option value="de">Deutsch</option>
			<option value="en">English</option>
			<option value="fr">Francais</option>
			<option value="it">Italiano</option>
		</select>
	</form>
	
	<span style="font-size:100px;font-weight:bold;">4</span>
	<h2><?php echo utf8_encode( strftime("%B %Y") ); ?></h2>
</div>

</body>
</html>
