<?php
    session_start();
    include 'classes.php';
    $char = new user();
    $char->setUserName($_SESSION['UserName']);
    $char->displayCharacter();
?>