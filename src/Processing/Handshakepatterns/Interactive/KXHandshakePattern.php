<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Interactive;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class KXHandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('KX',  [
            ['e'],
            ['e', 'ee', 'se', 's', 'es']
        ], null, ['s']);
    }
}