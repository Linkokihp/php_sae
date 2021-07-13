<?php
class MyPlayer {
	public function makePlayer($id, $width, $height) {
		return "<iframe width='$width' height='$height' src='https://www.youtube.com/embed/$id' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
	}
}
?>