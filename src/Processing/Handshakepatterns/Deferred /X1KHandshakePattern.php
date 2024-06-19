<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Deferred;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class X1KHandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('X1K',  [
            ['e', 'es'],
            ['e', 'ee'],
            ['s'],
            ['se']
        ], null, ['s']);
    }
}
