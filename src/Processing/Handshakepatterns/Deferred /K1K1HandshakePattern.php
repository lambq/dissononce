<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Deferred;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class K1K1HandshakePattern
{
    public function __construct()
    {
        parent::__construct('K1K1',  [
            ['e'],
            ['e', 'ee', 'es'],
            ['se'],
        ], ['s'], ['s']);
    }
}
