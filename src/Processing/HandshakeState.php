<?php

namespace Lambq\Dissononce\Processing;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;
use Lambq\Dissononce\Processing\Impl\HandshakeState as ImplHandshakeState;

class HandshakeState extends ImplHandshakeState
{

    public function initialize($handshake_pattern, $initiator, $prologue, $s = null, $e=null, $rs=null, $re=null, $psks=null)
    {
        return parent::initialize($handshake_pattern, $initiator, $prologue, $s, $e, $rs, $re, $psks);
    }

    public function symmetricstate()
    {
        return null;
    }

    public function rs()
    {
        return null;
    }

    public function re()
    {
        return null;
    }

    public function s()
    {
        return null;
    }

    public function e()
    {
        return null;
    }

    public function write_message($payload, $message_buffer)
    {
        return parent::write_message($payload, $message_buffer);
    }

    public function read_message($message, $payload_buffer)
    {
        return parent::read_message($message, $payload_buffer);
    }
}

