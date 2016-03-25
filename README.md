#Minecraft Server Status Query

Minecraft Server Status Query, written in PHP, with online players, motd, favicon and more server related informations without plugins and enable-query.

*Tested with Spigot 1.9 and Bungeecord 1.9 & 1.8*

### Installation
```
composer require funnyitselmo/minecraftserverstatus
```
###Tutorial
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
}
```
If the server is offline MinecraftServerStatus::query returns false else it returns an array which contains the server informations.

###Variables
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


