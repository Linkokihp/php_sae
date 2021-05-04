<?php

//verbinden mit dem SQL Server--
$server = 'localhost'; // in der Regel localhost ausser der Server liegt nicht da wo PHP Script
$dbuser = 'root';
$dbpasswort = '';
$dbname = 'cupcake_shop';

$connection = mysqli_connect($server, $dbuser, $dbpasswort, $dbname) OR die('DB-Verbindung fehlgeschlagen'); //Values in dieser Reihenfolge einfügen
//Verbindung muss einmalig aufgebaut werden!!

//Check connection
//echo 'Ready for db queries'
//Befehl senden--
$query = 'SELECT * FROM `produkt`';
$res = mysqli_query($connection, $query);

if($res == false) {
    $errormsg =  'Abfrage fehlgeschlagen';
};

$daten = mysqli_fetch_all($res, MYSQLI_ASSOC);


//Daten verarbeiten--
echo '<pre>';
print_r($daten);
echo '</pre>';
?>

<table border='1'>
<?php foreach($daten as $datensatz){ ?>
<tr>
    <td><?php echo $datensatz['produkt_name'] ?></td>
    <td><?php echo $datensatz['produkt_preis'] ?></td>
    <td><a href="mysql.php?action=delete&id=<?php echo $datensatz['IDprodukt']?>"">Löschen</a></td>
</tr>

<?php } ?>
</table>