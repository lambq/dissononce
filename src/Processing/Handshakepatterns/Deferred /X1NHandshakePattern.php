<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Deferred;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class X1NHandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('X1N',  [
            ['e'],
            ['e', 'ee'],
            ['s'],
            ['se']
        ]);
    }
}
