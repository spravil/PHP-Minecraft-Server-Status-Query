Minecraft Server Status Query
====================

Minecraft server status query with slots and online players query without plugins and enable-query.
Download all files, view the example.php on your webserver and feel free to use it.

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
Also if your server dont have the default port (25565) you can add it as getStatus(ip, port).
```php
$response = $status->getStatus('pvp24.com', 25565); // when you dont have the default port 
```
After that you only have to check the response.
```php
if(!$response) {
	echo"The Server is offline!";
} else {
	echo"The Server ".$response['hostname']." is running on ".$response['version']." and is online,
	currently are ".$response['players']." players online
	of a maximum of ".$response['maxplayers'].". The motd of the server is '".$response['motd']."'.";
}
```
If the server is offline it returns false else it returns an array which contains the variables 'hostname', 'players', 'motd', 'version' and 'maxplayers'.
