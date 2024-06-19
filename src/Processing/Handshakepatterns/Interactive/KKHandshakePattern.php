<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Interactive;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class KKHandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('KK',  [
            ['e', 'es', 'ss'],
            ['e', 'ee', 'se']
        ], ['s'], ['s']);
    }
}
