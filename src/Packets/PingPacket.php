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

class PingPacket extends Packet {

    public function __construct () {
        parent::__construct(0);
    }
}