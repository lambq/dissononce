<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Oneway;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class NHandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('N',  [
            ['s', 'es']
        ], null, ['s']);
    }
}
