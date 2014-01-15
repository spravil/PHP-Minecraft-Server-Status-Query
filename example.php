<?php

	include_once 'MinecraftServerStatus/status.class.php';
	$status = new MinecraftServerStatus();
	$response = $status->getStatus('Mad-Gamble.net');
	if(!$response) {
		echo"The Server is offline!";
	} else {
		echo"<img width=\"64\" height=\"64\" src=\"".$response['favicon']."\" /> <br>
		The Server ".$response['hostname']." is running on ".$response['version']." and is online,
		currently are ".$response['players']." players online
		of a maximum of ".$response['maxplayers'].". The motd of the server is '".$response['motd']."'. 
		The server has a ping of ".$response['ping']." milliseconds.";
	}

?>
