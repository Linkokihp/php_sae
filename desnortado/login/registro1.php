<?php
include("../include/funciones.php");
if(!isset($_POST['username']) || $_POST['username']=="")
die(getString('no_user'));
else
$user = $_POST['username'];
if(!isset($_POST['password1']) || $_POST['password1']=="")
die(getString('no_password'));
else
$pass1 = $_POST['password1'];
if(!isset($_POST['password2']) || $_POST['password2']=="")
die(getString('no_re_password'));
else
$pass2 = $_POST['password2'];
if(!isset($_POST['email']) || $_POST['email']=="")
die(getString('no_mail'));
else
$email = $_POST['email'];
if($pass1 != $pass2)
    die(getString('no_re_password'));
$verificar = sql("SELECT nick FROM players_game WHERE nick='$user'");
if($verificar==true)
    die(getString('user_again'));
$verificar = sql("SELECT email FROM players WHERE email='$email'");
if($verificar==true)
    die(getString('mail_again'));
$pass = md5($pass1);

$hoy = date("Y.n.j");
sql("INSERT INTO players(pass,email) VALUES ('$pass','$email')");//A�adir a la tabla de usuarios
$mi_id=sql("SELECT id FROM players WHERE email='$email'");
sql("INSERT INTO players_game(id,nick) VALUES ('".$mi_id."','".$user."')");//A�adir a la tabla de jugadores

//Registrar usuario al foro <-ULTIMO PASO BD->
anadir_foro($user,$pass1,$email);
anadir_bugs($user, $pass1, $email);
//Se envia el mail de bienvenida
mail_bienvenida($user, $email);
//Muestra mensaje de fin de registro OK
die(getString('ok'))
?>