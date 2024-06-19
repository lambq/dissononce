<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Deferred;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class NK1HandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('NK1',  [
            ['e'],
            ['e', 'ee', 'es'],
        ], null, ['s']);
    }
}