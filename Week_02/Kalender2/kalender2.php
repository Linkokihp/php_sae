<!DOCTYPE html>
<html lang="de">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php

//Variables
// setlocale(LC_ALL, 'de_DE@euro', 'de_DE', 'de', 'ge');
$weekday = strftime("%A");
$dayofmonth = strftime("%e");
$month = utf8_encode(strftime("%B"));
$year = strftime("%Y");

$lang = $_GET['lang'];

if(isset($lang)){
    switch ($lang) {
        case 'de':
            setlocale(LC_ALL, 'de_DE@euro', 'de_DE', 'de', 'ge');
            break;
        case 'en':
            setlocale(LC_ALL, "en_US");
            break;
        case 'fr':
            setlocale(LC_ALL, 'de_DE@euro', 'de_DE', 'de', 'ge');
            break;
    }
}
?>



<h3 style="color:#999999;">MINI KALENDER</h3>
<div style="border:1px solid black;border-top:5px solid #000000; width:200px; height:250px;text-align:center;">
	<h2><?php echo $weekday;?></h2>

	
	<span style="font-size:100px;font-weight:bold;"><?php echo $dayofmonth;?></span>
	
	<h2><?php echo "$month $year";?></h2>
</div>

<form method="get" action="kalender2.php">
  <select name="lang" type="submit" value="Submit the form">
    <option value="de">Deutsch</option>
    <option value="en">Englisch</option>
    <option value="fr">Französisch</option>
  </select>
  <input type="submit" value="Submit the form"/>
</form>



</body>
</html>