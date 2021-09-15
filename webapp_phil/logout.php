<?php 
	session_start();
	unset($_SESSION['UserId']);
	session_destroy();
	header('location: index.php');
?>