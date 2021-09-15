<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8" />
	<title>Root-Verzeichnis</title>
<style>
* {
	margin: 0px;
	padding: 0px;
}

body {
	font-family: Arial, Verdana, sans-serif;
	font-size: 16px;
	line-height: 20px;
	color: #333;
}

div {
	margin-bottom: 20px
}

p {
	margin-bottom: 15px;
}

ul {
	margin: 0 0 20px 20px;
}

h1 {
	font-size: 28px;
	line-height: 32px;
	margin-bottom: 20px;
}

h2 {
	font-size: 24px;
	line-height: 25px;
	margin-bottom: 8px;
}

h3 {
	font-size: 20px;
	line-height: 24px;
	margin-bottom: 3px;
}

#container {
	max-width: 960px;
	margin: 20px auto 50px auto;
}

code {
	display: block;
	background-color: #EEEEEE;
	border: 1px solid #555555;
	padding: 12px 15px;
	margin: 6px 0 15px 0;
}
</style>
</head>
<body>
<div id="container">
<h1>Zuoberst und noch mehr darüber</h1>
<p><img src="Root_Verzeichnis.png" width="390" height="438" alt="Root_Verzeichnis"></p>
<h2>Was ist das Root-Verzeichnis?</h2>

<p>Das Root-Verzeichnis ist, vereinfacht gesagt, das Startverzeichnis einer Website. Dort wird die Startseite (index.html oder index.php) geladen, sobald jemand die Domain mit http:// oder https:// aufruft.</p>

<p>Mit ftp:// kann man bei den meisten Providern auch auf das Verzeichnis zugreifen, in welchem das Root-Verzeichnis auf dem Server liegt oder sogar darüber.</p>

<p>In HTML-Pfaden kommt man (von überall) mit dem Slash "/" ganz hinauf, Beispiel:<br>

<code>&lt;a href=&quot;/index.html&quot;&gt;Home&lt;/&gt;</code>

<h3>andere Begriffe für &quot;Root-Verzeichnis&quot;</h3>
<ul>
	<li>Stammverzeichnis</li>
	<li>Stammordner</li>
	<li>Wurzelverzeichnis oder einfach Wurzel</li>
	<li>root directory</li>
	<li>document root</li>
</ul>

<h3>Wie kann ich mit PHP den realen Pfad der Root ermitteln?</h3>
<p>Bei vielen Projekten musst du das wissen, um das Installationsskript durchlaufen zu lassen. Dafür gibt es in PHP eine praktische Server-Variable:</p>

<code><pre>$_SERVER['DOCUMENT_ROOT']</pre></code>

<p>
<?php
echo "Der Pfad zum Dokument-Root ist: ".$_SERVER['DOCUMENT_ROOT'];
?>
</p>

<br><br>
<h1>Anwendungsbeispiele</h1>
<h2>1. PHP-Dateien neben oder oberhalb der Root ablegen</h2>
<p>Ich kann zum Beispiel mit require() auf ein PHP-Script zugreifen, das oberhalb meines Root-Verzeichnisses liegt. Das macht dann Sinn, wenn dort heikle Informationen wie Passwörter oder DB-Credentials abgelegt sind.</p>

<h2>2. Dokumente sicher ablegen</h2>

<p>In vielen CMS, LMMS oder Cloud-Lösungen werden Dokumente ausserhalb des Root-Verzeichnisses abgelegt. Das hat den Vorteil, dass diese dadurch nicht direkt über den Browser via URL abrufbar sind.<br>
Somit kann man die Dokumente ausschliesslich eingeloggten Usern zum Download zur Verfügung stellen. PHP muss dann ein solches Dokument einlesen und kann es darauf mit einem forcierten Download anbieten.</p>

<h3>Beispiel-Code: Download eines Bildes, das ausserhalb des Root-Verzeichnisses liegt</h3>

<?php
$str = "<?php
\$file = '../../myImage.jpg';

if (file_exists(\$file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=\"'.basename(\$file).'\"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize(\$file));
    readfile(\$file);
    exit;
}
else {
	exit('Habe das File nicht gefunden');
}
?>";

echo "<pre>";
highlight_string($str);
echo "</pre>";
?>
<p><strong>Hinweis:</strong> PHP liest das File auf dem Server mit readfile() ein und <strong>nicht</strong> der Browser!<br>
Genauer gesagt sind es eigentlich zwei Schritte, PHP liest das File ein und gibt es an den sog. &quot;output buffer&quot; weiter, von wo es dann heruntergeladen wird.</p>
<h2>Bedingungen für diese Beispiele</h2>
<p>Zugriffe auf Orte ausserhalb des Root-Verzeichnisses können durch den Provider verboten oder auf bestimmte Verzeichnisse beschränkt sein (php.ini > Einstellung &quot;'open_basedir'&quot;, .htaccess, etc.). Teste also die Verhältnisse auf dem Zielserver zuerst aus, <strong>bevor</strong> du mit dem Projekt beginnst!</p>

<br>
<h2>Aufgaben</h2>

<ul>
	<li>Ermittle auf deinem Rechner mit PHP den realen Pfad zum Localhost deines Entwicklungs-Stacks.</li>
	<li>Was ist in deinem Entwicklungs-Stack in der php.ini bei &quot;'open_basedir'&quot; eingestellt und was bedeutet das wohl?</li>
	<li>Lege die beiliegende Datei &quot;sayHello.php&quot; ausserhalb der Root ab und inkludiere sie auf dieser Seite.</li>
	<li>Lege das beiliegende Bild &quot;wurzel.JPG&quot; ausserhalb der Root ab, passe das beiliegende Skript &quot;readImage.php&quot; an und klicke auf den unten stehenden Link, um das Bild herunter zu laden.</li>
</ul>


<p>Das Bild &quot;wurzel.JPG&quot;  <a href="readImage.php" target="_blank">herunterladen</a></p>
</div>
</body>
</html>