<?php

    try{
        $bdd = new PDO("mysql:host=localhost; dbname=ninjatt", "root", "");
        // echo "Connected successfully";
    } catch( Exception $e) {
        die("ERROR : " .$e->getMessage());
    }
    
?>