<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Deferred;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class X1X1HandshakePattern extends  HandshakePattern
{
    public function __construct()
    {
        parent::__construct('X1X1',  [
            ['e'],
            ['e', 'ee', 'es'],
            ['es', 's'],
            ['se']
        ]);
    }
}
