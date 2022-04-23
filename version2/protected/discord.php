<?php
// Load RestCord
include str_replace("\\", "/",  dirname(__FILE__, 2)). '/vendor/autoload.php';
use RestCord\DiscordClient;


function discordCreate($token) {
	// Create discord connection
	try {

		$discord = new DiscordClient(['token' => $token]);
		$discord->oauth2->getCurrentApplicationInformation(['user.id']); // Test if it work
	} catch (Exception $ex) {
		die("");
	}
	return $discord;
}
?>