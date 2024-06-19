<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Deferred;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class X1K1HandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('X1K1',  [
            ['e'],
            ['e', 'ee', 'es'],
            ['s'],
            ['se']
        ], null, ['s']);
    }
}
