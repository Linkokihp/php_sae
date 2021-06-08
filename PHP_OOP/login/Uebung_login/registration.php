<?php 
require_once("config.php");
if(isset($_POST['submit'])){
		$firstName = $_POST['first_name'];
		$surName = $_POST['surname'];
		$email 	= $_POST['email'];
		$password = $_POST['password'];
		
		$options = array("cost"=>4);
		$hashPassword = password_hash($password,PASSWORD_DEFAULT);
		
		$sql = "INSERT INTO users (first_name, last_name, email, password) VALUES('".$firstName."', '".$surName."', '".$email."','".$hashPassword."')";
		$result = mysqli_query($conn, $sql);
		if($result)
		{
			echo "Registration successfully";
		}
	}
?>

<div class="container">
	<h1>Registration</h1>

	<form action="registration.php" method="post">
		<input type="text" name="first_name" value="" placeholder="First Name">
		<input type="text" name="surname" value="" placeholder="Surname">
		<input type="text" name="email" value="" placeholder="Email">
		<input type="password" name="password" value="" placeholder="Password">
		<button type="submit" name="submit">Submit</submit>
	</form>
</div>
