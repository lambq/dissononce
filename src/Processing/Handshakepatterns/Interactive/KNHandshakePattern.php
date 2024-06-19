<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Interactive;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class KNHandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('KN',  [
            ['e'],
            ['e', 'ee', 'se']
        ], null, ['s']);
    }
}