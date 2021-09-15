<?php

    try{
        $bdd = new PDO("mysql:host=localhost; dbname=ninjatt", "root", "");
        // echo "Connected successfully";
    } catch( Exception $e) {
        die("ERROR : " .$e->getMessage());
    }


    define ('ROOT_PATH', 'C:\xamppp\htdocs\php_sae\webapp_phil');
	define('BASE_URL', 'http://localhost/php_sae/webapp_phil');
    
?>