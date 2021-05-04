<?php

//Connect to Database
$databaseHost = 'localhost';
$databaseName = 'crud_db';
$databaseUsername = 'root';
$databasePassword = '';

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);


//Create
INSERT INTO `produkt` (`produkt_name`, `produkt_bild`, `produkt_preis`)
VALUES ('Superschoggi', 'super-schoggi.png', '6.10');

//Read
SELECT * FROM produkt;

//Update
UPDATE `produkt`
SET `produkt_name` = 'Neu: Superschoggi',
    `produkt_bild` = 'Neu: super-schoggi.png',
    `produkt_preis` = 'Neu: 6.10'
WHERE `IDprodukt` = 3;

//Delete
DELETE FROM `produkt`
WHERE `IDprodukt` = 3;


//----------------------------------------------------------------

//JOIN
SELECT * FROM `kunde` AS k
LEFT JOIN `adresse` AS a 
ON k.IDkunde = a.`kunde_IDkunde`;


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL CRUD Queries</title>
</head>
<body>
    
</body>
</html>