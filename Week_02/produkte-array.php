<?php



// $produkt = array(
//     'name'  => 'White Chocolate',
//     'bild'  => 'cupcake-white-choco.png',
//     'preis' => '5,90'
// );


// echo $produkt['name'];
// echo $produkt['bild'];
// echo $produkt['preis'];



//print_r gibt alle Ebenen eines Arrays aus (remember for debugging!)
//print_r($produkt);


$produkte = array (
    array('name'  => 'White Chocolate','bild'  => 'cupcake-white-choco.png','preis' => '5,90'),
    array('name'  => 'Erdbeer','bild'  => 'cupcake-erbeer.png','preis' => '6,50')
);

print_r($produkte[0]);
?>

