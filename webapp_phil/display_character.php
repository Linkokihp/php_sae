<?php
    session_start();
    include 'classes.php';
    $char = new user();
    $char->setUserName('admin');
    $char->displayCharacter();
?>