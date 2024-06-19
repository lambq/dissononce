<?php

namespace Lambq\Dissononce\Processing\Modifiers;

use Lambq\Dissononce\Exception\NoiseProtocolException;
use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class PatternModifier
{

    protected $name;
    public function __construct($name)
    {
        $this->name   = $name;
    }

    public function is_modifiable($handsakepattern)
    {

    }

    public function get_message_patterns($handsakepattern)
    {

    }

    public function get_initiator_pre_messages($handsakepattern)
    {

    }

    public function get_responder_pre_messages($handsakepattern)
    {

    }

    public function interpret_as_bob($handsakepattern)
    {

    }

    public function modify($pattern)
    {
        if (!$this->is_modifiable($pattern))
        {
            throw new NoiseProtocolException("Noise Processing Modifiers PatternModifier modify:{$pattern}");
        }

        $name   = $pattern->origin_name() . '+' . implode('+', array_merge($pattern->modifiers(), array($this->name)));

        return new HandshakePattern($name, $this->get_message_patterns($pattern), $this->get_initiator_pre_messages($pattern), $this->get_responder_pre_messages($pattern), $this->interpret_as_bob($pattern));
    }
}
