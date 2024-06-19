<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Deferred;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class IK1HandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('IK1',  [
            ['e', 's'],
            ['e', 'ee', 'se', 'es'],
        ], null, ['s']);
    }
}
