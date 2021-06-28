<?php
session_name('meinEigenerSessionCookieKey'); // key meinEigenerSessionCookieKey statt PHPSESSID - vor session_start() und in einer App immer gleich (da sonst die Session nicht mehr gefunden wird)
session_start(); // Session Zugriff starten / Array bereitstellen mit Session-Daten, wenn vorhanden

// ausloggen (Session zurücksetzen)
setcookie (session_name(), null, -1, '/');
session_destroy();
session_write_close();

// auf das login umleiten
header('Location: login.php');
exit;
?>