<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Deferred;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class KK1HandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('KK1',  [
            ['e'],
            ['e', 'ee', 'se', 's'],
            ['es'],
        ], ['s'], ['s']);
    }
}
