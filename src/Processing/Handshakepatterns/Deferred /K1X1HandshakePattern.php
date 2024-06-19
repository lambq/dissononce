<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Deferred;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class K1X1HandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('K1X1',  [
            ['e'],
            ['e', 'ee', 's'],
            ['se', 'es'],
        ], ['s']);
    }
}



