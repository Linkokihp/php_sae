<?php
class Konstruktiv {

	public $ausgabe;

	// Konstruktormethode
	function __construct() {
		$string = "Ich wurde geboren am ";
		$string .= date("d.m.y")." um ";
		$string .= date("H:i:s");
		// Hier wird mit echo gearbeitet, dies jedoch nur aus didaktischen Gründen!!!
		echo $string;
	}

}
