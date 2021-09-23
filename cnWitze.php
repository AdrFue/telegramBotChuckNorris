<?php

// Verbindung für die Witze
$website = 'http://api.icndb.com/jokes/random';

// zufälligen Witz einlesen
$update = file_get_contents($website);

// Daten für PHP umwandeln
$updateArray = json_decode($update, TRUE);

// Daten herausfiltern
$nummer = $updateArray['value']['id'];
$jokeRaw = $updateArray['value']['joke'];

// Anführungszeichen und Hochkomma ersetzen, sonst wird der Witz abgeschnitten
$sonderzeichen = array('&quot;', '\'');
$joke = str_replace($sonderzeichen, '`', $jokeRaw);

// Ausgabe
echo ('<title>Chuck Norris Witze</title><link rel="shortcut icon" type="image/x-icon" href="https://telegrambot.adrianf.de/roboter.png">');
echo('Number ' . $nummer . ': ' . $joke);

?>