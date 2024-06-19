<?php

namespace Lambq\Dissononce\Extras\Processing;

use Lambq\Dissononce\Processing\HandshakeState;

class SwitchableHandshakeState extends ForwarderHandshakeState
{
    public function __construct(HandshakeState $handshakestate)
    {
        parent::__construct($handshakestate);
    }

    public function switch($handshake_pattern, $initiator, $prologue, $s=null, $e=null, $rs=null, $re=null, $psks=null)
    {
        if ($initiator)
        {
            foreach ($handshake_pattern->initiator_pre_message_pattern() as $pattern)
            {
                foreach ($pattern as $token)
                {
                    if ($token == 'e')
                    {
                        $e  = $this->e();
                    }

                    if ($token == 's')
                    {
                        $s  = $this->s();
                    }
                }
            }

            foreach ($handshake_pattern->responder_pre_message_pattern() as $pattern)
            {
                foreach ($pattern as $token)
                {
                    if ($token == 'e')
                    {
                        $re = $this->re();
                    }
                    if ($token == 's')
                    {
                        $rs = $this->rs();
                    }

                }
            }
        } else {
            foreach ($handshake_pattern->initiator_pre_message_pattern() as $pattern)
            {
                foreach ($pattern as $token)
                {
                    if ($token == 'e')
                    {
                        $re = $this->re();
                    }
                    if ($token == 's')
                    {
                        $re = $this->rs();
                    }
                }
            }

            foreach ($handshake_pattern->responder_pre_message_pattern() as $pattern)
            {
                foreach ($pattern as $token)
                {
                    if ($token == 'e')
                    {
                        $e = $this->e();
                    }
                    if ($token == 's')
                    {
                        $s = $this->s();
                    }
                }
            }
        }

        return parent::initialize($handshake_pattern, $initiator, $prologue, $s, $e, $rs, $re, $psks);
    }
}
