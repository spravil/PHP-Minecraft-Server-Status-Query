# Minecraft Server Status Query

[![Latest Stable Version](https://poser.pugx.org/funnyitselmo/minecraftserverstatus/v/stable)](https://packagist.org/packages/funnyitselmo/minecraftserverstatus) [![Total Downloads](https://poser.pugx.org/funnyitselmo/minecraftserverstatus/downloads)](https://packagist.org/packages/funnyitselmo/minecraftserverstatus) [![Latest Unstable Version](https://poser.pugx.org/funnyitselmo/minecraftserverstatus/v/unstable)](https://packagist.org/packages/funnyitselmo/minecraftserverstatus) [![License](https://poser.pugx.org/funnyitselmo/minecraftserverstatus/license)](https://packagist.org/packages/funnyitselmo/minecraftserverstatus)

Minecraft Server Status Query, written in PHP, with online players, motd, favicon and more server related informations without plugins and enable-query.

*Tested with vanilla 1.9, Spigot 1.9 and Bungeecord 1.9 & 1.8*

## Installation
```Shell
composer require funnyitselmo/minecraftserverstatus
```
## Tutorial
```PHP
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
```
If the server is offline MinecraftServerStatus::query returns false else it returns an array which contains the server informations.

## Variables
The following table contains the available variables the response can contain. The default value of each variable is false.

| Array Index | Description |
| --- | --- |
| `'hostname'` | Exact server address in 127.0.0.1 format |
| `'port'` | The servers port for example 25565 |
| `'ping'` | The time in ms the server needs to answer |
| `'version'` | The server version (for example: 1.9) |
| `'protocol'` | The server protocol (for example: 107) |
| `'players'` | Amount of players who are currently online |
| `'max_players'` | Number of the slots of the server |
| `'description'` | The message of the day of the server (sometimes styled with `<span class="minecraft-format-<code>">`, available codes taken from [wiki](http://minecraft.gamepedia.com/Formatting_codes)) |
| `'description_clean'` | Clean version of description (without color codes etc.) |
| `'description_raw'` | The raw version of description (contains color codes etc., possibly an object) |
| `'favicon'` | The favicon of the server in a base64 string (can be displayed with the html img tag by setting the string as src) |
| `'modinfo'` | Informations about the plugins |
