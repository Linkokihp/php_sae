<?php

include_once("../include/funciones.php");
include_once("../usuarios/objeto_usuario.php");
select_lang();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if(!isset($_POST['nick']) || $_POST['nick']=="") //Si no introduce el nick
die(getString('login_nonick'));
else
$user = $_POST['nick'];

if(!isset($_POST['pass']) || $_POST['pass']=="") //Si no introduce la pass
die(getString('login_nopass'));
else
$pass = md5($_POST['pass']);

$consulta = sql("SELECT email FROM players WHERE email='$user'");

if($consulta==false)//El usuario no esta en la BD
    die(getString('login_nomatch'));
else
    $consulta = false;
    //$consulta = checkban($consulta['id_usuario']);
    //TBD: Arreglar el checkban
    
if($consulta == true ) //Si esta ban    
    die(getString('login_banned'));
else
    $consulta = sql("SELECT id FROM players WHERE email='$user' AND pass='$pass'");

if($consulta==false)//No concuerdan user y pass
    die(getString('login_nomatch2'));
else
{
    $_SESSION['id_usuario'] = $consulta;
	$_SESSION['obj_usuario'] = new usuario($consulta);
    //Se pone la zona horaria bien
    date_default_timezone_set('Europe/Madrid');
    $hora = date("H:i:s"); 
    $dia = date("Y.n.j");
    $ip = $_SERVER['REMOTE_ADDR'];
    $navegador = $_SERVER['HTTP_USER_AGENT'];    

    echo "<a href=\"/desnortado/\">login correcto<br>vuelve atras</a>";

}
    
?>