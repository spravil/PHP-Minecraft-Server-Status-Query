<?php
use MinecraftServerStatus\MinecraftServerStatus;

require '../vendor/autoload.php';

$response = MinecraftServerStatus::query('lostforce.com', 25565);

if (! $response) {
    echo "The Server is offline!";
} else {
    echo "<img width=\"64\" height=\"64\" src=\"" . $response['favicon'] . "\" /> <br>
		The Server " . $response['hostname'] . " is running on " . $response['version'] . " and is online,
		currently are " . $response['players'] . " players online
		of a maximum of " . $response['max_players'] . ". The motd of the server is '" . $response['description'] . "'.
		The server has a ping of " . $response['ping'] . " milliseconds.";
}
