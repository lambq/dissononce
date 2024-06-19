<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Deferred;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class K1XHandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('K1X',  [
            ['e'],
            ['e', 'ee', 's', 'es'],
            ['se'],
        ], ['s']);
    }
}
