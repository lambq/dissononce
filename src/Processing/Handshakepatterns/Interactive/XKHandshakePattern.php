<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Interactive;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class XKHandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('XK',  [
            ['e', 'es'],
            ['e', 'ee'],
            ['s', 'se']
        ],null, ['s']);
    }
}
