<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Interactive;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class XXHandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('XX',  [
            ['e'],
            ['e', 'ee', 's', 'es'],
            ['s', 'se']
        ]);
    }
}

