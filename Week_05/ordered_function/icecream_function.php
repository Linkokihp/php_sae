<?php

// Array's mit den Zutaten
function iceCreamGenerator(){

	$icecream = array('Vanille', 'Chocolate', 'Cherry', 'Lemon', 'Strawberry');
    $sauce = array('Bratensauce', 'Hollandaise', 'Cocktail', 'Rahmsauce', 'Sweet&Sour');
    

    echo 'Icecream: ' . $icecream[rand(0, count($icecream)-1)] . ' ' . 'Sauce: '. $sauce[rand(0, count($sauce)-1)]; //Count makes this echo dynamic

    //echo count($icecream);
    //echo sizeof($icecream);
};

// Ausgabe beim Click auf den Button
if(array_key_exists('button', $_POST)) {
    iceCreamGenerator();
}

//rand ( int $min , int $max ) : int
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Icecream Gen</title>
</head>
<body>

    <h1>You don't know what Icecream you should get? Click me!</h1>
    <form method="post">
        <input type="submit" name="button
                class="button" value="Button" />
    </form>
    <p> <?php echo iceCreamGenerator();?></p>

</body>
</html>