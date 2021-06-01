<?php 
/* AUFGABE: 
 * 1. schaut euch die SQL Befehle an - woher kommen die Daten?
 * 2. entscheidet in der Gruppe, Prepared Statement ja oder nein, und begründet, warum/warum nicht
 * 3. Haltet die Entscheidung und Begründung als Kommentar im Script fest (bei jedem Statement)
 * 4. wenn ihr möchtet und Zeit habt, schreibt den Code zu einem prepared Statement um.
 */
require_once('mysqli-connect.php');


 
// Es wird eine neue Bestellung nach Absenden des Bestellformulars generiert (Shop Frontend)
// Prepared Statement?  ..........
// Warum? 				..........
$query = "INSERT INTO `bestellung` 
(`IDbestellung`, `bestellung_datum`, `bestellung_lieferdatum`, `bestellung_lieferzeit`, `kunde_IDkunde`) 
VALUES (NULL, '2021-05-17 10:52:30', '2021-05-28', '16:30:00', '1')";

$res = mysqli_query($connection, $query);
$bestellungID = mysqli_insert_id($res);
echo 'neue Bestellung hat die ID: '.$bestellungID; // test



// Produkt mit ID 2 wird der Bestellung hinzugefügt
// Prepared Statement?  ..........
// Warum? 				..........
$query = "INSERT INTO `bestellung_has_produkt` 
(`bestellung_IDbestellung`, `produkt_IDprodukt`) 
VALUES ('".$bestellungID."', '2')";

$res = mysqli_query($connection, $query);
if($res == true){
	echo 'Produkt wurde der Bestellung hinzugefügt';
}

?>