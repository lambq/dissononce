<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Interactive;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class INHandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('IN',  [
            ['e', 's'],
            ['e', 'ee', 'se']
        ]);
    }
}
