<?php 
    session_start();
	include "classes.php";
	$user = new user();
    $user->userLogout($_SESSION['UserMail']);

	unset($_SESSION['UserId']);
	session_destroy();
	header('location: index.php');
?>