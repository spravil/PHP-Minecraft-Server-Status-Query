Minecraft Server Status Query
====================

Minecraft server status query with slots and online players query **without plugins and enable-query** working with nearly every Minecraft version including 1.8, 1.7.10 etc.

Download all files, view the example.php on your web server and feel free to use it.

**Twitter: https://twitter.com/Spravil <-- Follow if you like my work and want to stay up to date :)**

Tutorial
========

Firstly, you have to include in your php file the status.class.php and call the class.
```php
include_once 'MinecraftServerStatus/status.class.php'; //include the class
$status = new MinecraftServerStatus(); // call the class
```
Then you call the getStatus() function.
You have to replace the domain 'pvp24.com' with the ip or domain of your server.
```php
$response = $status->getStatus('pvp24.com'); // call the function 
```
Also if your server don't have the default port (25565) you can add it as getStatus(ip, port, version).
```php
$response = $status->getStatus('pvp24.com', 25565, '1.7.10'); // when you don't have the default port 
```
When you server runs an older version then 1.7.* you must specify the version.
```php
$response = $status->getStatus('pvp24.com', 25565, '1.6.*'); // when you server is older then 1.7.*
```
After that you only have to check the response.
```php
if(!$response) {
    echo"The Server is offline!";
} else {
	echo"<img width=\"64\" height=\"64\" src=\"".$response['favicon']."\" /> <br>
    The Server ".$response['hostname']." is running on ".$response['version']." and is online,
    currently are ".$response['players']." players online
    of a maximum of ".$response['maxplayers'].". The motd of the server is '".$response['motd']."'.
    The server has a ping of ".$response['ping']." milliseconds.";
}
```
If the server is offline it returns false else it returns an array which contains variables.

Variables
========

The table contains the available variables the response can contain.

The default content of each variable is false.

<br>
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
<td><pre>'version'</pre></td>
<td>The server version <br>(for example: 1.8)</td>
</tr>
<tr>
<td><pre>'protocol'</pre></td>
<td>The server protocol <br>(for example: 4)</td>
</tr>
<tr>
<td><pre>'players'</pre></td>
<td>Amount of players who are currently online</td>
</tr>
<tr>
<td><pre>'maxplayers'</pre></td>
<td>Number of the slots of the server</td>
</tr>
<tr>
<td><pre>'motd'</pre></td>
<td>The message of the day of the server </td>
</tr>
<tr>
<td><pre>'motd_raw'</pre></td>
<td>The raw version of the MOTD of the server <br>(contains color codes etc.)</td>
</tr>
<tr>
<td><pre>'favicon'</pre></td>
<td>The favicon of the server in a base64 string <br>(Can be displayed with the html img tag by setting the string as src)</td>
</tr>
<tr>
<td><pre>'ping'</pre></td>  
<td>The time the server needs to respond in ms</td>
</tr>
</table>


