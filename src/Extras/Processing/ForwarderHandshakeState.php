<?php

namespace Lambq\Dissononce\Extras\Processing;

use Lambq\Dissononce\Processing\HandshakeState;

class ForwarderHandshakeState
{
    protected $handshakestate;

    public function __construct(HandshakeState $handshakestate)
    {
        $this->handshakestate = $handshakestate;
    }

    public function initialize($handshake_pattern, $initiator, $prologue, $s = null , $e = null, $rs = null, $re = null, $psks = null)
    {
        return $this->handshakestate->initialize($handshake_pattern, $initiator, $prologue, $s, $e, $rs, $re, $psks);
    }

    public function write_message($payload, $message_buffer)
    {
        return $this->handshakestate->write_message($payload, $message_buffer);
    }

    public function read_message($message, $payload_buffer)
    {
        return $this->handshakestate->read_message($message, $payload_buffer);
    }

    public function re()
    {
        return $this->handshakestate->re();
    }

    public function rs()
    {
        return $this->handshakestate->rs();
    }

    public function s()
    {
        return $this->handshakestate->s();
    }

    public function e()
    {
        $this->handshakestate->e();
    }
}
