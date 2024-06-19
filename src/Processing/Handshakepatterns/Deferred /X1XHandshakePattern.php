<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Deferred;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class X1XHandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('X1X',  [
            ['e'],
            ['e', 'ee', 's', 'es'],
            ['s'],
            ['se']
        ]);
    }
}
