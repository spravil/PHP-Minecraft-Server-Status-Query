<?php
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
