<?php
class MyFirstGallery {
    
    //Array für Pfade (Eigenschaften)
    // Muss in BEIDEN Methoden zur Verfügung stehen! So Public!
    public $bilder = Array();


    function __construct($pfad) {
        //Checke ob das Verzeichnis mit den Bildern existiert
        if (is_dir($pfad)) {
            //Falls ja: Befülle das Array mit den Pfaden
            foreach (glob($pfad."/"."*.gif") as $image) {
                $this->bilder[] = $image;
            }
            sort($this->bilder);
        } else {
            //Verzeichnis ist nicht vorhanden, breche das Script ab
            exit("Can't find directory with images");
        }
    }


    // Setze den HTML-Code für die Galerie zusammen
    function makeGallery() {
        $htmlCode = "";
        foreach ($this->bilder as $val) {
            $htmlCode .= "<img src='".$val."'>";
        }
        return $htmlCode;
    }
};
?>