<?php
// Desinfektion der Eingabe
$regexValue = filter_var($_POST['regex'], FILTER_SANITIZE_STRING);
// Setze hier deinen Code ein:
if ($regexValue) {
	// ja
	$check = true;
	}
else {
	// nein
	$check = false;
}
header('Content-Type: application/json');
echo json_encode($check);
?>