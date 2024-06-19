<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Interactive;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class IKHandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('IK',  [
            ['e', 's'],
            ['e', 'ee', 'se']
        ], null, ['s']);
    }
}
