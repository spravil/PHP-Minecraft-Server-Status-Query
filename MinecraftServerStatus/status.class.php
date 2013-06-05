<?php

    /**
     * Minecraft Server Status Query
     * @author Julian Spravil <julian.spr@t-online.de> https://github.com/FunnyItsElmo
     * @license Free to use but dont remove the author, license and copyright
     * @copyright © 2013 Julian Spravil
     */
    class MinecraftServerStatus {
        private $timeout;

        /**
         * Prepares the class.
         * @param int    $timeout   default(3)
         */
        public function __construct($timeout = 3) {
            $this->timeout = $timeout;
        }

        /**
         * Gets the status of the target server.
         * @param string    $host    domain or ip address
         * @param int    $port    default(25565)
         */
        public function getStatus($host = '127.0.0.1', $port = 25565) {

            //Transform domain to ip address.
            if (substr_count($host , '.') != 4) $host = gethostbyname($host);

            //Get timestamp for the ping
            $start = microtime(true);

            //Connect to the server
            if(!$socket = @stream_socket_client('tcp://'.$host.':'.$port, $errno, $errstr, $this->timeout)) {

                //Server is offline
                return false;


            } else {

                stream_set_timeout($socket, $this->timeout);

                //Write and read data
                fwrite($socket, "\xFE\x01");
                $data = fread($socket, 2048);
                fclose($socket);
                if($data == null) return false;

                //Calculate the ping
                $ping = round((microtime(true)-$start)*1000);

                //Evaluate the received data
                if (substr((String)$data, 3, 5) == "\x00\xa7\x00\x31\x00"){

                    $result = explode("\x00", mb_convert_encoding(substr((String)$data, 15), 'UTF-8', 'UCS-2'));
                    $motd = preg_replace("/(§.)/", "",$result[1]);

                }else{

                    $result = explode('§', mb_convert_encoding(substr((String)$data, 3), 'UTF-8', 'UCS-2'));

                    $motd = "";
                    foreach ($result as $key => $string) {
                        if($key != sizeof($result)-1 && $key != sizeof($result)-2 && $key != 0) {
                            $motd .= '§'.$string;
                        }
                    }

                    $motd = preg_replace("/(§.)/", "", $motd);

                }
                //Remove all special characters from a string
                $motd = preg_replace("/[^[:alnum:][:punct:] ]/", "", $motd);

                //Set variables
                $res = array();
                $res['hostname'] = $host;
                $res['version'] = $result[0];
                $res['motd'] = $motd;
                $res['players'] = $result[sizeof($result)-2];
                $res['maxplayers'] = $result[sizeof($result)-1];
                $res['ping'] = $ping;

                //return obj
                return $res;
            }

        }
    }

?>
