<?php

include "token.php";

$website = 'https://api.telegram.org/bot'.$botToken;

// Geschriebene Daten einlesen
$update = file_get_contents('php://input');

// Daten für PHP umwandeln
$updateArray = json_decode($update, TRUE);

// den Text herausfiltern
$text = $updateArray['message']['text'];

// prüfen ob der richtige Text eingegeben wurde
if ($text == '/joke' || $text == '/joke@ChuckNorrisWitzeBot') {

	// die Herkunft des Nachricht herausfinden
	$chatId = $updateArray['message']['chat']['id'];

	// einen zufälligen Witz einlesen
	$cnDb = file_get_contents('http://api.icndb.com/jokes/random');
	
	// Daten für PHP umwandeln
	$updateCnDb = json_decode($cnDb, TRUE);
	
	// den Witz herausfiltern
	$jokeRaw = $updateCnDb['value']['joke'];
	
	// Hochkommas und Anführungszeichen ersetzen, sonst wird der Witz abgeschnitten
	$sonderzeichen = array('&quot;', '\'');
	$joke = str_replace($sonderzeichen, '`', $jokeRaw);
	
	// Ausgabe
	file_get_contents($website.'/sendmessage?chat_id='.$chatId.'&text='.$joke);
}

?>