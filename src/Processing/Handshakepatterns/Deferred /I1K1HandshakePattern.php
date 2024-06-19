<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Deferred;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class I1K1HandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('I1K1',  [
            ['e', 's'],
            ['e', 'ee', 'es'],
            ['se']
        ], null, ['s']);
    }
}

