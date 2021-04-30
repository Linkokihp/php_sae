<?php
function notify_admin(){

	$empfaenger = 'terry@bytekultur.net'; // Konstante aus Konfiguration - ist auch in Funktion gültig
	$absender = 'noreply@bytekultur.net'; // Konstante aus Konfiguration - ist auch in Funktion gültig
	$betreff = 'Mail von deiner Seite training.bytekultur.net';
	$nachricht = 'Hallo Admin, es wurde ein neues Benutzerkonto erstellt';

	$nachricht = strip_tags($nachricht); // tags entfernen, falls vorhanden
	$nachricht = "\n\n".'---'; // neue Zeilen als Steuerzeichen immer in ""
	$nachricht = "\n".'Dein PHP Script'; 

	$headers = "From: mailer@bytekultur.net \n";
	$headers .= "Reply-To: <".$absender.">\n";
	$headers .=  "Content-Type: text/plain; charset='ISO-8859-1'";

	$mailsent = mail($empfaenger, $betreff, $nachricht, $headers);

	if($mailsent == true){
		echo 'Mail gesendet'; // nur zum testen, admin notification braucht keine bestätigung an den User.
	}
}


//TEST FOR GIT
?>
