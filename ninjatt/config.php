<?php
    session_start();

    try{
        $bdd = new PDO("mysql:host=localhost; dbname=ninjatt", "root", "");
        // echo "Connected successfully";
    } catch( Exception $e) {
        die("ERROR : " .$e->getMessage());
    }


    define ('ROOT_PATH', 'C:\xamppp\htdocs\php_sae\ninjatt');
	define('BASE_URL', 'http://localhost/php_sae/ninjatt');
    
?>