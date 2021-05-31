<?php
$host = "localhost"; /* Host name */
$user = "rene"; /* User */
$password = "espo07"; /* Password */
$dbname = "kungfu"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}