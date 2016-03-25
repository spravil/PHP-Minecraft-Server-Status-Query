<?php
/**
 * Minecraft Server Status Query
 *
 * @link        https://github.com/FunnyItsElmo/PHP-Minecraft-Server-Status-Query/
 * @author      Julian Spravil <julian.spr@t-online.de>
 * @copyright   Copyright (c) 2016 Julian Spravil
 * @license     https://github.com/FunnyItsElmo/PHP-Minecraft-Server-Status-Query/blob/master/LICENSE
 */
namespace MinecraftServerStatus\Packets;

class HandshakePacket extends Packet {

    public function __construct ($host, $port, $protocol, $nextState) {
        parent::__construct(0);
        $this->addUnsignedChar($protocol);
        $this->addString($host);
        $this->addUnsignedShort($port);
        $this->addUnsignedChar($nextState);
    }
}