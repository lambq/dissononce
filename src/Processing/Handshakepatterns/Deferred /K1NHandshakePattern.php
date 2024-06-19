<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Deferred;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class K1NHandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('K1N',  [
            ['e'],
            ['e', 'ee'],
            ['se'],
        ], ['s']);
    }
}
