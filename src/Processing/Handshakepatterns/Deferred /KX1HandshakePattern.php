<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Deferred;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class KX1HandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('KX1',  [
            ['e'],
            ['e', 'ee', 'se', 's'],
            ['es'],
        ], null, ['s']);
    }
}
