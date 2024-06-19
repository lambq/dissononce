<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Deferred;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class NX1HandshakePattern extends  HandshakePattern
{
    public function __construct()
    {
        parent::__construct('NX1',  [
            ['e'],
            ['e', 'ee', 's'],
            ['se']
        ]);
    }
}

