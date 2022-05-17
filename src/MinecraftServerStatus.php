<?php
namespace MinecraftServerStatus;
use MinecraftServerStatus\Packets\HandshakePacket;
use MinecraftServerStatus\Packets\PingPacket;

class MinecraftServerStatus {

    /**
     * Queries the server and returns the servers information
     *
     * @param string $host            
     * @param number $port            
     */
    public static function query ($host = '127.0.0.1', $port = 25565) {
        // check if the host is in ipv4 format
        $host = filter_var($host, FILTER_VALIDATE_IP) ? $host : gethostbyname($host);
        
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if (! @socket_connect($socket, $host, $port)) {
            return false;
        }
        
        // create the handshake and ping packet
        $handshakePacket = new HandshakePacket($host, $port, 107, 1);
        $pingPacket = new PingPacket();
        
        $handshakePacket->send($socket);
        
        // high five
        $start = microtime(true);
        $pingPacket->send($socket);
        $length = self::readVarInt($socket);
        $ping = round((microtime(true) - $start) * 1000);
        
        // read the requested data
        $data = socket_read($socket, $length, PHP_NORMAL_READ);
        $data = strstr($data, '{');
        $data = json_decode($data);
        
        $descriptionRaw = isset($data->description) ? $data->description : false;
        $description = $descriptionRaw;
        
        // colorize the description if it is supported
        if (gettype($descriptionRaw) == 'object') {
            $description = '';
            
            if (isset($descriptionRaw->text)) {
                $color = isset($descriptionRaw->color) ? $descriptionRaw->color : '';
                $description = '<font color="' . $color . '">' . $descriptionRaw->text . '</font>';
            }
            
            if (isset($descriptionRaw->extra)) {
                foreach ($descriptionRaw->extra as $item) {
                    $description .= isset($item->bold) && $item->bold ? '<b>' : '';
                    $description .= isset($item->color) ? '<font color="' . $item->color . '">' . $item->text . '</font>' : '';
                    $description .= isset($item->bold) && $item->bold ? '</b>' : '';
                }
            }
        }
        
        return array(
                'hostname' => $host,
                'port' => $port,
                'ping' => $ping,
                'version' => isset($data->version->name) ? $data->version->name : false,
                'protocol' => isset($data->version->protocol) ? $data->version->protocol : false,
                'players' => isset($data->players->online) ? $data->players->online : false,
                'max_players' => isset($data->players->max) ? $data->players->max : false,
                'player_list' => isset($data->players->sample) ? $data->players->sample : false,
                'description' => $description,
                'description_raw' => $descriptionRaw,
                'favicon' => isset($data->favicon) ? $data->favicon : false,
                'modinfo' => isset($data->modinfo) ? $data->modinfo : false
        );
    }

    private static function readVarInt ($socket) {
        $a = 0;
        $b = 0;
        while (true) {
            $c = socket_read($socket, 1);
            if (! $c) {
                return 0;
            }
            $c = Ord($c);
            $a |= ($c & 0x7F) << $b ++ * 7;
            if ($b > 5) {
                return false;
            }
            if (($c & 0x80) != 128) {
                break;
            }
        }
        return $a;
    }
}
