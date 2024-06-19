<?php

namespace Lambq\Dissononce\Processing\Modifiers;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class FallbackPatternModifier extends PatternModifier
{
    protected $VALID_FIRST_MESSAGES = "(('e',), ('s',), ('e', 's'))";

    public function __construct()
    {
        parent::__construct("fallback");
    }

    public function is_modifiable($handsakepattern)
    {

        if (in_array($handsakepattern->message_patterns()[0], $this->VALID_FIRST_MESSAGES))
        {
            return $this->VALID_FIRST_MESSAGES[$handsakepattern->message_patterns()[0]];
        }
    }

    public function get_message_patterns($handsakepattern)
    {
        return array_slice($handsakepattern->message_patterns(), 1);
    }

    public function get_initiator_pre_messages($handsakepattern)
    {
        return $handsakepattern->message_patterns()[0];
    }

    public function interpret_as_bob($handsakepattern)
    {
        return true;
    }
}
