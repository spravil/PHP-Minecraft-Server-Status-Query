<?php
namespace MinecraftServerStatus\Packets;

class PingPacket extends Packet {

    public function __construct () {
        parent::__construct(0);
    }
}
