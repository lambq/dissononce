<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Deferred;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class I1XHandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('I1X',  [
            ['e', 's'],
            ['e', 'ee', 's', 'es'],
            ['se']
        ]);
    }
}
