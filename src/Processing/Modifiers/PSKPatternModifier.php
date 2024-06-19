<?php

namespace Lambq\Dissononce\Processing\Modifiers;

use Lambq\Dissononce\Processing\Handshakepatterns\TupleDictionary;

class PSKPatternModifier extends PatternModifier
{
    protected $TOKEN = "psk";

    public function __construct($placement)
    {
        parent::__construct(sprintf("psk%d", $placement));
        $this->placement_index  = $placement == 0 ? 0 : $placement - 1;
        $this->placement_start  = $placement == 0;
    }

    public function is_modifiable($handsakepattern)
    {
        if ($this->placement_index < count($handsakepattern->message_patterns()) && in_array($this->TOKEN, $handsakepattern->message_patterns()[$this->placement_index])) {
            return $this->TOKEN;
        }
    }

    public function get_message_patterns($handshakepattern)
    {
        $pattern = [];
        for ($i=0;$i < count($handshakepattern->message_patterns()) ;$i++)
        {
            if ($i == $this->placement_index)
            {
                if ($this->placement_start)
                {
                    $pattern[]  = $this->TOKEN . $handshakepattern->message_patterns()[$i];
                } else {
                    $pattern[]  = $handshakepattern->message_patterns()[$i] . $this->TOKEN;
                }
            } else {
                $pattern[]  = $handshakepattern->message_patterns()[$i];
            }
        }
        return new TupleDictionary($pattern);
    }

    public function get_initiator_pre_messages($handshakepattern)
    {
        return $handshakepattern->initiator_pre_message_pattern();
    }

    public function get_responder_pre_messages($handshakepattern)
    {
        return $handshakepattern->responder_pre_message_pattern();
    }
}
