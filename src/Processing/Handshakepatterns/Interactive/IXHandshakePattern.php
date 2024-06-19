<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Interactive;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class IXHandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('IX',  [
            ['e', 's'],
            ['e', 'ee', 'se', 's', 'es']
        ]);
    }
}
