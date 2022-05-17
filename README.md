# This is just a fork!
I am not the author of this code, I am just keeping it updated for my personal use. Please have a look at the original author.

# Minecraft Server Status Query [Discontinued]

[![Latest Stable Version](https://poser.pugx.org/funnyitselmo/minecraftserverstatus/v/stable)](https://packagist.org/packages/funnyitselmo/minecraftserverstatus) [![Total Downloads](https://poser.pugx.org/funnyitselmo/minecraftserverstatus/downloads)](https://packagist.org/packages/funnyitselmo/minecraftserverstatus) [![Latest Unstable Version](https://poser.pugx.org/funnyitselmo/minecraftserverstatus/v/unstable)](https://packagist.org/packages/funnyitselmo/minecraftserverstatus) [![License](https://poser.pugx.org/funnyitselmo/minecraftserverstatus/license)](https://packagist.org/packages/funnyitselmo/minecraftserverstatus)

Minecraft Server Status Query, written in PHP, with online players, motd, favicon and more server related informations without plugins and enable-query.

*Tested with Spigot 1.9 and Bungeecord 1.9 & 1.8*

### Installation
```
composer require ok236449/minecraftserverstatus
```
### Tutorial
```Java
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
		
		
    if($response['player_list'])
    echo 'Connected players:<br>';
    {
        foreach($response['player_list'] as $player)
        {
    	    echo $player . '<br>';
	}
    }
}
```
If the server is offline MinecraftServerStatus::query returns false else it returns an array which contains the server informations.

### Variables
The following table contains the available variables the response can contain. The default value of each variable is false.

<table border="0">
<tr>
<th>Array Index</th>
<th>Description</th>
</tr>
<tr>
<td><pre>'hostname'</pre></td>
<td>Exact server address in 127.0.0.1 format</td>
</tr>
<tr>
<td><pre>'port'</pre></td>
<td>The servers port for example 25565</td>
</tr>
<tr>
<td><pre>'ping'</pre></td>
<td>The time in ms the server needs to answer</td>
</tr>
<tr>
<td><pre>'version'</pre></td>
<td>The server version <br>(for example: 1.9)</td>
</tr>
<tr>
<td><pre>'protocol'</pre></td>
<td>The server protocol <br>(for example: 107)</td>
</tr>
<tr>
<td><pre>'players'</pre></td>
<td>Amount of players who are currently online</td>
</tr>
<tr>
<td><pre>'max_players'</pre></td>
<td>Number of the slots of the server</td>
</tr>
<tr>
<td><pre>'player_list'</pre></td>
<td>Collection of connected players. It contains player´s nick and uuid.</td>
</tr>
<tr>
<td><pre>'description'</pre></td>
<td>The message of the day of the server </td>
</tr>
<tr>
<td><pre>'description_raw'</pre></td>
<td>The raw version of description <br>(contains color codes etc.)</td>
</tr>
<tr>
<td><pre>'favicon'</pre></td>
<td>The favicon of the server in a base64 string <br>(Can be displayed with the html img tag by setting the string as src)</td>
</tr>
<tr>
<td><pre>'modinfo'</pre></td>
<td>Informations about the plugins</td>
</tr>
</table>


