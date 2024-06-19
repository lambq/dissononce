<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Oneway;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class KHandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('K',  [
            ['s', 'es', 'ss']
        ], ['s'], ['s']);
    }
}
