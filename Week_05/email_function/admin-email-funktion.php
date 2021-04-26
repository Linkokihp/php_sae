<?php
// Konfiguration: 
define('SYSTEM_ABSENDER', 'noreply@bytekultur.net');
define('ADMIN_EMPFAENGER', 'terry@bytekultur.net');


// Funktionsdefinition inkl Kommentar nach Doxygen / PHPDoc Konvention
/*
 * notify_admin sendet ein Plain-Text E-Mail an den Admin mit Betreff und Inhalt
 * @param string $betreff - der Betreff der E-Mail
 * @param string $nachricht - der Betreff der E-Mail (im Plaintext (kein HTML!)
 * @return bool $mailsent - true, wen die Mail verschickt wurde, oder false, wenn nicht
 */
function notify_admin( $betreff, $nachricht ){
	
	$nachricht = strip_tags($nachricht); // tags entfernen, falls vorhanden
	$nachricht .= "\n\n".'---'; // neue Zeilen als Steuerzeichen immer in ""
	$nachricht .= "\n".'Dein PHP Script'; 

	$headers = "From: ".SYSTEM_ABSENDER." \n";
	$headers .= "Reply-To: <".SYSTEM_ABSENDER.">\n";
	$headers .=  "Content-Type: text/plain; charset='ISO-8859-1'";
	
	// echo $nachricht;
	$mailsent = mail(ADMIN_EMPFAENGER, $betreff, $nachricht, $headers);

	return $mailsent;
}



// aufrufen meiner eigenen Funktion
$betreff = 'Mail von deiner Seite training.bytekultur.net';
$nachricht = 'Hallo Admin, es wurde ein neues Benutzerkonto erstellt';

$mailok = notify_admin( $betreff, $nachricht );
?>
<html>
<head>
</head>
<body>
Mailtestscript

<br>
<?php
if($mailok == true){
	echo 'Mail gesendet'; // nur zum testen, admin notification braucht keine bestätigung an den User.
}
?>
</body>
</html>