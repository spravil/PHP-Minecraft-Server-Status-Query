<?php

/*
 * Minecraft Server Status Query
 * Code by Julian Spravil <julian.spr@t-online.de>
 * GitHub: https://github.com/FunnyItsElmo/PHP-Minecraft-Server-Status-Query
*/

    class MinecraftServerStatus {

        /*
         * string $address - IP address or Domain of the Minecraft server.
         * int $port - Port of the Minecraft server (default = 25565).
        */

        public function getStatus($host = '127.0.0.1', $port = 25565) {

            if (substr_count($host , '.') != 4) {
                $host = gethostbyname($host);
            }

            $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
            $connect = socket_connect($socket, $host, $port);

            if ($connect) {

                socket_send($socket, "\xFE", 1, 0);
                $d = '';
                socket_recv($socket, $d, 200, 2);
                socket_close($socket);
                $result = (String)$d;
           
                if (substr($result, 3, 5) == "\x00\xa7\x00\x31\x00"){
                    $result = explode("\x00", mb_convert_encoding(substr($result, 15), 'UTF-8', 'UCS-2'));
                }else{
                    $result = explode('§', mb_convert_encoding(substr($result, 3), 'UTF-8', 'UCS-2'));
                }

                $version = $result[0];
                $motd = preg_replace("/(§.)/", "",$result[1]);
                $players = $result[sizeof($result)-2];
                $slots = $result[sizeof($result)-1];

                $res = array();
                $res['hostname'] = $host;
                $res['version'] = $version;
                $res['motd'] = $motd;
                $res['players'] = $players;
                $res['maxplayers'] = $slots;

                return $res;

            } else {

                return false;

            }
        }
    }

?>