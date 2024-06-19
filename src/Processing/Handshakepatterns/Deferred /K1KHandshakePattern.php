<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Deferred;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class K1KHandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('K1K',  [
            ['e', 'es'],
            ['e', 'ee'],
            ['se']
        ], ['s'], ['s']);
    }
}
