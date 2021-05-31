<?php
// Funktion: Schreiben in ein Textfile
function writeContent($contentFile) {
	$handle = fopen($contentFile,"a");
	// "a" bedeutet: Nur zum Schreiben geöffnet; platziere Dateizeiger auf Dateiende. Existiert die Datei nicht, versuche, diese zu erzeugen.
	fwrite($handle,$_POST['content']);
	fclose($handle);
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8" />
	<title>Einfaches CMS: schreiben</title>
	<link rel="stylesheet" href="../generalstyles.css">
</head>
<body>
	<h2 class="blau">Einfaches CMS: schreiben</h2>
	<ul class="explanation">
		<li>Kernstück des bestehenden Codes ist <code>fopen()</code>. Falls du nicht weisst, was das macht, lies bitte den <a href="http://php.net/manual/de/function.fopen.php" target="_blank">entsprechen Eintrag im php-Handbuch</a></li>
	</ul>
	<h3>Aufgabe: Das Textfeld wird zum HTML-Editor</h3>
	<ul  class="explanation">
		<li>Gehe auf die <a href="http://www.tinymce.com" target="_blank">tinymce-Website</a> und lade dir die aktuellste Version des Editors herunter.</li>
		<li>Schaue dir die Anleitung für die Installation des Editors an: <a href="https://www.tinymce.com/docs/get-started/first-steps/" target="_blank">Your First Steps</a>. Installiere tinymce in diesem Ordner (einfaches_cms).</li>
		<li>Binde tinymce in diesem Dokument ein.</li>
		<li>Wenn du die Seite erneut aufrufst, sollte das Textfeld nun <strong>ein neues &quot;Gesicht&quot;</strong> bekommen haben: es hat sich in einen WYSIWYG-Editor mit Toolbars für Textformatierungen etc. verwandelt.</li>
		<li>Der Begriff &quot;WYSIWYG&quot; erklärt auf <a href="https://de.wikipedia.org/wiki/WYSIWYG" target="_blank">Wikipedia</a>.</li>
		<li>In der Funktion zum Schreiben braucht es ev. (je nach Einstelllungen auf deinem Server) noch eine kleine Änderung: der String, welcher geschrieben werden soll, muss noch mit <a href="http://php.net/manual/de/function.stripslashes.php" target="_blank"><code>stripslashes()</code></a> &quot;geputzt&quot; werden.</li>
		<li>Eine Alternative zu tinymce wäre der <a href="https://ckeditor.com" target="_blank">CKEditor</a>, ein Projekt, dass es auch schon sehr lange gibt und in vielen CMS eingesetzt wird.</li>
	</ul>
	<hr>
	<p class="explanation"><a href="cms_lesen.php">&gt; Zur &quot;Lesen&quot;-Seite</a></p>
	<hr>
<?php
// Checke, ob der Submit-Button geklickt wurde
if (isset($_POST['go'])) {
	// ja
	// Funktionaufruf
	writeContent("content.txt");
	// Feedback wie immer
	echo "<div class=\"feedback_positiv\">";
	echo "Habe den Inhalt gespeichert.";
	echo "</div>\n";
}
?>

	<form action="cms_schreiben.php" method="post">
		<textarea name="content" id="content" cols="75" rows="15"></textarea><br><br>
		<button type="submit" name="go">Speichern</button>
	</form>
	<footer>
		<a href="../index.html">&lt; Home</a>
	</footer>
</body>
</html>
