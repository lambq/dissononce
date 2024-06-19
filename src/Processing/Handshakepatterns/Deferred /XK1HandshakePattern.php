<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Deferred;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class XK1HandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('XK1',  [
            ['e'],
            ['e', 'ee', 'es'],
            ['s', 'se']
        ], null, ['s']);
    }
}
