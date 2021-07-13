<?php
class MyFirstGallery {
    
    function makeGallery() {
        $bilder = Array();
        $pfad = "bilder";
        foreach (glob($pfad."/"."*.gif") as $image) {
            $bilder[] = $image;
        }
        sort($bilder);
        $htmlCode = "";
        foreach ($bilder as $val) {
            $htmlCode .= "<img src=\"".$val."\">\n";
        }
        return $htmlCode;
    }
};
?>