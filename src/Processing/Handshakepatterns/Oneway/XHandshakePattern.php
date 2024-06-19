<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Oneway;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class XHandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('X',  [
            ['e', 'es', 's', 'ss']
        ], null, ['s']);
    }
}
