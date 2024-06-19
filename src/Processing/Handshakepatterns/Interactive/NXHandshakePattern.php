<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Interactive;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class NXHandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('NX',  [
            ['e'],
            ['e', 'ee', 's', 'es']
        ]);
    }
}
