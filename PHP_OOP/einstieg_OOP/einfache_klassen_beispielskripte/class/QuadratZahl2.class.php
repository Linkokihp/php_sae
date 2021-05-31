<?php
class QuadratZahl2 {
	/* Eigenschaft
	- Das Schlüsselwort "public" (ein sog. "Zugriffsbezeichner") wird später erklärt
	- Weil es hier ein solches Schlüsselwort hat, weiss PHP,
	dass man eine Eigenschaft und keine "normale" Variable deklarieren möchte
	*/
	
	public $AntwortSatz = "Das Resultat ist: ";
	
	// Methode
	function rechne($anna) {
		/* $this
		- Mit $this wird auf die Eigenschaft zugegriffen
		- Mit $this macht man einen Verweis auf das eigene Objekt
		- Beachte, dass das $-Zeichen vor "AntwortSatz" fehlt!!!
		*/
		$resultat = $this->AntwortSatz.$anna * $anna;
		
		return $resultat;
	}
}