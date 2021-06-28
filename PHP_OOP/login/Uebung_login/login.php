<?php
require_once("config.php");
session_start(); 

if(isset($_POST['submit'])){
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	
	$sql = "SELECT * FROM users WHERE email = '".$email."'";
	$rs = mysqli_query($conn,$sql);
	$numRows = mysqli_num_rows($rs);
	
	if($numRows  == 1){
		$row = mysqli_fetch_assoc($rs);
		if(password_verify($password,$row['password'])){
			echo "Password verified";
			$_SESSION['isloggedin'] = true;
			$_SESSION['login_timestamp'] = time();
			header('location: ../admin/user.php');
		}
		else{
			echo "Wrong Password";
		}
	}
	else{
		echo "No User found";
	}
};
?>

<div class="container">
	<h1>Login</h1>

	<form action="login.php" method="post">
		<input type="text" name="email" value="" placeholder="Email">
		<input type="password" name="password" value="" placeholder="Password">
		<button type="submit" name="submit">Submit</submit>
	</form>
</div>
